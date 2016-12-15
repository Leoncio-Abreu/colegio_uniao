<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turmahole extends Model
{

  protected $table = 'turmashole';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

}
