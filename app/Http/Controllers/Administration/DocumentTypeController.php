<?php

namespace App\Http\Controllers\Administration;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\DataTables\DocumentTypeDataTable;
use App\Repositories\DocumentTypeRepository;
use App\Http\Requests\DocumentTypeFormRequest;
use App\Http\Controllers\AppBaseController;
use Response;
use Flash;

class DocumentTypeController extends AppBaseController
{

    /** @var  DocumentTypeRepository */
    private $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentType)
    {
        $this->middleware('auth');
        $this->documentTypeRepository = $documentType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentTypeDataTable $documentTypeDataTable)
    {
        return $documentTypeDataTable->render('admin.documentType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documentType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeFormRequest $request)
    {
        $documentType = DocumentType::create($request->all());

        Flash::success('Tipo de Documento creado con exito.');

        return redirect(route('tipodocumento.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documentType = DocumentType::findOrFail($id);

        if (empty($documentType)) {
            Flash::error('Tipo de Documento no encontrado');

            return redirect(route('tipodocumento.index'));
        }

        return view('admin.documentType.show')->with('documentType', $documentType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentType = $this->documentTypeRepository->findWithoutFail($id);

        if (empty($documentType)) {
            Flash::error('Tipo de Documento no encontrado');

            return redirect(route('tipodocumento.index'));
        }

        return view('admin.documentType.edit')->with('documentType', $documentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentTypeFormRequest $request, $id)
    {
        $documentType = $this->documentTypeRepository->update($request->all(), $id);

        Flash::success('Tipo de Documento modificado con exito.');

        return redirect(route('tipodocumento.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty(DocumentType::destroy($id))) {
            Flash::error('Tipo de Documento no encontrado');

            return redirect(route('tipodocumento.index'));
        }

        Flash::success('Tipo de Documento eliminado con exito.');

        return redirect(route('tipodocumento.index'));
    }
}
