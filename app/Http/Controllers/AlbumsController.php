<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Turma;
use App\Album;
use App\Foto;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Albums';
	$page_description = 'Pesquisar albums';
	$title = 'Albums';
	$route = 'albums';

        $filter = \DataFilter::source(new Album());
        $filter->link("galerias/albums/create","Novo Album");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/albums.albums/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/albums.albums/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Nome', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('filename', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galerias/albums/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
        $grid->build();
	$back = '';
	$id = '';
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route','back','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$page_title ="Albums";
	$page_description = "Novo album";
	$filename = "";

        $form = \DataForm::source(New Album());
	$form->link("galerias/albums/index","Voltar", "BL")->back('');
	$form->add('turma_id','','hidden')->insertValue(\Input::get('id'));
        $form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Titulo', 'text')->rule('required')->attributes(array('autofocus'=>'autofocus'));
	$form->add('description','Descri&ccedil;&atilde;o', 'text');
	if(\Input::hasFile('filename')){
    	    $filename = str_random(8).'_'.str_replace(' ', '_', mb_strtolower(\Input::file('filename')->getClientOriginalName()));
        }
	$form->add('filename','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($form, $filename) {
		$form->field("filename")->insertValue($filename)->updateValue($filename);
	    	$image->resize(250, null, function($constraint) {
	    		$constraint->aspectRatio();
		});
		$image->insert(getWatermark($image), 'bottom-right', 10, 10);
		$image->save(public_path()."/images/icon_size/". $filename);
	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
	Album::created(function ($album){
	    $pos = \DB::table('albums')->where('turma_id', '=', $form->field('turma_id')->value)->max('posicao');
	    $album->posicao=$pos+1;
	    $album->save();
	});
	    if ($form->model['filename'] <> ''){
		$img = Image::make(public_path().'/images/full_size/'.$form->model['filename']);
		$img->insert(getWatermark($img), 'bottom-right', 20, 20);
		$img->save();
	}
	    \Flash::success("Album adicionada com sucesso!");
	    return \Redirect::to('/galerias/view/turmas/'.$form->field('turma_id')->value);
	});
	$form->build();
        return $form->view('galerias.create', compact('form', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
	$page_title ="Albums";
	$page_description = "Alterar album";
	$filename = "";

        $edit = \DataEdit::source(New Album());
	$edit->link("galerias/view/turmas/".$edit->model['turma_id'],"Voltar", "BL")->back('');
       	$edit->add('turma_id','','hidden');
        $edit->add('ativo','Ativar', 'checkbox');
	$edit->add('name','Nome', 'text')->rule('required')->attributes(array('autofocus'=>'autofocus'));
	$edit->add('description','Descri&ccedil;&atilde;o', 'text');
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
		return \Redirect::to('galerias/view/turmas/'.$edit->model['turma_id']);
        });
	$edit->build();
	return $edit->view('galerias.create', compact('edit', 'page_title', 'page_description'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id = null)
    {
        $page_title = Album::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Fotos do Album '.Album::where('id', '=', $id)->pluck('name');
	$title = 'Fotos';
	$route = 'images';
	$filter="";

        $filter = \DataFilter::source(Foto::where('album_id', '=', $id)->orderBy('posicao','asc'));
        $filter->link("galerias/images/upload?id=".$id,"Adicionar Fotos");
        $filter->build();

	$grid = \DataGrid::source($filter);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'turmas';
	$id = Album::where('id', '=', $id)->pluck('album_id');
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back','id'));
    }

}
