@if(!isset($create))
    <div class="form-group col-sm-12">
        <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Editar también contraseña
        </a>
    </div>
@endif


<div class="{{ !isset($create) ? "collapse" : '' }}" id="collapseExample">
    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', 'Contraseña:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password_confirmation', 'Confirmar contraseña:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Imagen Field -->
<div class="form-group col-sm-12">
    {!! Form::label('imagen', 'Imagen:') !!}
    <input id="files" name="image" type="file">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>

@push('scripts')
<script>
    $(function () {
        $("#rols").select2();

        var $input = $("#files");
        $input.fileinput({
            {{--uploadUrl: "{{route('api.temp_files.multi_store',Auth::user()->id)}}", // server upload action--}}
            //            uploadAsync: false,
            showUpload: false, // hide upload button
            showRemove: false, // hide remove button
//            minFileCount: 1,
//            maxFileCount: 5,
            allowedFileExtensions: ["png","bmp","gif","jpg","pdf"],
        });
    })
</script>
@endpush