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
	$filter->add('turma_id','Turma','select')->rule('required')->option("","")->options(Turma::orderBy('posicao','desc')->lists('name','id'))->insertValue(\Input::get('id'));
        $filter->submit('Procurar');
        $filter->reset('Resetar');
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
	$grid->add('cover_image', 'Foto')->cell( function ($value, $row) {
			return '<img src="/galerias/albums/120x80_'.$value.'" height="120px">';
	})->style("text-align: center; vertical-align: middle;");
        $grid->edit('edit', 'Editar','modify|delete')->style("text-align: center; vertical-align: middle;");
        $grid->paginate(10);
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
//	$form->link('/galerias/view/turmas/'.\Input::get('id'),"Voltar para a galeria")->back('do_delete');
//	$form->link("galerias/albums/index","Voltar", "BL")->back('do_delete');
	$form->add('turma_id','','hidden')->insertValue(\Input::get('id'));
        $form->add('ativo','Ativar:', 'checkbox')->insertValue(1);
	$form->add('name','Album', 'text')->rule('required|unique:albums,name,NULL,id,turma_id,{{$turma_id}}')->attributes(array('autofocus'=>'autofocus'));
	$form->add('description','Descri&ccedil;&atilde;o', 'text');
	if(\Input::hasFile('cover_image')){
    	    $filename = str_random(8).'_'.\Input::file('cover_image')->getClientOriginalName();
        }
	$form->add('cover_image','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($form, $filename) {
		$form->field("cover_image")->insertValue($filename)->updateValue($filename);
	    	$image->fit(250, 150, function($constraint) {
	    		$constraint->upsize();
	    	});
		$image->save(public_path()."/galeria/albums/thumb_". $filename);
	    	$image->fit(120, 80, function($constraint) {
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/galeria/albums/120x80_". $filename);
	    })->move(public_path().'/galeria/albums/',$filename)->preview(120,80);
	$form->submit('Salvar');

        $form->saved(function () use ($form) {
	Album::created(function ($album){
	    $pos = \DB::table('albums')->where('turma_id', '=', $form->field('turma_id')->value)->max('posicao');
	    $album->posicao=$pos+1;
	    $album->save();
	});
	    \Flash::success("Album adicionada com sucesso!");
	    $form->link('/galerias/view/turmas/'.$form->field('turma_id')->value,"Voltar para a galeria");
            $form->link("galerias/albums/index","Voltar", "BL")->back('do_delete');
//	    return \Redirect::to('/galerias/view/turmas/'.$form->field('turma_id')->value);
	});
//	$form->build();
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
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
	$edit->add('name','Nome', 'text')->rule('required|unique:albums,name,'.$edit->model['id'])->attributes(array('autofocus'=>'autofocus'));
	$edit->add('description','Descri&ccedil;&atilde;o', 'text');
	if(\Input::hasFile('cover_image')){
    	    $filename = str_random(8).'_'.\Input::file('cover_image')->getClientOriginalName();
        }
	$edit->add('cover_image','Foto', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')
	    ->image(function ($image) use ($edit, $filename) {
		$edit->field("cover_image")->insertValue($filename)->updateValue($filename);
		$image->resize (250, 150, function($constraint) {
			$constraint->aspectRatio();
	    		$constraint->upsize();
	    	});
		$image->save(public_path()."/galeria/albums/thumb_". $filename);
		$image->resize (120, 80, function($constraint) {
			$constraint->aspectRatio();
	    		$constraint->upsize();
	    	});
	    	$image->save(public_path()."/galeria/albums/120x80_". $filename);
	    })->move(public_path().'/galeria/albums/',$filename)->preview(120,80);
	$edit->saved(function () use ($edit) {
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
        $page_title = 'Fotos';
	$page_description = '';
	$title = 'Fotos';
	$route = 'imagems';

        $filter = \DataFilter::source(Foto::where('album_id', '=', $id));
	$filter->add('album_id','Album','select')->rule('required')->option("","")->options(Foto::orderBy('posicao','desc')->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/fotos/upload?id=".$id,"Adicionar Fotos");
        $filter->build();

        $grid = \DataGrid::source($filter);
	$grid->add('name','Unidade', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('cover_image', 'Foto');
        $grid->paginate(8);
	$grid->build();
	$back = 'turmas';
	return	view('galerias.index', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back','id'));
    }

    public function viewu($id = null)
    {
        $page_title = 'Fotos';
	$page_description = '';
	$title = 'Fotos';
	$route = 'imagems';

        $filter = \DataFilter::source(Foto::where('album_id', '=', $id)->where('ativo','=',1));
	$filter->add('album_id','Album','select')->rule('required')->option("","")->options(Foto::orderBy('posicao','desc')->lists('name','id'))->insertValue($id);
	$filter->submit('Filtrar');
        $filter->reset('Resetar');
        $filter->link("galerias/fotos/upload?id=".$id,"Adicionar Fotos");
        $filter->build();

        $grid = \DataGrid::source($filter);
	$grid->add('name','Unidade', true);
        $grid->add('description', 'Descri&ccedil;&atilde;o', true);
	$grid->add('cover_image', 'Foto');
        $grid->paginate(8);
	$grid->build();
	$back = 'turmas';
	return	view('galerias.indexu', compact('filter', 'grid', 'page_title', 'page_description', 'title', 'route', 'back','id'));
    }

}
