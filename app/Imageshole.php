<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imageshole extends Model
{
  
  protected $table = 'imageshole';
  
  protected $fillable = array('ativo','posicao','description','image');
  
}
