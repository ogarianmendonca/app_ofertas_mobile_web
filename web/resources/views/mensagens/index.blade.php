@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/') }}">Home</a> / Mensagens
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('mensagens.create') }}" class="btn btn-info">Nova Mensagem</a>
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
                        <th>Para</th>
                        <th>Status</th>
                        <th>Data envio</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mensagens as $msg)
                        @if($msg->para == $usuario->id || $msg->de == $usuario->id)
                            <tr>
                                @if($msg->usuario_para->name == $usuario->name)
                                    <td class="text-success">Você</td>
                                @else
                                    <td class="text-info">{{$msg->usuario_para->name}}</td>
                                @endif

                                @if($msg->lida == false)
                                    <td class="text-danger">Não Lida</td>
                                @else
                                    <td>Lida</td>
                                @endif
                                
                                <td>{{ date('d/m/Y', strtotime($msg->created_at)) }}</td>
                                <td>
                                    <form action="{{ route('mensagens.destroy', $msg->id) }}" method="post">
                                        <a href="{{ route('mensagens.visualizar', $msg->id) }}" class="btn btn-info">Visualizar</a>
                                        
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" >Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection