@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ route('usuarios.index') }}">Usuários</a> / Adicionar usuário
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('usuarios.store') }}"  enctype="multipart/form-data">
                {{ csrf_field() }}
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
