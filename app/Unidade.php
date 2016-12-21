<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Turma;

class Unidade extends Model
{

  protected $table = 'unidades';

  protected $fillable = array('ano_id', 'ativo','posicao','name','description','cover_image');

  public function turmas(){
    return $this->has_many('App\Turma');
  }

  public function anos(){
    return $this->belongsTo('App\Ano');
  }
}
