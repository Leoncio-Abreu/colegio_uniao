<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Turma;

class Unidade extends Model
{

  protected $table = 'unidades';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

  public function Turmas(){
    return $this->belongsToMany('App\Turma', 'unidade_turma', 'unidade_id','turma_id');
  }
}
