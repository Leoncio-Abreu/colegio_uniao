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

        <form name="editalbum" method="POST"action="{{URL::route('galeria._album')}}"enctype="multipart/form-data">
	  {!! Form::token() !!}
	  <fieldset>
            <legend>Criar um Album:</legend>
            <div class="form-group">
              <label for="name">Nome do Album:</label>
              <input name="name" type="text" class="form-control"placeholder="Nome do album"value="{{Input::old('name')}}">
            </div>
            <div class="form-group">
              <label for="description">Descrição do Album:</label>
              <textarea name="description" type="text"class="form-control" placeholder="Descrição do album">{{Input::old('descrption')}}</textarea>
            </div>
            <div class="form-group">
              <label for="cover_image">foto de destaque do Album:</label>
              {!! Form::file('cover_image') !!}
            </div>
            <button type="submit" class="btnbtn-default">Criar Album!</button>
          </fieldset>
        </form>
      </div>
    </div> <!-- /container -->
@endsection
