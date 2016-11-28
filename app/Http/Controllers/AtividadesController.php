<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Controller;
use App\Atividade;
use Zofe\Rapyd\Rapyd;
use Image;

class AtividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Atividades';
        $page_description = 'Pesquisar Atividade';

//        $url = new \Zofe\Rapyd\Url();
        $filter = \DataFilter::source(new Atividade());
        $filter->add('titulo','Titulo', 'text');
        $filter->add('descricao','Descri&ccedil;&atilde;o', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("atividades/create","Nova atividade");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','desc');
		$grid->attributes(array("class"=>"table table-striped"));
		$grid->add('<a class="" title="Mover para cima" href="/posicao/atividades/up/{{ $id }}"><span class="fa fa-level-up"></span></a>
    <a class="" title="Mover para baixo" href="/posicao/atividades/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao');        $grid->add('visualizar','Visualizar', true);
        $grid->add('titulo','Titulo', true);
        $grid->add('descricao', 'Descri&ccedil;&atilde;o', true);
        $grid->edit('edit', 'Editar','modify|delete');
        $grid->paginate(20);
        $grid->build();
        return	view('atividades.index', compact('filter', 'grid', 'page_title', 'page_description'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$page_title ="Atividades";
		$page_description = "Nova atividade";

        $form = \DataForm::source(New Atividade());
		$form->attributes(['id'=>'atividade']);
        $form->add('visualizar','Visualizar','datetime')->rule('required');
        $form->add('ativo','Ativar', 'checkbox')->insertValue(1);
		$form->add('titulo','Titulo', 'text')->rule('required|max:32');
		$form->add('descricao','Descri&ccedil;&atilde;o', 'text')->rule('required|max:128');
        $form->add('banner','Foto em destaque', 'image')->rule('required')->move('upload/atividades/banner/')->preview(120,80);
		$form->add('texto','Texto', 'textarea')->attributes(["id"=>"texto"])->rule('required');
		$form->submit('Salvar');

        $form->saved(function () use ($form) {
            $form->link("/atividades/create","Nova atividade");
			return \Redirect::to('atividades/index')->with("message","Atividade salva com sucesso!");
        });
		$form->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
//		Rapyd::script("$('#texto').summernote({ height: 400,	lang: 'pt-BR' });
		Rapyd::script("$('#texto').summernote({
            height: ($(window).height() - 300),
			lang: 'pt-BR',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append('image', image);
            data.append('height', '400');
            data.append('width', '400');
            $.ajax({
                url: '/imageupload',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function(url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#texto').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }");
        return $form->view('atividades.create', compact('form', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		$page_title ="Atividades";
		$page_description = "Alterar atividade";

        $edit = \DataEdit::source(New Atividade());
		$edit->link("atividades/index","Voltar", "BL")->back('');
        $edit->add('visualizar','Visualizar','datetime')->rule('required');
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
		$edit->add('titulo','Titulo', 'text')->rule('required|max:32');
		$edit->add('descricao','Descri&ccedil;&atilde;o', 'text')->rule('required|max:128');
        $edit->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->rule('required')->move('upload/atividades/banner/')->preview(120,80);
		$edit->add('texto','Texto', 'textarea')->attributes(["id"=>"texto"])->rule('required');

        $edit->saved(function () use ($edit) {
			return \Redirect::to('atividades/index')->with("message","Atividade atualizada com sucesso!");
        });
		$edit->build();
        Rapyd::js('summernote/summernote.min.js');
        Rapyd::js('summernote/lang/summernote-pt-BR.js');
        Rapyd::css('summernote/summernote.css');
		Rapyd::css('summernote\plugin\databasic\summernote-ext-databasic.css');
		Rapyd::js('summernote\plugin\databasic\summernote-ext-databasic.js');
		Rapyd::js('summernote\plugin\hello\summernote-ext-hello.js');
		Rapyd::js('summernote\plugin\specialchars\summernote-ext-specialchars.js');
		Rapyd::script("$('#texto').summernote({
            height: ($(window).height() - 300),
			lang: 'pt-BR',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append('image', image);
            data.append('height', '400');
            data.append('width', '400');
            $.ajax({
                url: '/imageupload',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function(url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#texto').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }");
        return $edit->view('atividades.edit', compact('edit', 'page_title', 'page_description'));
	}
}
