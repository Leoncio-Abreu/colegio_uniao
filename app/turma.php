<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Galeria;

class Turma extends Model
{

  protected $table = 'turmas';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

  public function galerias(){
    return $this->belongsToMany('App\Galeria', 'turma_galeria', 'turma_id','galeria_id');
  }

  public function unidades(){
    return $this->belongsToMany('App\Unidade', 'unidade_turma', 'turma_id','unidade_id');
  }
}
