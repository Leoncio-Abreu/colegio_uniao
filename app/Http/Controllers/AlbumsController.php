<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Album;
use App\Albumhole;
use App\Imagem;

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
	$title = 'Album';
	$route = 'albums';

        $filter = \DataFilter::source(new Album());
        $filter->add('name','Album', 'text');
        $filter->add('description','Descri&ccedil;&atilde;o', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("albums/albums/create","Novo Album");
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
	$grid->add('name','Album', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('cover_image', 'Foto')->cell( function ($value, $row) {
			return '<img src="/album/albums/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->row(function ($row) {
	    $row->cell('<a class="" title="Mover para cima" href="/posicao/albums.albums/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/albums.albums/down/{{ $id }}"><span class="fa fa-level-down"></span></a>')->style("vertical-align: middle;");
	    $row->cell('ativo')->style("vertical-align: middle;");
	    $row->cell('name')->style("vertical-align: middle;");
	    $row->cell('cover_image')->style("vertical-align: middle;");
	    $row->cell('description')->style("vertical-align: middle;");
	    $row->cell('_edit')->style("vertical-align: middle;");
	    $row->attributes(array('align'=>'center'));
    	});
        $grid->paginate(8);
        $grid->build();
	return	view('albums.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route'));
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

        $form = \DataForm::source(New Albumhole());
        $form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Album', 'text')->rule('required');
	$form->add('description','Descri&ccedil;&atilde;o', 'text')->rule('required');
	if(\Input::hasFile('cover_image')){
    	    $filename = str_random(8).'_'.\Input::file('cover_image')->getClientOriginalName();
        }
	$form->add('cover_image','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($form, $filename) {
		$form->field("cover_image")->insertValue($filename)->updateValue($filename);
	    	$image->fit(250, 150, function($constraint) {
	    		$constraint->upsize();
	    	});
		$image->save(public_path()."/album/albums/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/album/albums/120x80_". $filename);
	    })->move(public_path().'/album/albums/',$filename)->preview(120,80);
	$form->add('albums','Albums a serem visualizadas','checkboxgroup')->options(Album::lists('name', 'id')->where('ativo', '=', '1')->all());
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->link("/albums/albums/create","Novo Album");
	    \Flash::success("Album adicionada com sucesso!");
	    return \Redirect::to('/albums/albums/index');
	});
	$form->build();
        return $form->view('albums.create', compact('form', 'page_title', 'page_description'));
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
	$edit->link("albums/albums/index","Voltar", "BL")->back('');
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$edit->add('name','Album', 'text')->rule('required');
	$edit->add('description','Descri&ccedil;&atilde;o', 'text')->rule('required');
	if(\Input::hasFile('cover_image')){
    	    $filename = str_random(8).'_'.\Input::file('cover_image')->getClientOriginalName();
        }
	$edit->add('cover_image','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($edit, $filename) {
		$edit->field("cover_image")->insertValue($filename)->updateValue($filename);
	    	$image->fit(250, 150, function($constraint) {
	    		$constraint->upsize();
	    	});
		$image->save(public_path()."/album/albums/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/album/albums/120x80_". $filename);
	    })->move(public_path().'/album/albums/',$filename)->preview(120,80);
	$edit->add('albums','Albums a serem visualizadas','checkboxgroup')->options(Album::where('ativo', '=', '1')->lists('name', 'id')->all());
	$edit->saved(function () use ($edit) {
		\Flash::success("Album atualizada com sucesso!");
		return \Redirect::to('albums/albums/index');
        });
	$edit->build();
	return $edit->view('albums.create', compact('edit', 'page_title', 'page_description'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($ano = null, $unidade = null, $turma = null, $album = null, $imagem = null)
    {
        $page_title = 'Fotos';
	$page_description = 'Fotos | Visualizar Fotas da '.Album::where('id', '=', $id)->pluck('name');
	$title = 'Fotos';
	$route = 'imagems';

        $grid = \DataGrid::source(Foto::whereHas('albums', function ($query) use ($id) {$query->where('id', '=', $id);})->where('ativo', '=', 1));
	$grid->add('name','Unidade', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('cover_image', 'Foto');
        $grid->paginate(8);
	$grid->build();
	return	view('albums.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route'));
    }

}
