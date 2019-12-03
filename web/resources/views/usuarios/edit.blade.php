@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ route('usuarios.index') }}">Usuários</a> / Editar Usuário
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="{{ route('usuarios.update', $user->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include('usuarios._form')
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection