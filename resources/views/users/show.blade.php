@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Usuario
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Usuario
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" >
                    <div class="col-sm-3">
                            @if(isset($user->image))
                                <img src="{{ asset('profile/'. $user->image) }}" alt="{{$user->name}}" class="img-responsive">
                            @else
                                <img src="{{ asset('img/avatar_none.png') }}" class="user-image" alt="User Image"/>
                            @endif
                    </div>
                    <div class="col-sm-9">

                        @include('users.show_fields')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="{!! route('users.index') !!}" class="btn btn-default">Volver</a>
            </div>
        </div>
    </div>
@endsection
