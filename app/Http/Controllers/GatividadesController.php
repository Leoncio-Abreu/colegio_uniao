<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Gatividade;
use App\Galeriahole;
use App\Imagem;

class GatividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Atividades';
	$page_description = 'Pesquisar Atividades';
	$title = 'Atividades';
	$route = 'atividades';

        $filter = \DataFilter::source(new Gatividade());
        $filter->add('name','Atividade', 'text');
        $filter->add('description','Descri&ccedil;&atilde;o', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("galerias/atividades/create","Nova Atividade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/galerias.atividades/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/galerias.atividades/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Galeria', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('cover_image', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/atividades/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->row(function ($row) {
	    $row->cell('<a class="" title="Mover para cima" href="/posicao/galerias.atividades/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/galerias.atividades/down/{{ $id }}"><span class="fa fa-level-down"></span></a>')->style("vertical-align: middle;");
	    $row->cell('ativo')->style("vertical-align: middle;");
	    $row->cell('name')->style("vertical-align: middle;");
	    $row->cell('cover_image')->style("vertical-align: middle;");
	    $row->cell('description')->style("vertical-align: middle;");
	    $row->cell('_edit')->style("vertical-align: middle;");
	    $row->attributes(array('align'=>'center'));
    	});
        $grid->paginate(8);
        $grid->build();
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$page_title ="Galerias";
	$page_description = "Novo galeria";
	$filename = "";

        $form = \DataForm::source(New Galeriahole());
        $form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Galeria', 'text')->rule('required');
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
		$image->save(public_path()."/galeria/atividades/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/galeria/atividades/120x80_". $filename);
	    })->move(public_path().'/galeria/atividades/',$filename)->preview(120,80);
	$form->add('atividades','Atividades a serem visualizadas','checkboxgroup')->options(Gatividade::lists('name', 'id')->where('ativo', '=', '1')->all());
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->link("/galerias/atividades/create","Novo Galeria");
	    \Flash::success("Galeria adicionada com sucesso!");
	    return \Redirect::to('/galerias/atividades/index');
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
	$page_title ="Galerias";
	$page_description = "Alterar galeria";
	$filename = "";

        $edit = \DataEdit::source(New Galeria());
	$edit->link("galerias/atividades/index","Voltar", "BL")->back('');
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$edit->add('name','Galeria', 'text')->rule('required');
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
		$image->save(public_path()."/galeria/atividades/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/galeria/atividades/120x80_". $filename);
	    })->move(public_path().'/galeria/atividades/',$filename)->preview(120,80);
	$edit->add('galerias','Galerias a serem visualizadas','checkboxgroup')->options(Galeria::where('ativo', '=', '1')->lists('name', 'id')->all());
	$edit->saved(function () use ($edit) {
		\Flash::success("Galeria atualizada com sucesso!");
		return \Redirect::to('galerias/atividades/index');
        });
	$edit->build();
	return $edit->view('galerias.create', compact('edit', 'page_title', 'page_description'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($ano = null, $unidade = null, $turma = null, $galeria = null, $imagem = null)
    {
        $page_title = 'Albums';
	$page_description = 'Albums | Visualizar Albums da '.Galeria::where('id', '=', $id)->pluck('name');
	$title = 'Albums';
	$route = 'fotos';

        $grid = \DataGrid::source(Album::whereHas('atividades', function ($query) use ($id) {$query->where('id', '=', $id);})->where('ativo', '=', 1));
	$grid->add('name','Unidade', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('cover_image', 'Foto');
        $grid->paginate(8);
	$grid->build();
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route'));
    }

}
