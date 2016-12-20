<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Foto;
use App\Gatividade;

class Album extends Model
{

  protected $table = 'albums';

  protected $fillable = array('ativo','posicao','name','description','cover_image');

  public function atividades(){
    return $this->belongsToMany('App\Gatividade', 'gatividades_album', 'album_id','atividade_id');
  }

  public function fotos(){
    return $this->has_many('App\Foto');
  }
}
