@extends('adminlte::layouts.app')

@section('content')

    <div class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Editar opción: {{$option->name}}</strong></h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--Contenido-->
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/option',["id" => $option->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group {{ $errors->has('father') ? ' has-error ': '' }}">
                                <label for="father" class="col-sm-2 control-label">Opción superior</label>
                                <div class="col-sm-6">
                                    {{$father->name or "Ninguna"}}
                                    <input type="hidden" name="father" value="{{$father->id or ""}}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? ' has-error ': '' }}">
                                <label for="name" class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" value="{{$option->name}}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error ': '' }}">
                                <label for="description" class="col-sm-2 control-label">Descripcion</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Descripcion" value="{{$option->description}}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('path') ? ' has-error ': '' }}">
                                <label for="path" class="col-sm-2 control-label">Ruta</label>
                                <div class="col-sm-6">
                                    <input name="path" type="text" class="form-control" id="path" placeholder="Ruta" value="{{$option->path}}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('icon_l') ? ' has-error ': '' }}">
                                <label for="icon_l" class="col-sm-2 control-label">Icono izquierdo</label>
                                <div class="col-sm-10">

                                    @foreach($icons as $icon)
                                        <label class="radio-inline">
                                            <input type="radio" name="icon_l" id="inputID" value="{{$icon}}" {{$icon==$option->icon_l ? "checked" : ''}}>
                                            <i class="fa {{$icon}}"></i>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('icon_r') ? ' has-error ': '' }}">
                                <label for="icon_r" class="col-sm-2 control-label">Icono derecho </label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="icon_r" id="inputID" value="" {{$option->icono_r=="" ? "checked" : ''}}>
                                        ninguno
                                    </label>
                                    @foreach($icons as $icon)
                                        <label class="radio-inline">
                                            <input type="radio" name="icon_r" id="inputID" value="{{$icon}}" {{$icon==$option->icono_r ? "checked" : ''}}>
                                            <i class="fa {{$icon}}"></i>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Editar
                                    </button>

                                    <a href="{{ URL::previous() }}">

                                        <button type="button" class="btn btn-danger">
                                            Cancelar
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    <!--Fin Contenido-->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
