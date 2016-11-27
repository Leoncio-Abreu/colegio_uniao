<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
	protected $table = 'slides';
	protected $fillable = ['banner','ativo','visualisar','posicao'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at', 'visualisar'];

    public function parent()
    {
        return $this->belongsTo('Slide', 'posicao');
    }

}
