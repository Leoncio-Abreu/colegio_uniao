<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Noticia;
use App\Noticiashole;
use Zofe\Rapyd\Rapyd;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Not&#237;cias';
        $page_description = 'Pesquisar Not&#237;cias';

        $filter = \DataFilter::source(new Noticia());
        $filter->add('titulo','Titulo', 'text');
        $filter->add('descricao','Descrição', 'text');
        $filter->submit('Procurar');
        $filter->reset('Resetar');
        $filter->link("/noticias/create","Nova notícia");
        $filter->build();

        $grid = \DataGrid::source($filter)->orderBy('posicao','des');
		$grid->attributes(array("class"=>"table table-striped"));
		$grid->add('<a class="" title="Mover para cima" href="/posicao/noticias/up/{{ $id }}"><span class="fa fa-level-up"></span></a>
    <a class="" title="Mover para baixo" href="/posicao/noticias/down/{{ $id }}"><span class="fa fa-level-down"></span></a>','Posicao');
        $grid->add('visualizar','Visualizar', true);
        $grid->add('ativo','Ativar', 'checkbox');
        $grid->add('titulo','Titulo', true);
		$grid->add('descricao','Descricao', true);
		$grid->edit('edit', 'Editar','modify|delete');
        $grid->paginate(20);
        $grid->build();
        return  view('noticias.index', compact('filter', 'grid', 'page_title', 'page_description'));
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$page_title ="Not&#237;cias";
		$page_description = "Nova not&#237;cia";

        $form = \DataForm::source(New Noticiashole());

        $form->add('visualizar','Visualizar','datetime')->rule('required');
        $form->add('ativo','Ativar', 'checkbox')->insertValue(1);
		$form->add('titulo','Titulo', 'text')->rule('max:32');
		$form->add('descricao','Descricao', 'text')->rule('max:128');
        $form->add('banner','Foto em destaque','textarea')->attr('id','banner');
		$form->add('texto','Texto', 'textarea')->attr('id','texto')->rule('required');

		$form->submit('Save');

        $form->saved(function () use ($form) {
            $form->link("/noticias/create","Nova notícia");
			return \Redirect::to('noticias/index')->with("message","Noticía introduzida com sucesso!");
        });
		$form->build();
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
        };
		$('#banner').summernote({
            height: 200,
			lang: 'pt-BR',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage2(image[0]);
                }
            }
        });
        function uploadImage2(image) {
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
                    $('#banner').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        };");
		return $form->view('noticias.create', compact('form', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		$page_title ="Not&#237;cias";
		$page_description = "Alterar not&#237;cia";

        $edit = \DataEdit::source(New Noticia());
		$edit->link("noticias/index","Voltar", "BL")->back('');
        $edit->add('visualizar','Visualizar','datetime')->rule('required');
        $edit->add('ativo','Ativar', 'checkbox')->insertValue(1);
		$edit->add('titulo','Titulo', 'text')->rule('max:32');
		$edit->add('descricao','Descricao', 'text')->rule('max:128');
        $edit->add('banner','Foto em destaque', 'textarea')->attr('id','banner');
		$edit->add('texto','Texto', 'textarea')->attr('id','texto')->rule('required');


        $edit->saved(function () use ($edit) {
//			$message = \Input::get('texto','<p></p>'); // Summernote input field
			return \Redirect::to('noticias/index')->with("message","Noticía atualizada com sucesso!");
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
        };
		$('#banner').summernote({
            height: 200,
			lang: 'pt-BR',
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage2(image[0]);
                }
            }
        });
        function uploadImage2(image) {
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
                    $('#banner').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        };");
		return $edit->view('noticias.edit', compact('edit', 'page_title', 'page_description'));
	}
}
