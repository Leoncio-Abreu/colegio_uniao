<?php

namespace App\Logic\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Models\Image;

class ImageRepository
{
    public function upload( $form_data )
    {

        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

	$photo = $form_data['file'];
	\Log::info('add: '. $form_data['album']);
	$album_id = $form_data['album'];
        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $filename = $originalNameWithoutExt;
        $allowed_filename = $this->createUniqueFilename( $filename, $extension );
//	$allowed_filename = $originalName;
        $uploadSuccess1 = $this->original( $photo, $allowed_filename );

        $uploadSuccess2 = $this->icon( $photo, $allowed_filename );

        if( !$uploadSuccess1 || !$uploadSuccess2 ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }
        
	$pos = \DB::table('images')->where('album_id', '=', $album_id)->max('posicao');
	$sessionImage = new Image;
	$sessionImage->ativo = 1;
	$sessionImage->posicao = $pos + 1;	
	$sessionImage->album_id = $album_id;
        $sessionImage->filename = $allowed_filename;
//        $sessionImage->name = $filename;
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code'  => 200,
            'filename' => $allowed_filename
        ], 200);

    }

    public function createUniqueFilename( $filename, $extension )
    {
        $full_size_dir = Config::get('images.full_size');
        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->save(Config::get('images.full_size') . $filename );

        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->resize(250, 150, function ($constraint) {
            $constraint->aspectRatio();
            })
            ->save( Config::get('images.icon_size')  . $filename );

        return $image;
    }

    /**
     * Delete Image From Session folder, based on server created filename
     */
    public function delete( $filename )
    {
	\Log::info('delete1: '. $filename);
        $full_size_dir = Config::get('images.full_size');
        $icon_size_dir = Config::get('images.icon_size');

        $sessionImage = Image::where('filename', 'like', $filename)->first();
	\Log::info('delete2: '. $sessionImage->filename);

        if(empty($sessionImage))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }


        $full_path1 = $full_size_dir . $sessionImage->filename;
        $full_path2 = $icon_size_dir . $sessionImage->filename;
	\Log::info('delete3: '. $full_path1. ' ' .$full_path1);
        if ( File::exists( $full_path1 ) )
        {
            File::delete( $full_path1 );
        }

        if ( File::exists( $full_path2 ) )
        {
            File::delete( $full_path2 );
        }

        if( !empty($sessionImage))
        {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array(" ", "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]","}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;","â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = str_replace(' ', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}
