@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/') }}">Home</a> / Ofertas
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('ofertas.create') }}" class="btn btn-info">Add Oferta</a>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Validade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ofertas as $oferta)
                    <tr>
                        <td><img height="30" src="{{ asset($oferta->imagem) }}"/></td>
                        <td>{{ $oferta->titulo }}</td>
                        <td>{{ $oferta->descricao }}</td>
                        <td>{{ $oferta->valor_formatado }}</td>
                        <td>{{ date('d/m/Y', strtotime($oferta->validade)) }}</td>
                        <td>
                            <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="post">
                                <a href="{{ route('ofertas.edit', $oferta->id) }}" class="btn btn-warning">Editar</a>
                                
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" >Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
