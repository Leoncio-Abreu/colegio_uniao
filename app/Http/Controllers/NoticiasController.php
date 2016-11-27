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
/*

		<a href="/noticias/up/{{ $id }}"><i class="fa fa-level-up" aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="/noticias/down/{{ $id }}"><i class="fa fa-level-down" aria-hidden="true"></i></a>','Posicao');
*/
        $grid->add('visualizar','Visualizar', true);
        $grid->add('titulo','Titulo', true);
//        $grid->add('descricao', true);
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
        $form->add('ativo','Ativar', 'checkbox');
		$form->add('titulo','Titulo', 'textarea')->rule('required|max:32');
		$form->add('descricao','Descricao', 'text')->attr('id','descricao')->rule('required|max:128');
        $form->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/noticias/banner/')->preview(120,80);
		$form->add('texto','Texto', 'textarea')->attr('id','texto')->rule('required');
/*        $form->add('foto1','Foto 1', 'image')->move('uploads/noticias/')->fit(240, 160)->preview(120,80);
*/
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
            data.append('height', '200');
            data.append('width', '200');
            $.ajax({
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                return myXhr;
            },
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
		function progressHandlingFunction(e){
			if(e.lengthComputable){
				$('progress').attr({value:e.loaded, max:e.total});
				// reset progress on complete
				if (e.loaded == e.total) {
					$('progress').attr('value','0.0');
				}
			}
		};
		$('#descricao').summernote({
            height: ($(window).height() - 300),
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
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                return myXhr;
            },
                url: '/imageupload',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function(url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#descricao').summernote('insertNode', image[0]);
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
        $edit->add('ativo','Ativar', 'checkbox');
		$edit->add('titulo','Titulo', 'text')->rule('required|max:32');
		$edit->add('descricao','Descricao', 'text')->rule('required|max:128');
        $edit->add('banner','Foto em destaque', 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('upload/noticias/banner/')->preview(120,80);
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
            data.append('height', '200');
            data.append('width', '200');
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
        }
		$('#descricao').summernote({
            height: ($(window).height() - 300),
			lang: 'pt-BR',
            data.append('height', '400');
            data.append('width', '400');
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage2(image[0]);
                }
            }
        });
        function uploadImage2(image) {
            var data = new FormData();
            data.append('image', image);
            $.ajax({
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                return myXhr;
            },
                url: '/imageupload',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: 'post',
                success: function(url) {
                    var image = $('<img>').attr('src', 'http://' + url);
                    $('#descricao').summernote('insertNode', image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        };;");
		return $edit->view('noticias.edit', compact('edit', 'page_title', 'page_description'));
	}
}
