<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Ano;
use App\Unidade;
use App\Turma;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ano_id=0)
    {
        $page_title = 'Unidades';
	$page_description = 'Pesquisar Unidades';
	$title = 'Unidades';
	$route = 'unidades';

        $filter = \DataFilter::source(new Unidade);
        $filter->link("galerias/unidades/create?id=".\Input::get('ano_id'),"Criar nova Unidade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/galerias.unidades/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/galerias.unidades/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Nome', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('filename', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/unidades/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->build();
	$back='';
	$id ='';
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$page_title ="Unidades";
	$page_description = "Adicionar Unidade";
	$filename = '';

	$form = \DataForm::source(New Unidade());
	$form->link("galerias/unidades/index","Voltar", "BL")->back('');
	$form->add('ano_id','','hidden')->insertValue(\Input::get('id'));
        $form->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$form->add('name','Nome', 'text')->rule('required')->attributes(array('autofocus'=>'autofocus'));
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
		$image->insert(public_path().'/img/logo_uniao_i.png', 'bottom-right', 10, 10);
		$image->save(public_path()."/images/icon_size/". $filename);
	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$form->submit('Salvar');

	$form->saved(function () use ($form) {
	Unidade::created(function ($unidade){
	    $pos = \DB::table('unidades')->where('ano_id', '=', \Input::get('id'))->max('posicao');
	    $unidade->posicao=$pos+1;
	    $unidade->save();
	});
	    if ($form->field('filename')->value <> ''){
		$img = Image::make(public_path().'/images/full_size/'.$form->field('filename')->value);
		$img->insert(public_path().'/img/logo_uniao_f.png', 'bottom-right', 10, 10);
		$img->save();
	    }
            \Flash::success("Unidade adicionada com sucesso!");
	    return \Redirect::to('/galerias/view/anos/'.$form->field('ano_id')->value);
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
	$page_title ="Galeria";
	$page_description = "Unidades | Alterar Unidade";
	$filename = '';
	$edit = \DataEdit::source(New Unidade());
	$edit->link("galerias/view/anos/".$edit->model['ano_id'],"Voltar", "BL")->back('');
       	$edit->add('ano_id','','hidden');
        $edit->add('ativo','Ativar', 'checkbox');
	$edit->add('name','Unidade', 'text')->rule('required')->attributes(array('autofocus'=>'autofocus'));
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
		$image->insert(public_path().'/img/logo_uniao_i.png', 'bottom-right', 10, 10);
		$image->save(public_path()."/images/icon_size/". $filename);
	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$edit->saved(function () use ($edit) {
	    if ($edit->model['filename'] <> ''){
		$img = Image::make(public_path().'/images/full_size/'.$edit->model['filename']);
		$img->insert(public_path().'/img/logo_uniao_f.png', 'bottom-right', 20, 20);
		$img->save();
	    }
		\Flash::success("Unidade atualizada com sucesso!");
		return \Redirect::to('galerias/view/anos/'.$edit->model['ano_id']);
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
        $page_title = Unidade::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Turmas da '.Unidade::where('id', '=', $id)->pluck('name');
	$title = 'Turma';
	$route = 'turmas';
	
        $filter = \DataFilter::source(Turma::where('unidade_id', '=', $id)->orderBy('posicao','asc'));
        $filter->link("galerias/turmas/create?id=".$id,"Criar nova Turma");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = 'anos';
	$id = Unidade::where('id', '=', $id)->pluck('ano_id');
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route','id', 'back'));
    }
}
