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
        <form name="addimagetoalbum" method="POST"action="{{URL::route('galeria.add_image_to_album')}}"enctype="multipart/form-data">
	  {!! Form::token() !!}
          <input type="hidden" name="album_id"value="{{$album->id}}" />
          <fieldset>
            <legend>Adicione uma imagem ao album {{$album->name}}</legend>
            <div class="form-group">
              <label for="description">Descrição da imagem:</label>
              <textarea name="description" type="text"class="form-control" placeholder="Imagedescription"></textarea>
            </div>
            <div class="form-group">
              <label for="image">Escolha uma imagem:</label>
              {!! Form::file('image') !!}
            </div>
            <button type="submit" class="btnbtn-default">Adicionar imagem!</button>
          </fieldset>
        </form>
      </div>
    </div> <!-- /container -->
@endsection

