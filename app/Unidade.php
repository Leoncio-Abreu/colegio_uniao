<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Turma;

class Unidade extends Model
{

  protected $table = 'unidades';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

  public function turmas(){
    return $this->belongsToMany('App\Turma', 'unidade_turma', 'unidade_id','turma_id');
  }

  public function anos(){
    return $this->belongsToMany('App\Ano', 'ano_unidade', 'unidade_id','ano_id');
  }
}
