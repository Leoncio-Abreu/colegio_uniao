<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
  
  protected $table = 'fotos';
  
  protected $fillable = array('album_id', 'ativo','posicao','description','image');

  public function albums(){
    return $this->belongsTo('App\Album');
  }
  
}
