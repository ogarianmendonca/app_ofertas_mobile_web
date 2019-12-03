<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Mensagem;
use Illuminate\Support\Facades\DB;

class ApiMensagemController extends Controller
{

    public function mensagem($id)
    {
        $mensagens = Mensagem::join('users', 'users.id', '=', 'mensagens.para')
            ->where('de', $id)
            ->orWhere('para', $id)
            ->select('mensagens.id', 'mensagens.msg_pai', 'mensagens.de', 'users.name as para',
                'mensagens.mensagem', 'mensagens.lida', 'mensagens.created_at as data', 'users.imagem')
            ->get();

        foreach ($mensagens as $msg) {
            $msg->imagem = asset($msg->imagem);

            $data = $this->converteData($msg->data);
            $msg->data = $data;
        }

        return ['mensagens' => $mensagens];
    }

    public function visualizar($id)
    {
        $mensagens = Mensagem::join('users', 'users.id', '=', 'mensagens.para')
            ->where('mensagens.id', $id)
            ->select('mensagens.id', 'mensagens.msg_pai', 'mensagens.de', 'users.name as para',
                'mensagens.mensagem', 'mensagens.lida', 'mensagens.created_at as data', 'users.imagem')
            ->get();

        foreach ($mensagens as $msg) {
            $msg->imagem = asset($msg->imagem);

            $data = $this->converteData($msg->data);
            $msg->data = $data;
        }

        return ['mensagens' => $mensagens];

    }

    public function novaMensagem(Request $request)
    {
        $mensagem = new Mensagem();
        $mensagem['msg_pai'] = null;
        $mensagem['de'] = $request->de;
        $mensagem['para'] = $request->para;
        $mensagem['mensagem'] = $request->mensagem;
        $mensagem['lida'] = false;
        $mensagem['created_at'] = \Carbon\Carbon::now();
        $mensagem['updated_at'] = \Carbon\Carbon::now();
        $mensagem->save();

        $result = "Mensagem enviada com sucesso";

        return ['result' => $result];
    }

    public function excluir($id)
    {
        Mensagem::find($id)->delete();

        $result = "Mensagem excluida com sucesso";

        return ['result' => $result];
    }

    public function converteData($data)
    {
        list($ano, $mes, $diaHora) = explode('-', $data);
        list($dia, $hora) = explode(' ', $diaHora);

        $dataConvertida = $dia . '/' . $mes . '/' . $ano;

        return $dataConvertida;
    }

}