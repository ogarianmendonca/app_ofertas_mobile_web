<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Mensagem
 * @package App
 */
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

    /**
     * @return HasOne
     */
    public function usuario_para()
    {
        return $this->hasOne(User::class, 'id', 'para');
    }

    /**
     * @return HasOne
     */
    public function usuario_de()
    {
        return $this->hasOne(User::class, 'id', 'de');
    }
}