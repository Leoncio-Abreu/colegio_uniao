<?php

namespace App\Http\Controllers;

use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Image;
use App\Album;

class ImageController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function edit(\Request $request)
    {
	$page_title ="Foto";
	$page_description = "Alterar foto";
	$filename = "";

        $edit = \DataEdit::source(New Image());
	$edit->link('galerias/view/albums/'.$edit->model['album_id'],"Voltar", "BL")->back('');
	$edit->add('album_id','','hidden');
	$edit->add('ativo','Ativar', 'checkbox');
	$edit->add('description','Descri&ccedil;&atilde;o', 'text')->attributes(array('autofocus'=>'autofocus'));
	if(\Input::hasFile('filename')){
    	    $filename = str_random(8).'_'.str_replace(' ', '_', mb_strtolower(\Input::file('filename')->getClientOriginalName()));
        }
	$edit->add('filename','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($edit, $filename) {
		$edit->field("filename")->insertValue($filename)->updateValue($filename);
	    	$image->resize(250, null, function($constraint) {
	    		$constraint->aspectRatio();
	    	});
		$image->insert(getWatermark($image), 'bottom-right', 10, 10);
		$image->save(public_path()."/images/icon_size/". $filename);

	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$edit->saved(function () use ($edit) {
	    if ($edit->model['filename'] <> '' and !\Input::get('do_delete')){
		$img = Image::make(public_path().'/images/full_size/'.$edit->model['filename']);
		$img->insert(getWatermark($img), 'bottom-right', 20, 20);
		$img->save();
	    }
		\Flash::success("Album atualizado com sucesso!");
		return \Redirect::to('galerias/view/albums/'.$edit->model['album_id']);
        });
	$edit->build();
	return $edit->view('galerias.create', compact('edit', 'page_title', 'page_description'));
    }
    

    public function getUpload()
    {
	$title='title';
        $id=\Input::Get('id');
        $back='albums';
        $page_title = Album::where('id', '=', $id)->pluck('name');
	$page_description = 'Adicionar Fotos ao Album '.Album::where('id', '=', $id)->pluck('name');
        return view('galerias.image.upload', compact('page_title', 'page_description', 'back', 'id', 'title'));
    }

    public function getUpload3()
    {
        return view('galerias.image.upload3');
    }

    public function postUpload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;

    }

    public function deleteUpload()
    {
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
