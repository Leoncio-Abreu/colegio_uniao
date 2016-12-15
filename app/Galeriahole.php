<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeriahole extends Model
{

  protected $table = 'galerias';

  protected $fillable = array('ativo','posicao','turma_id','name','description','cover_image');

}
