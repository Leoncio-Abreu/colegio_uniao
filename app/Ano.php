<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ano extends Model
{

  protected $table = 'anos';

  protected $fillable = array('ativo','posicao','name','description','filename');

  public function unidades()
  {
    return $this->has_many('App\Unidade');
  }

}
