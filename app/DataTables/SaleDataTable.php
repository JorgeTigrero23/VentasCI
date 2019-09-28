<?php

namespace App\DataTables;

use App\Models\Sale;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SaleDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'movements.sale.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sale $model)
    {
        //return $model->newQuery();
       return $model->with('voucher_type', 'client')->orderBy('created_at', 'desc') ;
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
                "name" => "id",
                "title" => "Cliente",
                "data" => "id",
                "visible" => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                "name" => "client.last_name",
                "title" => "Cliente",
                "data" => "client.last_name"
            ],
            [
                "name" => "voucher_type.name",
                "title" => "Tipo de Comprobante",
                "data" => "voucher_type.name"
            ],
            [
                "name" => "voucher_number",
                "title" => "Número de Comprobante",
                "data" => "voucher_number"
            ],
            [
                "name" => "date",
                "title" => "Fecha",
                "data" => "date"
            ],
            [
                "name" => "total",
                "title" => "Total",
                "data" => "total"
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
        return 'saledatatable_' . time();
    }
}