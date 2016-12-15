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

        $filter = \DataFilter::source(new Ano());
        $filter->add('name','Ano', 'text');
        $filter->add('description','Descri&ccedil;&atilde;o', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("galerias/ano/create","Novo Ano");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->attributes(array("class"=>"table table-striped", 'align'=>'center', 'valign' => 'middle'));
	$grid->add('<a class="" title="Mover para cima" href="/posicao/anos/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/anos/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao')->style("text-align: center; vertical-align: middle;");
        $grid->add('ativo','Ativar', 'true')->cell( function ($value) {
		if ($value == 1) {
			return '<i class="fa fa-toggle-on" aria-hidden="true" style="color:green"></i>';
		}
		else return '<i class="fa fa-toggle-off" aria-hidden="true" style="color:red"></i>';
    	})->style("text-align: center; vertical-align: middle;");
	$grid->add('name','Ano', true)->style("text-align: center; vertical-align: middle;");
        $grid->add('description', 'Descri&ccedil;&atilde;o', true)->style("text-align: center; vertical-align: middle;");
	$grid->add('cover_image', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/anos/thumb_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->row(function ($row) {
	    $row->cell('<a class="" title="Mover para cima" href="/posicao/anos/up/{{ $id }}"><span class="fa fa-level-up"></span></a>&nbsp;&nbsp;&nbsp;<a class="" title="Mover para baixo" href="/posicao/anos/down/{{ $id }}"><span class="fa fa-level-down"></span></a>')->style("vertical-align: middle;");
	    $row->cell('ativo')->style("vertical-align: middle;");
	    $row->cell('name')->style("vertical-align: middle;");
	    $row->cell('cover_image')->style("vertical-align: middle;");
	    $row->cell('description')->style("vertical-align: middle;");
	    $row->cell('_edit')->style("vertical-align: middle;");
	    $row->attributes(array('align'=>'center'));
    	});
        $grid->paginate(20);
        $grid->build();
 
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description'));
//	return	view('galerias.blank', compact('page_title', 'page_description'));
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
        $form = \DataForm::source(New Anohole());
//	$form->attributes(['id'=>'atividade']);
        $form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Ano', 'text')->rule('required');
	$form->add('description','Descri&ccedil;&atilde;o', 'text')->rule('required');
        $form->add('cover_image','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->rule('required')->move('galeria/anos/')
			->image(function ($image) {
//	    		$image->save(public_path()."/galeria/anos/thumb_". \Input::file('cover_image')->getClientOriginalName());
			$image->resize(120, 80, function($constraint) {
	    			$constraint->aspectRatio();
	    		});
	    		$image->save(public_path()."/galeria/anos/120x80_". \Input::file('cover_image')->getClientOriginalName());
			})
			->preview(120,80);
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->link("/galeria/anos/create","Novo Ano");
	    \Flash::success("Ano adicionado com sucesso!");
	    return \Redirect::to('/galeria/anos/index');
	});
	$form->build();
        return $form->view('galerias.create', compact('form', 'page_title', 'page_description'));
//        return view('galerias.blank', compact('page_title', 'page_description'));
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

        $edit = \DataEdit::source(New Ano());
	$edit->link("galerias/anos/index","Voltar", "BL")->back('');
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$edit->add('name','Ano', 'text')->rule('required');
	$edit->add('description','Descri&ccedil;&atilde;o', 'text')->rule('required');
        $edit->add('cover_image','Foto:', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->rule('required')->move('galeria/anos/')
			->image(function ($image) {
				$image->resize(120, 80, function($constraint) {
	    			$constraint->aspectRatio();
	    		});
	    		$image->save(public_path()."/galeria/anos/thumb_". \Input::file('cover_image')->getClientOriginalName());
			})
			->preview(120,80);
	$edit->saved(function () use ($edit) {
		\Flash::success("Ano atualizado com sucesso!");
		return \Redirect::to('galerias/anos/index');
        });
		$edit->build();
	return $edit->view('galerias.create', compact('edit', 'page_title', 'page_description'));
//	return view('galerias.blank', compact('page_title', 'page_description'));
	}
}
