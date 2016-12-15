<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Galeria;

class Turma extends Model
{

  protected $table = 'turmas';

  protected $fillable = array('name','description','cover_image');

  public function Galerias(){
    return $this->belongsToMany('App\Galeria', 'turma_galeria', 'turma_id','galeria_id');
  }
}
