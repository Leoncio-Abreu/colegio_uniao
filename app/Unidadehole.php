<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidadehole extends Model
{

  protected $table = 'unidadeshole';

  protected $fillable = array('ano_id','ativo','posicao','name','description','cover_image');

}
