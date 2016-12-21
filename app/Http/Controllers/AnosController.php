<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ano;
use App\Anohole;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Unidade;

class AnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Anos';
	$page_description = 'Pesquisar anos';
	$title = 'Anos';
	$route = 'anos';

        $filter = \DataFilter::source(new Ano());
	$filter->add('id','Ano','select')->rule('required')->option("","")->options(Ano::orderBy('posicao','desc')->lists('name','id'));
        $filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/anos/create","Criar novo Ano");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/galerias.anos/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/galerias.anos/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Nome', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('cover_image', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/anos/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
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
	$page_title ="Anos";
	$page_description = "Novo ano";
	$filename = "";

        $form = \DataForm::source(New Anohole());
	$form->link("galerias/anos/index","Voltar", "BL")->back('');
	$form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Nome', 'text')->rule('required');
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
		$image->save(public_path()."/galeria/anos/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/galeria/anos/120x80_". $filename);
	    })->move(public_path().'/galeria/anos/',$filename)->preview(120,80);
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->link("/galerias/anos/create","Novo Ano");
	    \Flash::success("Ano adicionado com sucesso!");
	    return \Redirect::to('/galerias/anos/index');
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
	$page_title ="Anos";
	$page_description = "Alterar ano";
	$filename = "";

        $edit = \DataEdit::source(New Ano());
	$edit->link("galerias/anos/index","Voltar", "BL")->back('');
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$edit->add('name','Nome', 'text')->rule('required');
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
		$image->save(public_path()."/galeria/anos/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/galeria/anos/120x80_". $filename);
	    })->move(public_path().'/galeria/anos/',$filename)->preview(120,80);
	$edit->saved(function () use ($edit) {
		\Flash::success("Ano atualizado com sucesso!");
		return \Redirect::to('galerias/anos/index');
        });
	$edit->build();
	return $edit->view('galerias.create', compact('edit', 'page_title', 'page_description'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id = null, $slide = null)
    {
	$page_title = 'Galeria';

	$page_description = 'Unidades | Visualizar Galeria de '.Ano::where('id', '=', $id)->pluck('name');
	$title = 'Unidade';
	$route = 'unidades';

        $grid = \DataGrid::source(Unidade::where('ano_id', '=', $id));
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('cover_image', 'Foto');
        $grid->paginate(8);
	$grid->build();
	if ($slide)
		return	view('galerias.slide', compact('filter','grid'));
	else
		return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route'));
    }

}
