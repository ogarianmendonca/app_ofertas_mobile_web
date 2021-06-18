<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ApiUsuarioController
 * @package App\Http\Controllers
 */
class ApiUsuarioController extends Controller
{
    /**
     * @param $email
     * @param $password
     * @return array
     */
    public function getUsuario($email, $password)
    {
        $users = User::where('email', $email)->get();
        $users[0]['imagem'] = asset($users[0]['imagem']);

        $msgError = 'Ocorreu um error, tente novamente mais tarde!';

        if (\Hash::check($password, $users[0]['password'])) {
            return ['users' => $users, 'success' => true];
        }else{
            return ['msgError' => $msgError, 'success' => false];
        }
    }

    /**
     * @return User[]|Collection
     */
    public function usuarios()
    {
        $usuarios = User::all();

        foreach($usuarios as  $user){
            $user->imagem = asset($user->imagem);
        }

        return $usuarios;
    }
}