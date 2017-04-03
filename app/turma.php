<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{

  protected $table = 'turmas';

  protected $fillable = array('atividade_id', 'ativo','posicao','name','description','filename');

  public function unidades(){
    return $this->belongsTo('App\Unidade');
  }

  public function fotos(){
    return $this->has_many('App\Foto');
  }

}
