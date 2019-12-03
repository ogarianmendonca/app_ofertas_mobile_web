<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mensagem;

class MensagemController extends Controller
{

    public function index()
    {
        $mensagens = Mensagem::all();
        $usuario = \Auth::user();
        
        return view('mensagens.index', compact('mensagens', 'usuario'));
    }

    public function create()
    {
        $para = User::all();

        return view('mensagens.create', compact('para'));
    }

    public function store(Request $request)
    {
        $de = \Auth::user();
        $msg = $request->all();

        $mensagem['de'] = $de['id'];
        $mensagem['para'] = $msg['para'];
        $mensagem['mensagem'] = $msg['mensagem'];
        $mensagem['lida'] = false;

        Mensagem::create($mensagem);
        \Session::flash('flash_message', 'Mensagem enviada com sucesso');
        return redirect()->route('mensagens.index');
    }

    public function visualizar($id)
    {
        $msg = Mensagem::find($id);
        $de = \Auth::user();
        $msg_pai = Mensagem::find($msg->msg_pai);

        //atualiza mensagem como lida
        $this->lida($id);
        return view('mensagens.visualizar', compact('msg', 'de', 'msg_pai'));
    }

    public function responder(Request $request)
    {
        $mensagem = $request->all();

        $mensagem['lida'] = false;

        Mensagem::create($mensagem);
        \Session::flash('flash_message', 'Mensagem enviada com sucesso');
        return redirect()->route('mensagens.index');
    }

    public function lida($id)
    {
        $mensagem['lida'] = true;
        Mensagem::find($id)->update($mensagem);
    }

    public function destroy($id)
    {
        Mensagem::find($id)->delete();
        \Session::flash('flash_message', 'Mensagem excluída com sucesso');
        return redirect()->route('mensagens.index');
    }

}