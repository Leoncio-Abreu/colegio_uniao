<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
	protected $table = 'links';
	protected $fillable = ['url','name'];
	protected $dates = ['deleted_at', 'created_at', 'updated_at'];

}
