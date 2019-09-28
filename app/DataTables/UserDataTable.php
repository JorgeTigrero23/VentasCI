<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
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
                "title" => "Nombre",
                "data" => "first_name"
            ],
            [
                "name" => "last_name",
                "title" => "Apellido",
                "data" => "last_name"
            ],
            [
                "name" => "phone",
                "title" => "Teléfono",
                "data" => "phone"
            ],
            [
                "name" => "username",
                "title" => "Usuario",
                "data" => "username"
            ],
            [
                "name" => "name",
                "title" => "Cargo",
                "data" => "name"
            ],
            [
                "name" => "email",
                "title" => "Correo",
                "data" => "email"
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
        return 'usersdatatable_' . time();
    }
}