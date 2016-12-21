<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unidade;

class Ano extends Model
{

  protected $table = 'anos';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

  public function unidades()
  {
    return $this->has_many('App\Unidade');
  }

}
