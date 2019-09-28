@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Acerca del Sistema
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div class="form-group col-md-12">
                        <div class="text-center"><h3> Acerca del Sistema </h3></div>
                        <br>
                        <div class="text-center">
                                <p><strong>Desarrollado por: </strong></p>
                                <p><strong>Nombre: </strong> Jorge Tigrero</p>
                                <p><strong>Correo: </strong> jorge.tigrero.dev.23@gmail.com</p>
                                <p>Para mayor información o reportar un problema comunicarse al correo.</p>
                            </div>
                        <br>
                        <strong> Permite realizar los siguiente: </strong>
                        <br>
                        <strong>Administración</strong>
                        <p>1. Ingreso, Edición y Eliminación de Tipo de Clientes</p>
                        <p>2. Ingreso, Edición y Eliminación de Tipo de Documento</p>
                        <p>3. Ingreso, Edición y Eliminación de Tipo de Comprobante</p>
                        <p>4. Configuración del Sistema</p>
                        <p>5. Configurar opciones del Sistema</p>
                        <p>6. Ingreso, Edición y Eliminación de Usuarios</p>
                        <p>7. Ingreso, Edición y Eliminación de Roles</p>
                        <strong>Mantenimiento</strong>
                        <p>1. Ingreso, Edición y Eliminación de Categorías de Productos.</p>
                        <p>2. Ingreso, Edición y Eliminación de Productos</p>
                        <p>3. Ingreso, Edición y Eliminación de Clientes</p>
                        <strong>Movimientos</strong>
                        <p>1. Ingreso, Edición y Eliminación de Ventas.</p>
                        <strong>Reportes</strong>
                        <p>1. Reportes de Categoría de Productos</p>
                        <p>2. Reportes de Productos</p>
                        <p>3. Reportes de Clientes</p>
                        <p>4. Reportes de Ventas</p>
                        <strong>Acerca de</strong>
                        <p>1. Muestra información del sistema</p>
                        {{-- <strong>Ayuda</strong>
                        <p>1. Muestra una ayuda de como usar el Sistema</p> --}}
                    </div>
                    {{-- <a href="{!! route('dashboard.index') !!}" class="btn btn-default">Volver</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

