<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anohole extends Model
{

  protected $table = 'anoshole';

  protected $fillable = array('ativa','posicao','name','description','cover_image');
}
