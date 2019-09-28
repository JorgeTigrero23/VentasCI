<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'maintenances.product.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->with('category')->orderBy('updated_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        //dd($this->builder()->with('category'));
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
                "name" => "barcode",
                "title" => "Código de Barra",
                "data" => "barcode"
            ],
            [
                "name" => "name",
                "title" => "Nombre",
                "data" => "name"
            ],
            [
                "name" => "description",
                "title" => "Descripción",
                "data" => "description"
            ],
            [
                "name" => "price",
                "title" => "Precio",
                "data" => "price"
            ],
            [
                "name" => "stock",
                "title" => "Stock",
                "data" => "stock"
            ],
            [
                "name" => "category.name",
                "title" => "Categoría",
                "data" => "category.name"
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
        return 'productdatatable_' . time();
    }
}