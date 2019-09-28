<?php

namespace App\Http\Controllers\Maintenances;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
use PDF;

class ProductController extends AppBaseController
{
    /** @var productRepository */
     private $productRepository;

    public function __construct(ProductRepository $prod)
    {
        $this->middleware('auth');
        $this->productRepository = $prod;
    }

    public function index(ProductDataTable $productDataTable)
    {
        // $result = Product::with('category')->get();
        // dd($result[0]->category);
        return $productDataTable->render('maintenances.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('maintenances.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $product = Product::create($request->all());

        Flash::success('Producto creado con exito.');

        return redirect(route('producto.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->where('id', $id)->first();

        if (empty($product)) {
            Flash::error('Producto no encontrado');

            return redirect(route('producto.index'));
        }

        return view('maintenances.product.show')->with('product', $product);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        $categories = Category::all();

        if (empty($product)) {
            Flash::error('Producto no encontrado');

            return redirect(route('producto.index'));
        }

        return view('maintenances.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        $product = $this->productRepository->update($request->all(), $id);

        Flash::success('Producto modificado con exito.');

        return redirect(route('producto.index'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(Product::destroy($id))) {
            Flash::error('Producto no encontrado');

            return redirect(route('producto.index'));
        }

        Flash::success('Producto eliminado con exito.');

        return redirect(route('producto.index'));
    }

    public function report()
    {
        return view('reports.report-product');

    }

    public function viewReport()
    {	
        $products = Product::all();

    	if(!empty($products)){
            return self::createPDF($products, 'view', 'Reporte-Producto');
        }else{
            return back();
        }

    }

    public function createPDF($collection, $type, $name)
   	{  
        $now = new \DateTime();

        $data = [
            'products' => $collection, 
            'date' => $now->format('d-m-Y H:i:s'),

        ];

   		// $pdf = PDF::loadView('reports.templates.template-product', $data);

   		if($type == 'view'){

            $view = View('reports.templates.template-product', $data);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());

            return $pdf->stream();

   			//return $pdf->stream($name);

   		}else if($type=='download'){

            $pdf = PDF::loadView('reports.templates.template-product', $data);

   			return $pdf->download($name.'['. $now->format('d-m-Y H:i:s'). '].pdf');

   		}

   	}
}
