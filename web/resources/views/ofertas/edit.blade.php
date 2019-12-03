@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ route('ofertas.index') }}">Ofertas</a> / Editar Oferta
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="" action="{{ route('ofertas.update', $oferta->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include('ofertas._form')
                <button  class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection
