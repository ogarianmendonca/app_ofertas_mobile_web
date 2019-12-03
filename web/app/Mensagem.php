<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'mensagens';

    protected $fillable =[
        'msg_pai',
        'de',
        'para',
        'mensagem',
        'lida'
    ];

    public function usuario_para()
    {
        return $this->hasOne(User::class, 'id', 'para');
    }

    public function usuario_de()
    {
        return $this->hasOne(User::class, 'id', 'de');
    }

}