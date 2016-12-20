<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;

class Gatividade extends Model
{

  protected $table = 'gatividades';

  protected $fillable = array('ativo','posicao', 'name','description','cover_image');

  public function turmas(){
    return $this->belongsToMany('App\Turma', 'turma_galeria', 'galeria_id','turma_id');
  }
  public function albums(){
    return $this->belongsToMany('App\Album', 'galeria_album', 'galeria_id','album_id');
  }
}
