<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albumhole extends Model
{

  protected $table = 'albumshole';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

}
