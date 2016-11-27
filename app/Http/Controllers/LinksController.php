<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Links;
use Zofe\Rapyd\Rapyd;

class LinksController extends Controller
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

        $grid = \DataGrid::source(Links::orderBy('id','asc'));
		$grid->attributes(array("class"=>"table table-striped"));
//		$grid->link("/links/index","Voltar", "BL")->back('');
        $grid->add('name', 'Redes Sociais/Banner');
		$grid->add('url', 'Link')->cell( function ($value, $row) {
			if ($row->id == 1) {
				return '<img src="/upload/banner/'.$value.'" height="120px">';
			}
			else
				return $value;
			}
		);
//		$grid->add('url','Endereço');
        $grid->edit('edit', 'Editar','modify');
        $grid->build();
        return  view('links.index', compact('grid', 'page_title', 'page_description'));
	}

	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
		if (null != \Input::get('modify')){
			$i =\Input::get('modify');
		}
		elseif (null != \Input::get('update')) {
			$i =\Input::get('update');
		}
		if ($i == 1) $nome = 'Banner inferior';
		elseif ($i == 2) $nome = 'Página do Facebook';
		elseif ($i == 3) $nome = 'Página do Instagram';
		elseif ($i == 4) $nome = 'Página do Youtube';
		$page_title ="Links";
		$page_description = "Alterar Links";

        $edit = \DataEdit::source(New Links());
		$edit->attributes(array("class"=>"table table-striped"));
		$edit->link("/links/index","Voltar", "BL")->back('');
		if ($i == 1)
	        $edit->add('url',$nome, 'image')->rule('mimes:jpeg,jpg,png,gif|required|max:10000')->move('/upload/banner/')->preview(120,80);
		else
	        $edit->add('url',$nome,'text')->rule('required');

        $edit->saved(function () use ($edit) {
			return \Redirect::to('/links/index')->with("message","Link atualizado com sucesso!");
        });
		$edit->build();
		return $edit->view('links.edit', compact('edit', 'page_title', 'page_description'));
	}
}
