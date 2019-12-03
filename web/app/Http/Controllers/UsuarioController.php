<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('usuarios.index', compact('users'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->all();
    
        if($dados['password'] == $dados['password_confirmation']){

            if($request->hasFile('imagem')){
                $imagem = $request->file('imagem');
                $ext = $imagem->guessClientExtension();
                $diretorio = "img/";
                $nomeImg = 'img_' .rand(111,999) . '.' . $ext;
                $imagem->move($diretorio, $nomeImg);
                $dados['imagem'] = $diretorio . $nomeImg;
            }

            $dados['password'] = bcrypt($dados['password']);

            User::create($dados);
            \Session::flash('flash_message', 'Usuários adicionado com sucesso');
            return redirect()->route('usuarios.index');
        } else {
            \Session::flash('flash_message', 'Ocorreu um erro, tente novamente mais tarde');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $ext = $imagem->guessClientExtension();
            $diretorio = "img/";
            $nomeImg = 'img_' .rand(111,999) . '.' . $ext;
            $imagem->move($diretorio, $nomeImg);
            $dados['imagem'] = $diretorio . $nomeImg;
        }

        if($dados['password'] == ''){
            unset($dados['password']);
        } else {
            $dados['password'] = bcrypt($dados['password']);
        }

        User::find($id)->update($dados);
        \Session::flash('flash_message', 'Usuários editado com sucesso');
        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        \Session::flash('flash_message', 'Usuários excluído com sucesso');
        return redirect()->route('usuarios.index');
    }
}