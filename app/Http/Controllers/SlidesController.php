<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Slide;
use Zofe\Rapyd\Rapyd;
use Image;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Apresentação de slides';
        $page_description = 'Pesquisar slide';

        $filter = \DataFilter::source(new Slide());
        $filter->add('visualizar','Visualizar', 'datetime');
        $filter->add('ativo','Ativar', 'checkbox');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("slides/create","Novo Slide");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
		$grid->attributes(array("class"=>"table table-striped"));
		$grid->add('<a class="" title="Mover para cima" href="/posicao/slides/up/{{ $id }}"><span class="fa fa-level-up"></span></a>
    <a class="" title="Mover para baixo" href="/posicao/slides/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao');        $grid->add('visualizar','Visualizar', true);
        $grid->add('ativo','Ativar', 'true');
        $grid->add('<img src="/upload/slides/{{ $banner }}" height="120px">','Banner');
        $grid->edit('edit', 'Editar','modify|delete');
        $grid->paginate(20);
        $grid->build();
        return  view('slides.index', compact('grid', 'page_title', 'page_description','filter'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$page_title ="Apresentação de slides";
		$page_description = "Novo slide";

        $form = \DataForm::source(New Slide());
		$form->attributes(['id'=>'slide']);
		$form->set('posicao', '0');
        $form->add('visualizar','Visualizar','datetime')->rule('required');
        $form->add('ativo','Ativar', 'checkbox');
        $form->add('banner','Foto em destaque', 'image')->move('upload/slides/')->preview(120,80);
		$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->link("/slides/create","Novo slide");
			return \Redirect::to('/slides/index')->with("message","Slide salvo com sucesso!");
        });
		$form->build();

		return $form->view('slides.create', compact('form', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
		$page_title ="Apresentação de slides";
		$page_description = "Alterar slide";

        $edit = \DataEdit::source(New Slide());
		$edit->link("/slides/index","Voltar", "BL")->back('');
        $edit->add('visualizar','Visualizar','datetime')->rule('required');
		$edit->set('posicao', '{{ $posicao }}');
        $edit->add('ativo','Ativar', 'checkbox');
        $edit->add('banner','Slide', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/slides/')->preview(120,80);

//		$edit->submit('Save');

        $edit->saved(function () use ($edit) {
			return \Redirect::to('/slides/index')->with("message","Slide atualizado com sucesso!");
        });
		$edit->build();
        return $edit->view('slides.edit', compact('edit', 'page_title', 'page_description'));
	}
}
