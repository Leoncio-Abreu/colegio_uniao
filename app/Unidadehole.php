<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidadehole extends Model
{

  protected $table = 'unidadeshole';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

}
