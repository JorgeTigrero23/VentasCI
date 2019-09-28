<form class="form-horizontal" role="form" method="POST" action="{{ action('Administration\OptionMenuController@store') }}">
        {{ csrf_field() }}
        
        <div class="form-group {{ $errors->has('father') ? ' has-error ': '' }}">
        	<label for="padre" class="col-sm-2 control-label">Opción superior</label>
        	<div class="col-sm-6">
        		{{--<select name="padre" id="padre" class="form-control"  autofocus>--}}
                    {{--<option value=""> -- Seleccione Uno -- </option>--}}
                    {{--@foreach($ops as $op)--}}
                        {{--<option value="{{$op->id}}" {{ $op->id==$padre->id ? 'selected' : '' }}> {{$op->nombre}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
                {{$father->name or "Ninguna"}}

                <input type="hidden" name="father" value="{{$father->id or ""}}">

            </div>
        </div>

        <div class="form-group {{ $errors->has('name') ? ' has-error ': '' }}">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" value="{{old('nombre')}}">
            </div>
        </div>

        <div class="form-group {{ $errors->has('description') ? ' has-error ': '' }}">
            <label for="description" class="col-sm-2 control-label">Descripcion</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" id="description" placeholder="Descripcion" value="{{old('descripcion')}}">
            </div>
        </div>

        <div class="form-group {{ $errors->has('path') ? ' has-error ': '' }}">
            <label for="ruta" class="col-sm-2 control-label">Ruta</label>
            <div class="col-sm-6">
                <input name="path" type="text" class="form-control" id="path" placeholder="Ruta" value="{{ old('ruta') }}">
            </div>
        </div>

        <div class="form-group {{ $errors->has('icon_l') ? ' has-error ': '' }}">
            <label for="icon_l" class="col-sm-2 control-label">Icono izquierdo</label>
            <div class="col-sm-10">

                @foreach($iconos as $icono)
                    <label class="radio-inline">
                        <input type="radio" name="icon_l" id="inputID" value="{{$icono}}" {{$icono=="fa-circle-o" ? "checked" : ''}}>
                        <i class="fa {{$icono}}"></i>
                    </label>
                @endforeach

            </div>
        </div>

        <div class="form-group {{ $errors->has('icon_r') ? ' has-error ': '' }}">
            <label for="icon_r" class="col-sm-2 control-label">Icono derecho</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="icon_r" id="inputID" value="" checked>
                    ninguno
                </label>
                @foreach($iconos as $icono)
                    <label class="radio-inline">
                        <input type="radio" name="icon_r" id="inputID" value="{{$icono}}" >
                        <i class="fa {{$icono}}"></i>
                    </label>
                @endforeach
            </div>
        </div>



        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>

                <a href="{{ URL::previous() }}">
                    <button type="button" class="btn btn-danger">
                        Cancelar
                    </button>
                </a>
            </div>
        </div>
    </form>

