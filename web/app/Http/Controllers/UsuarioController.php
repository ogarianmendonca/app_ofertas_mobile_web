<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $users = User::all();

        return view('usuarios.index', compact('users'));
    }

    /**
     * @return Factory|Application|View
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
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

    /**
     * @param $id
     * @return Factory|Application|View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('usuarios.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
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

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        \Session::flash('flash_message', 'Usuários excluído com sucesso');
        return redirect()->route('usuarios.index');
    }
}