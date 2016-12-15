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

        <form name="createnewgaleria" method="POST" action="{{URL::route('galeria.create_album')}}" enctype="multipart/form-data">
	  {!! Form::token() !!}
	  <fieldset>
            <legend>Criar uma Galeria:</legend>
            <div class="form-group">
              <label for="name">Nome da Galeria:</label>
              <input name="name" type="text" class="form-control"placeholder="Nome da Galeria"value="{{Input::old('name')}}">
            </div>
            <div class="form-group">
              <label for="description">Descrição da Galeria:</label>
              <textarea name="description" type="text"class="form-control" placeholder="Descrição da Galeria">{{Input::old('description')}}</textarea>
            </div>
            <div class="form-group">
              <label for="cover_image">foto da Galeria:</label>
              {!! Form::file('cover_image') !!}
            </div>
            <button type="submit" class="btnbtn-default">Criar Galeria!</button>
          </fieldset>
        </form>
      </div>
    </div> <!-- /container -->
@endsection
