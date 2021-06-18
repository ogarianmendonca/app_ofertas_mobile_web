<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Oferta
 * @package App
 */
class Oferta extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'validade',
        'valor',
        'valor_formatado',
        'imagem'
    ];
}
