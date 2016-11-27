<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
	protected $table = 'atividades';
	protected $fillable = ['visualisar','ativo','titulo','descricao','texto','banner', 'posicao'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at', 'visualisar'];
}
