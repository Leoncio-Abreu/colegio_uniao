<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
	protected $table = 'noticias';
	protected $fillable = ['visualisar','ativo','titulo','descricao','texto','banner', 'posicao'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at'];

}
