<?php

namespace App\Http\Controllers\Maintenances;

use App\Models\Client;
use App\Models\ClientType;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\DataTables\ClientDataTable;
use App\Repositories\ClientRepository;
use App\Http\Requests\ClientFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;
use PDF;

class ClientController extends AppBaseController
{
    
    /** @var clientRepository */
    private $clientRepository;

    public function __construct(ClientRepository $client)
    {
        $this->middleware('auth');
        $this->clientRepository = $client;
    }

    public function index(ClientDataTable $clientDataTable)
    {
        // $result = Client::with('clientType')->get();
        // dd($result);
        return $clientDataTable->render('maintenances.client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientTypes = ClientType::all();
        $documentTypes = DocumentType::all();
        return view('maintenances.client.create', compact('clientTypes','documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientFormRequest $request)
    {
        if($request->ajax()){

            $client = Client::create($request->all());

            return response()->json([
                    "status" => "success",
                    "message" => "Cliente creado con exito.",
                    "data" => $client
                    ]);
        }

        Client::create($request->all());

        Flash::success('Cliente creado con exito.');

        return redirect(route('cliente.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientController  $clientController
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where('id', $id)->with('client_type', 'document_type')->first();

        //dd($client);

        if (empty($client)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('cliente.index'));
        }

        return view('maintenances.client.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientController  $clientController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $clientTypes = ClientType::all();
        $documentTypes = DocumentType::all();

        if (empty($client)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('cliente.index'));
        }

        return view('maintenances.client.edit', compact('client', 'clientTypes', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientController  $clientController
     * @return \Illuminate\Http\Response
     */
    public function update(ClientFormRequest $request, $id)
    {
        $client = $this->clientRepository->update($request->all(), $id);

        Flash::success('Cliente modificado con exito.');

        return redirect(route('cliente.index'));    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientController  $clientController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(Client::destroy($id))) {
            Flash::error('Cliente no encontrado');

            return redirect(route('cliente.index'));
        }

        Flash::success('Cliente eliminado con exito.');

        return redirect(route('cliente.index')); 
    }

    public function report()
    {
        return view('reports.report-client');

    }

    public function viewReport()
    {	
        $clients = Client::all();

    	if(!empty($clients)){
            return self::createPDF($clients, 'view', 'Reporte-Clientes');
        }else{
            return back();
        }

    }

    public function createPDF($collection, $type, $name)
   	{  
        $now = new \DateTime();

        $data = [
            'clients' => $collection, 
            'date' => $now->format('d-m-Y H:i:s'),

        ];

   		//$pdf = PDF::loadView('reports.templates.template-client', $data);

   		if($type == 'view'){
            
            $view = View('reports.templates.template-client', $data);
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());

            return $pdf->stream();

            // $pdf->setPaper('A4', 'portrait');
   			// return $pdf->stream($name);

   		}else if($type=='download'){

            $pdf = PDF::loadView('reports.templates.template-client', $data);
   			return $pdf->download($name.'['. $now->format('d-m-Y H:i:s'). '].pdf');

   		}

   	}
}