<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ClientDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        // return $dataTable->addColumn('action', 'users.datatables_actions');
        return $dataTable->addColumn('action', 'maintenances.client.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {   
        //print_r( $model->with('clientType')); die;
        return $model->with('client_type', 'document_type')->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '15%','title' => 'Acción'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'responsive'   => true,
                'language' => ['url' => asset('plugins/DataTables/Spanish.json')],
                'buttons' => [
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                "name" => "first_name",
                "title" => "Nombres",
                "data" => "first_name"
            ],
            [
                "name" => "last_name",
                "title" => "Apellidos",
                "data" => "last_name"
            ],
            [
                "name" => "client_type.name",
                "title" => "Tipo de Cliente",
                "data" => "client_type.name"
            ],
            [
                "name" => "document_type.name",
                "title" => "Tipo de Documento",
                "data" => "document_type.name"
            ],
            [
                "name" => "document_number",
                "title" => "Número De Documento",
                "data" => "document_number"
            ],
            [
                "name" => "phone",
                "title" => "Número De Teléfono",
                "data" => "phone"
            ],
            [
                "name" => "mail",
                "title" => "Correo",
                "data" => "mail"
            ],
            [
                "name" => "address",
                "title" => "Dirección",
                "data" => "address"
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clientdatatable_' . time();
    }
}