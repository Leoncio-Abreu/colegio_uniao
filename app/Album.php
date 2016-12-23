<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Foto;
use App\Gatividade;

class Album extends Model
{

  protected $table = 'albums';

  protected $fillable = array('atividade_id', 'ativo','posicao','name','description','cover_image');

  public function atividades(){
    return $this->belongsTo('App\Gatividade');
  }

  public function fotos(){
    return $this->has_many('App\Foto');
  }
}
