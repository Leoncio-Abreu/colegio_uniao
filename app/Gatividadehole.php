<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gatividadehole extends Model
{

  protected $table = 'gatividades';

  protected $fillable = array('atividade_id','ativo','posicao','turma_id','name','description','cover_image');

}
