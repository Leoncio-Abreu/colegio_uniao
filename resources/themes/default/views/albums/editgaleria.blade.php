@extends('layouts.master')
@section('content')
    <div class="container" style="text-align: center;">
      <div class="span4" style="display: inline-block;margin-top:100px;">

        @if($errors->has())
          <div class="alert alert-block alert-error fade in"id="error-block">
             <?php
             $messages = $errors->all('<li>:message</li>');
            ?>
            <button type="button" class="close"data-dismiss="alert">×</button>
  
            <h4>Warning!</h4>
            <ul>
              @foreach($messages as $message)
                {{$message}}
              @endforeach

            </ul>
          </div>
        @endif

        <form name="editgaleria" method="POST" action="{{URL::route('galeria.edit_galeria')}}" enctype="multipart/form-data">
	  {!! Form::token() !!}
      <input name="id" type="hidden" value="{{Input::old('id')}}">
	  <fieldset>
            <legend>Editar a GAleria:</legend>
            <div class="form-group">
              <label for="name">Nome da Galeria:</label>
              <input name="name" type="text" class="form-control" placeholder="Nome da GAleria" value="{{ (Input::old('name')) ? Input::old('name') : $galeria->name }}">
            </div>
            <div class="form-group">
              <label for="description">Descrição da Galeria:</label>
              <textarea name="description" type="text"class="form-control" placeholder="Descrição da Galeria">{{ (Input::old('description')) ? Input::old('description') : $galeria->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="cover_image">foto da Galeria:</label>
              <div class="col-sm-10" id="cover_image">
				<div class="clearfix">
					 &nbsp;<a href="/albums/{{ (Input::old('cover_image')) ? Input::old('cover_image') : $galeria->cover_image }}" target="_blank"><img src="/albums/thumb_{{ (Input::old('cover_image')) ? Input::old('cover_image') : $galeria->cover_image }}" class="pull-left" style="margin:0 10px 10px 0"></a><br />
				</div>
				<input class="form-control" type="file" id="cover_image" name="cover_image">
			  </div>	
            </div>
            <button type="submit" class="btnbtn-default">Salvar Galeria!</button>
        </fieldset>
        </form>
      </div>
    </div> <!-- /container -->
@endsection
