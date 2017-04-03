<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Unidade;
use App\Turma;
use App\Album;

class TurmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Turmas';
	$page_description = 'Pesquisar turmas';
	$title = 'Turma';
	$route = 'turmas';

        $filter = \DataFilter::source(new Turma());
	$filter->add('unidade_id','Unidade','select')->rule('required')->option("","")->options(Unidade::orderBy('posicao','desc')->lists('name','id'))->insertValue(\Input::get('ano_id'));
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("galerias/turmas/create","Novo Turma");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/galerias.turmas/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/galerias.turmas/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Nome', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('filename', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/turmas/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
        $grid->build();
	$back = 'turmas';
	$id = '';
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$page_title ="Turmas";
	$page_description = "Adicionar turma";
	$filename = "";

        $form = \DataForm::source(New Turma());
	$form->link("galerias/turmas/index","Voltar", "BL")->back('');
	$form->add('unidade_id','','hidden')->insertValue(\Input::get('id'));
        $form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Turma', 'text')->rule('required|unique:turmas,name')->attributes(array('autofocus'=>'autofocus'));
	$form->add('description','Descri&ccedil;&atilde;o', 'text');
	if(\Input::hasFile('filename')){
    	    $filename = str_random(8).'_'.\Input::file('filename')->getClientOriginalName();
        }
	$form->add('filename','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($form, $filename) {
		$form->field("filename")->insertValue($filename)->updateValue($filename);
	    	$image->resize(250, null, function($constraint) {
	    		$constraint->aspectRatio();
	    	});
		$image->save(public_path()."/images/icon_size/". $filename);
	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
	Turma::created(function ($turma){
	    $pos = \DB::table('turmas')->where('unidade_id', '=', \Input::get('id'))->max('posicao');
	    $turma->posicao=$pos+1;
	    $turma->save();
	});
	    \Flash::success("Turma adicionado com sucesso!");
	    return \Redirect::to('/galerias/view/unidades/'.$form->field('unidade_id')->value);

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
	$page_title ="Turmas";
	$page_description = "Alterar turma";
	$filename = "";

        $edit = \DataEdit::source(New Turma());
	$edit->link("galerias/view/unidades/".$edit->model['unidade_id'],"Voltar", "BL")->back('');
       	$edit->add('unidade_id','','hidden');
        $edit->add('ativo','Ativar', 'checkbox');
	$edit->add('name','Nome', 'text')->rule('required|unique:turmas,name,'.$edit->model['id'])->attributes(array('autofocus'=>'autofocus'));
	$edit->add('description','Descri&ccedil;&atilde;o', 'text');
	if(\Input::hasFile('filename')){
    	    $filename = str_random(8).'_'.\Input::file('filename')->getClientOriginalName();
        }
	$edit->add('filename','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($edit, $filename) {
		$edit->field("filename")->insertValue($filename)->updateValue($filename);
	    	$image->resize(250, null, function($constraint) {
	    		$constraint->aspectRatio();
	    	});
		$image->save(public_path()."/images/icon_size/". $filename);
	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$edit->saved(function () use ($edit) {
		\Flash::success("Turma atualizado com sucesso!");
		return \Redirect::to('galerias/view/unidades/'.$edit->model['unidades_id']);
        });
	$edit->build();
	return $edit->view('galerias.create', compact('edit', 'page_title', 'page_description'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $page_title = Turma::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Albums do(a) '.Turma::where('id', '=', $id)->pluck('name');
	$title = 'Albums';
	$route = 'albums';

        $filter = \DataFilter::source(Album::where('turma_id', '=', $id));
	$filter->add('turma_id','Turma','select')->rule('required')->option("","")->options(Album::orderBy('posicao','desc')->where('turma_id', '=', $id)->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/albums/create?id=".$id,"Criar novo Album");
        $filter->build();

        $grid = \DataGrid::source($filter);
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'unidades';
	$id = Turma::where('id', '=', $id)->pluck('unidade_id');
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back', 'id'));
    }

    public function viewu($id)
    {
        $page_title = Turma::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Albums do(a) '.Turma::where('id', '=', $id)->pluck('name');
	$title = 'Albums';
	$route = 'albums';

        $filter = \DataFilter::source(Album::where('turma_id', '=', $id)->where('ativo','=',1));
	$filter->add('turma_id','Turma','select')->rule('required')->option("","")->options(Album::orderBy('posicao','desc')->where('turma_id', '=', $id)->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/albums/create?id=".$id,"Criar novo Album");
        $filter->build();

        $grid = \DataGrid::source($filter);
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'unidades';
	$id = Turma::where('id', '=', $id)->pluck('unidade_id');
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back', 'id'));
    }
    
}
