<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ano;
use Zofe\Rapyd\Rapyd;
use Image;
use App\Unidade;
use App\Turma;

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
	$grid->add('filename', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/anos/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->build();
	$back = '';
	$id = '';
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route','id','back'));
    }

    public function indexu()
    {
        $page_title = 'Anos';
	$page_description = 'Pesquisar anos';
	$title = 'Anos';
	$route = 'anos';

        $filter = \DataFilter::source(Ano::where('ativo','=',1));
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
	$grid->add('filename', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galeria/anos/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
	$grid->build();
	$back = '';
	$id = '';
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route','id','back'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$page_title ="Anos";
	$page_description = "Adicionar Ano";
	$filename = "";

        $form = \DataForm::source(New Ano());
	$form->link("galerias/anos/index","Voltar", "BL")->back('');
	$form->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$form->add('name','Titulo', 'text')->rule('required|unique:anos,name')->attributes(array('autofocus'=>'autofocus'));
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
/*	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/images//120x80_". $filename);
 */	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
	$form->submit('Salvar');

	Ano::created(function ($ano){
	    $pos = \DB::table('anos')->max('posicao');
	    $ano->posicao=$pos+1;
	    $ano->save();
	    $unidade1 = new Unidade;
	    $unidade1->ano_id=$ano->id;
	    $unidade1->ativo = 1;
	    $unidade1->name = "Unidade I";
	    $unidade1->posicao = 2;
	    $unidade1->save();

	    $unidade2 = new Unidade;
	    $unidade2->ano_id=$ano->id;
	    $unidade2->ativo = 1;
	    $unidade2->name = "Unidade II";
	    $unidade2->posicao = 1;
	    $unidade2->save();

	    $turma1 = new Turma;
	    $turma1->unidade_id=$unidade1->id;
	    $turma1->ativo = 1;
	    $turma1->name = "Maternal I";
	    $turma1->posicao = 10;
	    $turma1->save();

	    $turma2 = new Turma;
	    $turma2->unidade_id=$unidade1->id;
	    $turma2->ativo = 1;
	    $turma2->name = "Maternal II";
	    $turma2->posicao = 9;
	    $turma2->save();

	    $turma3 = new Turma;
	    $turma3->unidade_id=$unidade1->id;
	    $turma3->ativo = 1;
	    $turma3->name = "1º Período";
	    $turma3->posicao = 8;
	    $turma3->save();

	    $turma4 = new Turma;
	    $turma4->unidade_id=$unidade1->id;
	    $turma4->ativo = 1;
	    $turma4->name = "2º Período";
	    $turma4->posicao = 7;
	    $turma4->save();

	    $turma5 = new Turma;
	    $turma5->unidade_id=$unidade1->id;
	    $turma5->ativo = 1;
	    $turma5->name = "1º Ano";
	    $turma5->posicao = 6;
	    $turma5->save();

	    $turma6 = new Turma;
	    $turma6->unidade_id=$unidade1->id;
	    $turma6->ativo = 1;
	    $turma6->name = "2º Ano";
	    $turma6->posicao = 5;
	    $turma6->save();
	    
	    $turma7 = new Turma;
	    $turma7->unidade_id=$unidade1->id;
	    $turma7->ativo = 1;
	    $turma7->name = "3º Ano";
	    $turma7->posicao = 4;
	    $turma7->save();
	    
	    $turma8 = new Turma;
	    $turma8->unidade_id=$unidade1->id;
	    $turma8->ativo = 1;
	    $turma8->name = "4º Ano";
	    $turma8->posicao = 3;
	    $turma8->save();
	    
	    $turma9 = new Turma;
	    $turma9->unidade_id=$unidade1->id;
	    $turma9->ativo = 1;
	    $turma9->name = "5º Ano";
	    $turma9->posicao = 2;
	    $turma9->save();

	    $turma10 = new Turma;
	    $turma10->unidade_id=$unidade1->id;
	    $turma10->ativo = 1;
	    $turma10->name = "Atividades Extra";
	    $turma10->posicao = 1;
	    $turma10->save();

	    $turma11 = new Turma;
	    $turma11->unidade_id=$unidade2->id;
	    $turma11->ativo = 1;
	    $turma11->name = "6º Ano";
	    $turma11->posicao = 8;
	    $turma11->save();

	    $turma12 = new Turma;
	    $turma12->unidade_id=$unidade2->id;
	    $turma12->ativo = 1;
	    $turma12->name = "7º Ano";
	    $turma12->posicao = 7;
	    $turma12->save();

	    $turma13 = new Turma;
	    $turma13->unidade_id=$unidade2->id;
	    $turma13->ativo = 1;
	    $turma13->name = "8º Ano";
	    $turma13->posicao = 6;
	    $turma13->save();

	    $turma14 = new Turma;
	    $turma14->unidade_id=$unidade2->id;
	    $turma14->ativo = 1;
	    $turma14->name = "9º Ano";
	    $turma14->posicao = 5;
	    $turma14->save();

	    $turma15 = new Turma;
	    $turma15->unidade_id=$unidade2->id;
	    $turma15->ativo = 1;
	    $turma15->name = "1ª Série EM";
	    $turma15->posicao = 4;
	    $turma15->save();

	    $turma16 = new Turma;
	    $turma16->unidade_id=$unidade2->id;
	    $turma16->ativo = 1;
	    $turma16->name = "2ª Série EM";
	    $turma16->posicao = 3;
	    $turma16->save();
	    
	    $turma17 = new Turma;
	    $turma17->unidade_id=$unidade2->id;
	    $turma17->ativo = 1;
	    $turma17->name = "3º Série EM";
	    $turma17->posicao = 2;
	    $turma17->save();
	    
	    $turma18 = new Turma;
	    $turma18->unidade_id=$unidade2->id;
	    $turma18->ativo = 1;
	    $turma18->name = "Atividades Extra";
	    $turma18->posicao = 1;
	    $turma18->save();
	});
        $form->saved(function () use ($form) {
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
	$edit->add('name','Nome', 'text')->rule('required|unique:anos,name,'.$edit->model['id'])->attributes(array('autofocus'=>'autofocus'));
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

/*	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
		$image->save(public_path()."/galeria/anos/12". $filename);

 */	    })->move(public_path().'/images/full_size/',$filename)->preview(250,150);
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
    public function view($id = null)
    {
	$page_title = Ano::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Unidades do ano de '.Ano::where('id', '=', $id)->pluck('name');
	$title = 'Unidade';
	$route = 'unidades';
	
        $filter = \DataFilter::source(Unidade::where('ano_id', '=', $id));
	$filter->add('ano_id','Ano','select')->rule('required')->option("","")->options(Ano::orderBy('posicao','desc')->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/unidades/create?id=".$id,"Criar nova Unidade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = '';
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'id', 'back'));
    }

    public function viewu($id = null)
    {
	$page_title = Ano::where('id', '=', $id)->pluck('name');
	$page_description = 'Visualizando Unidades do ano de '.Ano::where('id', '=', $id)->pluck('name');
	$title = 'Unidade';
	$route = 'unidades';
	
        $filter = \DataFilter::source(Unidade::where('ano_id', '=', $id)->where('ativo','=',1));
	$filter->add('ano_id','Ano','select')->rule('required')->option("","")->options(Ano::orderBy('posicao','desc')->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/unidades/create?id=".$id,"Criar nova Unidade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
	$grid->add('name','Nome', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('filename', 'Foto');
	$grid->build();
	$back = '';
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'id', 'back'));
    }
    
}
