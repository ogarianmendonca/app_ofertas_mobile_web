<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\User;
use App\Mensagem;
use Illuminate\View\View;

/**
 * Class MensagemController
 * @package App\Http\Controllers
 */
class MensagemController extends Controller
{
    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $mensagens = Mensagem::all();
        $usuario = \Auth::user();
        
        return view('mensagens.index', compact('mensagens', 'usuario'));
    }

    /**
     * @return Factory|Application|View
     */
    public function create()
    {
        $para = User::all();

        return view('mensagens.create', compact('para'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
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

    /**
     * @param $id
     * @return Factory|Application|View
     */
    public function visualizar($id)
    {
        $msg = Mensagem::find($id);
        $de = \Auth::user();
        $msg_pai = Mensagem::find($msg->msg_pai);

        //atualiza mensagem como lida
        $this->lida($id);
        return view('mensagens.visualizar', compact('msg', 'de', 'msg_pai'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function responder(Request $request)
    {
        $mensagem = $request->all();

        $mensagem['lida'] = false;

        Mensagem::create($mensagem);
        \Session::flash('flash_message', 'Mensagem enviada com sucesso');
        return redirect()->route('mensagens.index');
    }

    /**
     * @param $id
     */
    public function lida($id)
    {
        $mensagem['lida'] = true;
        Mensagem::find($id)->update($mensagem);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Mensagem::find($id)->delete();
        \Session::flash('flash_message', 'Mensagem excluída com sucesso');
        return redirect()->route('mensagens.index');
    }
}