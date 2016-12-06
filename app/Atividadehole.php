<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividadehole extends Model
{
	protected $table = 'atividadeshole';
	protected $fillable = ['visualisar','ativo','titulo','descricao','texto','banner', 'posicao'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at', 'visualisar'];
}
