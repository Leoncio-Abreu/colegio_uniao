<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;

class Galeria extends Model
{

  protected $table = 'galerias';

  protected $fillable = array('turma_id','name','description','cover_image');

  public function Albums(){
    return $this->belongsToMany('App\Album', 'galeria_album', 'galeria_id','album_id');
  }
}
