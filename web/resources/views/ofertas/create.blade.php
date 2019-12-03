@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ route('ofertas.index') }}">Ofertas</a> / Add Oferta
        </div>
    </div>
    <br>

    @if(Session::has('flash_message'))
        <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('flash_message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="" action="{{ route('ofertas.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('ofertas._form')
                <button  class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection
