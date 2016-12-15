<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unidade;

class Ano extends Model
{

  protected $table = 'anos';

  protected $fillable = array('name','description','cover_image');

  public function unidades()
  {
    return $this->belongsToMany('App\Unidade', 'ano_unidade', 'ano_id','unidade_id');
  }

}
