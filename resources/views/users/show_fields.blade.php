
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    {!! $user->id !!}<br>

    <!-- First Name Field -->
    {!! Form::label('first_name', 'Nombre:') !!}
    {!! $user->first_name !!}<br>

     <!-- Last Name Field -->
     {!! Form::label('last_name', 'Apellido:') !!}
     {!! $user->last_name !!}<br>

    <!-- Username Field -->
    {!! Form::label('username', 'Nombre de Usuario:') !!}
    {!! $user->username !!}<br>

    <!-- Name Field -->
    {!! Form::label('name', 'Cargo:') !!}
    {!! $user->name !!}<br>

    <!-- Phone Field -->
    {!! Form::label('phone', 'Teléfono:') !!}
    {!! $user->phone !!}<br>

    <!-- Email Field -->
    {!! Form::label('email', 'Email:') !!}
    {!! $user->email !!}<br>

    <!-- Created At Field -->
    {!! Form::label('created_at', 'Created At:') !!}
    {!! $user->created_at !!}<br>

    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! $user->updated_at !!}<br>

    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}<br>--}}
</div>

