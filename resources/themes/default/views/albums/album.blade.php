@extends('layouts.master')
@section('head_extra')
    <style>
      .starter-template {
        padding: 40px 15px;
        text-align: center;
      }
    </style>
@endsection
@section('content')
<a href="{{URL::route('galeria.create_album_form')}}">Criar novo Album</a>
<div class="starter-template">
    <div class="media">
    	<img class="media-object pull-left"alt="{{$album->name}}" src="/albums/{{$album->cover_image}}" width="350px">
      	<div class="media-body">
            <h2 class="media-heading" style="font-size: 26px;">Nome do Album:</h2>
            <p>{{$album->name}}</p>
            <div class="media">
		<h2 class="media-heading" style="font-size: 26px;">Descrição do Album:</h2>
          	<p>{{$album->description}}<p>
          	<a href="{{ URL::route('galeria.add_image', array('id'=>$album->id)) }}"><button type="button"class="btn btn-primary btn-large">Adicionar a foto ao Album</button></a>
          	<a href="{{URL::route('galeria.delete_album',array('id'=>$album->id))}}" onclick="return confirm('Tem a certeza?')"><button type="button"class="btn btn-danger btn-large">Deletar Album</button></a>
            </div>
	</div>
    </div>
</div>

<div class="row">
@foreach($album->Photos as $photo)
    <div class="col-lg-3">
        <div class="thumbnail" style="max-height: 350px;min-height: 350px;">
            <img alt="{{$album->name}}" src="/albums/{{$photo->image}}">
                <div class="caption">
        	    <p>{{$photo->description}}</p>
        	    <p>Criado em:  {{ date("d F Y",strtotime($photo->created_at)) }} at {{ date("g:ha",strtotime($photo->created_at)) }}</p>
        	    <a href="{{URL::route('galeria.delete_image',array('id'=>$photo->id))}}" onclick="returnconfirm('Tem a certeza?')"><button type="button"class="btn btn-danger btn-small">Deletar Imagem</button></a>
        	    <p>Mover imagem para outro Album :</p>
        	    <form name="movephoto" method="POST"action="{{URL::route('galeria.move_image')}}">
		    {!! Form::token() !!}
                    <select name="new_album">
            	    @foreach($albums as $others)
                        <option value="{{$others->id}}">{{$others->name}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="photo"value="{{$photo->id}}" />
                    <button type="submit" class="btn btn-smallbtn-info" onclick="return confirm('Are you sure?')">Mover imagem de Album</button>
                    </form>
		</div>
	    </div>
	</div>
@endforeach
</div>
@endsection
