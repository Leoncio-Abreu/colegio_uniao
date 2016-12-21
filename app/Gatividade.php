<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;

class Gatividade extends Model
{

  protected $table = 'gatividades';

  protected $fillable = array('turma_id', 'ativo','posicao', 'name','description','cover_image');

  public function turmas(){
    return $this->belongsTo('App\Turma');
  }
  public function albums(){
    return $this->has_many('App\Album');
  }
}
