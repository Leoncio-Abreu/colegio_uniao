<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Album extends Model
{

  protected $table = 'albums';

  protected $fillable = array('name','description','cover_image');

  public function Photos(){

    return $this->hasmany('App\Photo');
  }
}
