<?php

namespace App\Http\Controllers\Movements;

use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use App\Models\Client;
use App\Models\SaleItems;
use App\Models\VoucherType;
use App\Models\DocumentType;
use App\Models\ClientType;
use Illuminate\Http\Request;
use App\DataTables\SaleDataTable;
use App\Repositories\SaleRepository;
use App\Http\Requests\SaleFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
use Auth;
use DB;
use PDF;

class SaleController extends AppBaseController
{
    /** @var saleRepository */
    private $saleRepository;

    public function __construct(SaleRepository $sale)
    {
        $this->middleware('auth');
        $this->saleRepository = $sale;
    }

    public function index(SaleDataTable $saleDataTable)
    {
        // $result = Sale::with('client', 'voucher_type')->get();
        // dd($result);

        return $saleDataTable->render("movements.sale.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voucherTypes = VoucherType::all();
        $documentTypes = DocumentType::all();
        $clientTypes = ClientType::all();

        $now = new \DateTime();

        $form = [
            'date' => null,
            'subtotal' => 0,
            'igv' => 0,
            'discount' => 0,
            'total' => 0,
            'voucher_type_id' => null,
            'client_id' => null,
            'user_id' => null,
            'voucher_number' => 0,
            'serie' => 0,
            'items' => [
                [
                    'product_id' => null,
                    'price' => 0,
                    'quantity' => 1
                ]
            ]
        ];

        return view('movements.sale.create', compact('voucherTypes', 'documentTypes','clientTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleFormRequest $request)
    {
        
        $result = DB::transaction(function () use($request) {
            
            $now = new \DateTime();
            
            $productSales = $request->only('product_id');
            $quantitySales = $request->only('quantity');

            $saleRequest = $request->only(['voucher_type_id','client_id']);

            $voucher = VoucherType::findOrFail($saleRequest['voucher_type_id']);
            $voucher->quantity =  $voucher->quantity + 1;
            $voucher->update();
            

            $saleRequest['user_id'] = Auth::user()->id;
            $saleRequest['discount'] = 0;
            $saleRequest['voucher_number'] = self::generateNumber($voucher->quantity);
            $saleRequest['serie'] = $voucher->serie;
            $saleRequest['date'] = $now;
            $saleRequest['subtotal'] = 0;
            $saleRequest['igv'] = 0;
            $saleRequest['total'] = 0;

            $sale = Sale::create($saleRequest);

            $subtotal = 0;
            foreach ($productSales['product_id'] as $key => $value) {
                $prod = Product::find($value);
                
                $prod->stock = $prod->stock - $quantitySales['quantity'][$key];
                $prod->update();

                $items = new SaleItems();
                $items->sale_id = $sale->id;
                $items->product_id = $prod->id;
                $items->quantity =  $quantitySales['quantity'][$key];
                $items->price = $prod->price;
                $subtotal += ($prod->price * $quantitySales['quantity'][$key]);
                $items->importe = ($prod->price * $quantitySales['quantity'][$key]);
                $items->save();

            }

            $sale->subtotal = $subtotal;
            $igv = ($subtotal * $voucher->igv)/100;
            $sale->igv = $igv;
            $sale->total = $subtotal + $igv;
            $sale->update();

            return $sale;
        
        });
        
        Flash::success('Venta creada con exito.');

        return redirect(route('venta.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $sale = Sale::where('id', $id)->with('client', 'voucher_type')->first();
        //dd($sale);
        return view('movements.sale.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = $this->saleRepository->findWithoutFail($id);

        $voucherTypes = VoucherType::all();
        $documentTypes = DocumentType::all();
        $clientTypes = ClientType::all();

        if (empty($sale)) {
            Flash::error('Comprobante no encontrado');

            return redirect(route('venta.index'));
        }

        return view('movements.sale.edit', compact('sale','voucherTypes','documentTypes','clientTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleFormRequest $request, $id)
    {
        //dd($request);
        $result = DB::transaction(function () use($request, $id) {
            
            $productSales = $request->only('product_id');
            $quantitySales = $request->only('quantity');
            
            $saleItems = $request->only('sale_items'); 
            
            $sale = Sale::find($id);
            
            $voucher = VoucherType::find($sale->voucher_type_id);
            
            $subtotalOld = 0;
            foreach ($sale->sale_items as $key => $item) {

                if(isset( $saleItems['sale_items'])){

                    if (in_array($item->id, $saleItems['sale_items'])) {
                    
                        $index = array_search($item->product->id, $productSales['product_id'],false);
                        
                        $prod = Product::find($item->product->id);
    
                        $prod->stock = $item->quantity + $prod->stock - $quantitySales['quantity'][$index];
                        $prod->update();
                        
                        $item->sale_id = $sale->id;
                        $item->product_id = $prod->id;
                        $item->quantity =  $quantitySales['quantity'][$index];
                        $item->price = $prod->price;
                        $subtotalOld += ($prod->price * $quantitySales['quantity'][$index]);
                        $item->importe = ($prod->price * $quantitySales['quantity'][$index]);
                        $item->update();
                        
                        unset($productSales['product_id'][$index]);
                        unset($quantitySales['quantity'][$index]);
                        array_slice($productSales['product_id'], $index ,count($productSales['product_id']), false);
                        array_slice($quantitySales['quantity'], $index ,count($quantitySales['quantity']), false);
                
                    }else{
    
                        $product = Product::find($item->product->id);
                        $product->stock = $product->stock + $item->quantity;
                        $product->update();
                        SaleItems::destroy($item->id);
    
                    }
                }else{
                    $product = Product::find($item->product->id);
                    $product->stock = $product->stock + $item->quantity;
                    $product->update();
                    SaleItems::destroy($item->id);
                }

            }

            $subtotalNew =0;
            if(isset( $saleItems['sale_items'])){
                foreach ($productSales['product_id'] as $key => $value) {
                    $prod = Product::find($value);
                    
                    $prod->stock = $prod->stock - $quantitySales['quantity'][$key];
                    $prod->update();

                    $items = new SaleItems();
                    $items->sale_id = $sale->id;
                    $items->product_id = $prod->id;
                    $items->quantity =  $quantitySales['quantity'][$key];
                    $items->price = $prod->price;
                    $subtotalNew += ($prod->price * $quantitySales['quantity'][$key]);
                    $items->importe = ($prod->price * $quantitySales['quantity'][$key]);
                    $items->save();

                }
            }

            $subtotal = $subtotalNew + $subtotalOld;
            $sale->subtotal = $subtotal;
            $igv = ($subtotal * $voucher->igv)/100;
            $sale->igv = $igv;
            $sale->total = $subtotal + $igv;
            $sale->update();

            return $sale;
            
        });
        
        Flash::success('Venta Editada con exito.');

        return redirect(route('venta.index'));
        //dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);

        foreach ($sale->sale_items as $key => $item) {
            $product = Product::find($item->product->id);
            $product->stock = $product->stock + $item->quantity;
            $product->update();
            SaleItems::destroy($item->id);
        }

        if (empty(Sale::destroy($id))) {
            Flash::error('Comprobante no encontrado');

            return redirect(route('venta.index'));
        }

        Flash::success('Comprobante eliminado con exito.');

        return redirect(route('venta.index'));
    }

    public function getProducts(Request $request)
    {
        $term=$request->term;

        if(is_numeric($term)){
            
            $products = Product::select('id','barcode as label', 'name', 'price', 'stock')
                                ->where('barcode', 'LIKE', '%'.$term.'%')
                                ->where('stock','>','0')
                                ->get();

        }else{

            $products = Product::select('id','barcode', 'name as label', 'price', 'stock')
                            ->where('name', 'LIKE', '%'.$term.'%')
                            ->where('stock','>',0)
                            ->get();

        }      

        return response()->json($products);
    }

    public function getClients(Request $request)
    {
        $term=$request->term;

        if(is_numeric($term)){
            
            $clients = Client::select(DB::raw("CONCAT(last_name, ' ', first_name) AS label"), 'id', 'document_number')
                            ->where('document_number', 'LIKE', '%'.$term.'%')
                            ->get();
                            
        }else{
            
            $clients = Client::select(DB::raw("CONCAT(last_name, ' ', first_name) AS label"), 'id', 'document_number')
                            ->where('last_name', 'LIKE', '%'.$term.'%')
                            ->get();
                            
        }      

        return response()->json($clients);
    }

    private function generateNumber($number)
    {
        if ($number >= 99999 && $number < 999999){
            return $number;
        } 
        if ($number >= 9999 && $number < 99999){
            return "0".$number;
        } 
        if ($number >= 999 && $number < 9999){
            return "00".$number;
        } 
        if ($number >= 99 && $number < 999){
            return "000".$number;
        }
        if ($number >= 9 && $number < 99){
            return "0000".$number;
        } 
        if ($number < 9){
            return "00000".$number;
            dd($number);
        } 
    }

    public function report()
    {
        return view('reports.report-sale');

    }

    public function viewReport()
    {	
        $sale = Sale::with('client','voucher_type')->get();

    	if(!empty($sale)){
            return self::createPDF($sale, 'view', 'Reporte-Ventas');
        }else{
            return back();
        }

    }

    public function createPDF($collection, $type, $name)
   	{  
        $now = new \DateTime();

        $data = [
            'sales' => $collection, 
            'date' => $now->format('d-m-Y H:i:s'),

        ];

   		// $pdf = PDF::loadView('reports.templates.template-sale', $data);

   		if($type == 'view'){

            $view = View('reports.templates.template-sale', $data);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());

            return $pdf->stream();

   			//return $pdf->stream($name);

   		}else if($type=='download'){

            $pdf = PDF::loadView('reports.templates.template-sale', $data);

   			return $pdf->download($name.'['. $now->format('d-m-Y H:i:s'). '].pdf');

   		}

   	}

    public function invoice($id)
    {
        $now = new \DateTime();

        $sale = Sale::with('client','voucher_type','sale_items')
            ->where('id', $id)
            ->first();

        $company = Company::first();
        
        $data = [
            'sale' => $sale, 
            'date' => $now->format('d-m-Y H:i:s'),
            'company' => $company,
        ];

        $view = View('movements.sale.invoice', $data);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());

        return $pdf->stream();

    }
}
