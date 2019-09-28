<?php

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new \DateTime();

        \DB::table('options')->insert([
            0 => [
                'id' => 1,
                'father' => NULL,
                'name' => 'Administrador',
                'path' => Null,
                'description' => 'Opciones del Administrador',
                'icon_l' => 'fa-folder',
                'icon_r' => 'fa-angle-left',
                'order' => 0,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            1 => [
                'id' => 2,
                'father' => 1,
                'name' => 'Configuraciones',
                'path' => 'admin/configurations',
                'description' => 'Administración de las Configuraciones',
                'icon_l' => 'fa fa-circle-o',
                'icon_r' => '',
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            2 => [
                'id' => 3,
                'father' => 1,
                'name' => 'Usuarios',
                'path' => 'admin/users',
                'description' => 'Administración de Usuarios',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            3 => [
                'id' => 4,
                'father' => 1,
                'name' => 'Opciones',
                'path' => 'admin/option',
                'description' => 'Administración de las Opciones',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            4 => [
                'id' => 5,
                'father' => 1,
                'name' => 'Roles',
                'path' => 'admin/rols',
                'description' => 'Administración de Roles',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            5=> [
                'id' => 6,
                'father' => 1,
                'name' => 'Tipo de Documento',
                'path' => 'admin/tipodocumento',
                'description' => 'Administración de Tipo de Documento',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            6=> [
                'id' => 7,
                'father' => 1,
                'name' => 'Tipo de Comprobante',
                'path' => 'admin/tipocomprobante',
                'description' => 'Administración de Roles',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            7=> [
                'id' => 8,
                'father' => 1,
                'name' => 'Tipo de Cliente',
                'path' => 'admin/tipocliente',
                'description' => 'Administración de Roles',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 7,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            8=> [
                'id' => 9,
                'father' => NULL,
                'name' => 'Mantenimientos',
                'path' => 'mantenimiento',
                'description' => 'Mantenimiento',
                'icon_l' => 'fa-folder',
                'icon_r' => 'fa-angle-left',
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            9=> [
                'id' => 10,
                'father' => 9,
                'name' => 'Catégorias',
                'path' => 'mantenimiento/categoria',
                'description' => 'Mantenimiento de categorías de productos',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            10=> [
                'id' => 11,
                'father' => 9,
                'name' => 'Productos',
                'path' => 'mantenimiento/producto',
                'description' => 'Mantenimiento de productos',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            11=> [
                'id' => 12,
                'father' => 9,
                'name' => 'Clientes',
                'path' => 'mantenimiento/cliente',
                'description' => 'Mantenimiento de clientes',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            12=> [
                'id' => 13,
                'father' => NULL,
                'name' => 'Movimientos',
                'path' => 'movimiento',
                'description' => 'Movimientos',
                'icon_l' => 'fa-folder',
                'icon_r' => 'fa-angle-left',
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            13 => [
                'id' => 14,
                'father' => 13,
                'name' => 'Ventas',
                'path' => 'movimiento/venta',
                'description' => 'Movimiento de las Ventas',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            14=> [
                'id' => 15,
                'father' => NULL,
                'name' => 'Reportes',
                'path' => 'reporte',
                'description' => 'Reportes',
                'icon_l' => 'fa-folder',
                'icon_r' => 'fa-angle-left',
                'order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            15=> [
                'id' => 16,
                'father' => 15,
                'name' => 'Categorías',
                'path' => 'reporte/categorias',
                'description' => 'Reportes Categorías de Productos',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            16 => [
                'id' => 17,
                'father' => 15,
                'name' => 'Productos',
                'path' => 'reporte/productos',
                'description' => 'Reportes de Productos',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            17 => [
                'id' => 18,
                'father' => 15,
                'name' => 'Clientes',
                'path' => 'reporte/clientes',
                'description' => 'Reportes de Clientes',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            18 => [
                'id' => 19,
                'father' => 15,
                'name' => 'Ventas',
                'path' => 'reporte/ventas',
                'description' => 'Reportes de Ventas',
                'icon_l' => 'fa-circle-o',
                'icon_r' => NULL,
                'order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            19 => [
                'id' => 20,
                'father' => NULL,
                'name' => 'Empresa',
                'path' => 'empresa',
                'description' => 'Datos de la Empresa.',
                'icon_l' => 'fa-asterisk',
                'icon_r' => NULL,
                'order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            20 => [
                'id' => 21,
                'father' => NULL,
                'name' => 'Acerca de...',
                'path' => 'acercade',
                'description' => 'Acerca del Sistema',
                'icon_l' => 'fa-info-circle',
                'icon_r' => NULL,
                'order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => NULL
            ],
            // 21 => [
            //     'id' => 22,
            //     'father' => NULL,
            //     'name' => 'Ayuda',
            //     'path' => 'ayuda',
            //     'description' => 'Ayuda',
            //     'icon_l' => 'fa-plus-square',
            //     'icon_r' => NULL,
            //     'order' => 5,
            //     'created_at' => $now,
            //     'updated_at' => $now,
            //     'deleted_at' => NULL
            // ]
        ]);
    }
}
