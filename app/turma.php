<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gatividade;
use App\Unidade;

class Turma extends Model
{

  protected $table = 'turmas';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

  public function unidades(){
    return $this->belongsToMany('App\Unidade', 'unidade_turma', 'turma_id','unidade_id');
  }

  public function atividades(){
    return $this->belongsToMany('App\Gatividade', 'turma_gatividade', 'turma_id','atividade_id');
  }

}
