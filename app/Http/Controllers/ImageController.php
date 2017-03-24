<?php

namespace App\Http\Controllers;

use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Image;
use Log;
class ImageController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function getUpload()
    {
        return view('galerias.image.upload');
    }

    public function getUpload3()
    {
        return view('galerias.image.upload3');
    }

    public function postUpload()
    {
	Log::info('postUpload', Input::all());
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;

    }

    public function deleteUpload()
    {
//        Log::info('deleteUpload0: ', Input::all());
        Log::info('deleteUpload1: '. Input::get('id'));
	$filename = Input::get('id');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }

    /**
     * Part 2 - Display already uploaded images in Dropzone
     */

    public function getServerImagesPage()
    {
        return view('galerias.image.upload-2');
    }

    public function getServerImages()
    {
        $images = Image::get(['original_name', 'filename']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'size' => File::size(public_path('images/full_size/' . $image->filename))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }
}
