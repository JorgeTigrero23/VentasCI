<?php

namespace App\Http\Controllers\Administration;

use App\Models\ClientType;
use Illuminate\Http\Request;
use App\DataTables\ClientTypeDataTable;
use App\Repositories\ClientTypeRepository;
use App\Http\Requests\ClientTypeFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;

class ClientTypeController extends AppBaseController
{
    /** @var  ClientTypeRepository */
    private $clientTypeRepository;

    public function __construct(ClientTypeRepository $clientType)
    {
        $this->middleware('auth');
        $this->clientTypeRepository = $clientType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientTypeDataTable $clientTypeDataTable)
    {
        return $clientTypeDataTable->render("admin.clientType.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientTypeFormRequest $request)
    {
        $clientType = ClientType::create($request->all());

        Flash::success('Tipo de Cliente creado con exito.');

        return redirect(route('tipocliente.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientType = ClientType::findOrFail($id);

        if (empty($clientType)) {
            Flash::error('Tipo de Cliente no encontrado');

            return redirect(route('tipocliente.index'));
        }

        return view('admin.clientType.show')->with('clientType', $clientType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientType = $this->clientTypeRepository->findWithoutFail($id);

        if (empty($clientType)) {
            Flash::error('Tipo de Cliente no encontrado');

            return redirect(route('tipocliente.index'));
        }

        return view('admin.clientType.edit')->with('clientType', $clientType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function update(ClientTypeFormRequest $request, $id)
    {
        $clientType = $this->clientTypeRepository->update($request->all(), $id);

        Flash::success('Tipo de Cliente modificado con exito.');

        return redirect(route('tipocliente.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientType  $clientType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(ClientType::destroy($id))) {
            Flash::error('Tipo de Cliente no encontrado');

            return redirect(route('tipocliente.index'));
        }

        Flash::success('Tipo de Cliente eliminado con exito.');

        return redirect(route('tipocliente.index'));
    }
}
