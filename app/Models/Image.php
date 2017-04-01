<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];

    public static $messages = [
        'file.mimes' => 'O arquivo enviado não está no formato de imagem. (png,gif,jpeg,jpg,bmp)',
        'file.required' => 'A imagem é necessária'
    ];
}
