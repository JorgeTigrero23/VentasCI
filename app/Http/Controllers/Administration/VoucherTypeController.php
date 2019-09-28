<?php

namespace App\Http\Controllers\Administration;

use App\Models\VoucherType;
use Illuminate\Http\Request;
use App\DataTables\VoucherTypeDataTable;
use App\Http\Requests\VoucherTypeFormRequest;
use App\Repositories\VoucherTypeRepository;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;

class VoucherTypeController extends AppBaseController
{
    
    /** @var VoucherTypeRepository */
    private $voucherTypeRepository;

    public function __construct(VoucherTypeRepository $voucherType)
    {
        $this->middleware('auth');
        $this->voucherTypeRepository = $voucherType;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VoucherTypeDataTable $voucherTypeDataTable)
    {
        return $voucherTypeDataTable->render('admin.voucherType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucherType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherTypeFormRequest $request)
    {
        $voucherType = VoucherType::create($request->all());

        Flash::success('Tipo de Comprobante creado con exito.');

        return redirect(route('tipocomprobante.index'));   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucherType = VoucherType::findOrFail($id);

        if (empty($voucherType)) {
            Flash::error('Tipo de Comprobante no encontrado');

            return redirect(route('tipocomprobante.index'));
        }

        return view('admin.voucherType.show')->with('voucherType', $voucherType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucherType = $this->voucherTypeRepository->findWithoutFail($id);

        if (empty($voucherType)) {
            Flash::error('Tipo de Comprobante no encontrado');

            return redirect(route('tipocomprobante.index'));
        }

        return view('admin.voucherType.edit')->with('voucherType', $voucherType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $voucherType = $this->voucherTypeRepository->update($request->all(), $id);

        Flash::success('Tipo de Comprobante modificado con exito.');

        return redirect(route('tipocomprobante.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (empty(VoucherType::destroy($id))) {
            Flash::error('Tipo de Comprobante no encontrado');
        }else{
            Flash::success('Tipo de Comprobante eliminado con exito.');
        }
        return redirect(route('tipocomprobante.index'));

    }
}
