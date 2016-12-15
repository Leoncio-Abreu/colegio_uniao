<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Galeria;
use \Validator;
use \Input;
use \Redirect;
use Image;

class GaleriasController extends Controller
{
  public function getList()
  {
    $galerias = Galeria::with('Albums')->get();
    return View('albums.galerias')->with('galerias',$galerias);
  }
  public function editForm($id)
  {
    $galeria = Galeria::with('Albums')->find($id);
    return View('albums.editgaleria', compact('galeria'));
  }

  public function getGaleria($id)
  {
    $galeria = Galeria::with('Albums')->find($id);
    $galerias = Galeria::with('Albums')->where('id', '<>', $id)->get();
    return View('albums.galeria', compact('galeria','galerias'));
  }
  public function getForm()
  {
    return View('albums.creategaleria');
  }
  public function postCreate()
  {
    $rules = array(

      'name' => 'required',
      'cover_image'=>'required|image'

    );
    
    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()){

      return Redirect::route('galeria.create_galeria_form')
      ->withErrors($validator)
      ->withInput();
    }

    $file = Input::file('cover_image');
    $random_name = str_random(8);
    $destinationPath = 'albums/';
    $extension = $file->getClientOriginalExtension();
    $filename=$random_name.'_cover.'.$extension;
    $uploadSuccess = Input::file('cover_image')->move($destinationPath, $filename);
    $galeria = Galeria::create(array(
      'name' => Input::get('name'),
      'description' => Input::get('description'),
      'cover_image' => $filename,
    ));

	try 
    	{
    		$imageRealPath 	= $destinationPath . '/' . $filename;
    		$thumbName 	= 'thumb_'. $filename;
	    	
	    	//$imageManager = new ImageManager(); // use this if you don't want facade style code
    		//$img = $imageManager->make($imageRealPath);
	    
	    	$img = Image::make($imageRealPath); // use this if you want facade style code
	    	$img->resize(intval('245'), null, function($constraint) {
	    		 $constraint->aspectRatio();
	    	});
	    	$img->save(public_path()."/albums/". $thumbName);
    	}
    	catch(Exception $e)
    	{
    		return false;
	}

    return Redirect::route('galeria.show_galeria',array('id'=>$galeria->id));
  }

  public function postEdit()
  {
    $rules = array(

      'name' => 'required',
      'cover_image'=>'required|image'

    );
    
    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()){

      return Redirect::route('galeria.edit_galeria_form')
      ->withErrors($validator)
      ->withInput();
    }

    $file = Input::file('cover_image');
    $random_name = str_random(8);
    $destinationPath = 'albums/';
    $extension = $file->getClientOriginalExtension();
    $filename=$random_name.'_cover.'.$extension;
    $uploadSuccess = Input::file('cover_image')->move($destinationPath, $filename);
    $galeria = Galeria::find(Input::get('id'));
    $galeria->name = Input::get('name');
    $galeria->description = Input::get('description');
    $galeria->cover_image = $filename;
    $galeria->save();

	try 
    	{
    		$extension 	= $file->getClientOriginalExtension();
    		$imageRealPath 	= $destinationPath . '/' . $filename;
    		$thumbName 	= 'thumb_'. $filename;
	    	
	    	//$imageManager = new ImageManager(); // use this if you don't want facade style code
    		//$img = $imageManager->make($imageRealPath);
	    
	    	$img = Image::make($imageRealPath); // use this if you want facade style code
	    	$img->resize(intval('245'), null, function($constraint) {
	    		 $constraint->aspectRatio();
	    	});
	    	$img->save(public_path()."/albums/". $thumbName);
    	}
    	catch(Exception $e)
    	{
    		Redirect::route('galeria.show_galeria',array('id'=>$galeria->id));
	}

    return Redirect::route('galeria.show_galeria',array('id'=>$galeria->id));
  }

  public function getDelete($id)
  {
    $galeria = Galeria::find($id);

    $galeria->delete();

    return Redirect::route('galeria.index');
  }
}
