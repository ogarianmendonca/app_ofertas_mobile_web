@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <a href="{{ url('/') }}">Home</a> / <a href="{{ route('mensagens.index') }}">Mensagens</a> / Visualizar
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if($msg_pai)
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($msg_pai->usuario_para->name == $de->name)
                        <span>De: {{$msg_pai->usuario_de->name}}</span>
                    @else
                        <span>Para: {{$msg_pai->usuario_para->name}}</span>
                    @endif
                    <span class="pull-right text-warning">Mensagem Anterior</span>
                </div>
                <div class="panel-body">
                    <p>{{ $msg_pai->mensagem }}</p>
                    <span class="pull-right">Data envio: {{ date('d/m/Y', strtotime($msg_pai->created_at)) }}</span>
                </div>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($msg->usuario_para->name == $de->name)
                        <span>De: {{$msg->usuario_de->name}}</span>
                    @else
                        <span>Para: {{$msg->usuario_para->name}}</span>
                    @endif
                </div>
                <div class="panel-body">
                    <p>{{ $msg->mensagem }}</p>
                    <span class="pull-right">Data envio: {{ date('d/m/Y', strtotime($msg->created_at)) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="" action="{{ route('mensagens.responder') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control" name="msg_pai" value="{{$msg->id}}" >
                        <input type="hidden" class="form-control" name="de" value="{{$de->id}}" >
                        <input type="hidden" class="form-control" name="para" value="{{$msg->de}}" >

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Para</label>
                                    <input type="text" class="form-control" value="{{$msg->usuario_de->name}}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Mensagem</label>
                                    <textarea class="form-control" name="mensagem" cols="20" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                        <button  class="btn btn-success">Responder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection