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
<a href="{{URL::route('galeria.create_galeria_form')}}">Criar nova Galeria</a>
<div class="starter-template">
    <div class="media">
    	<img class="media-object pull-left"alt="{{$galeria->name}}" src="/galerias/{{$galeria->cover_image}}" width="350px">
      	<div class="media-body">
            <h2 class="media-heading" style="font-size: 26px;">Nome da Galeria:</h2>
            <p>{{$galeria->name}}</p>
            <div class="media">
		<h2 class="media-heading" style="font-size: 26px;">Descrição da Galeria:</h2>
          	<p>{{$galeria->description}}<p>
          	<a href="{{ URL::route('galeria.add_image', array('id'=>$galeria->id)) }}"><button type="button"class="btn btn-primary btn-large">Adicionar Galeria</button></a>
          	<a href="{{URL::route('galeria.delete_galeria',array('id'=>$galeria->id))}}" onclick="return confirm('Tem a certeza?')"><button type="button"class="btn btn-danger btn-large">Deletar Galeria</button></a>
            </div>
	</div>
    </div>
</div>

<div class="row">
@foreach($galerias->Albums as $album)
    <div class="col-lg-3">
        <div class="thumbnail" style="max-height: 350px;min-height: 350px;">
            <img alt="{{$album->name}}" src="/galerias/{{$album->image}}">
                <div class="caption">
        	    <p>{{$album->description}}</p>
        	    <p>Criado em:  {{ date("d F Y",strtotime($album->created_at)) }} at {{ date("g:ha",strtotime($album->created_at)) }}</p>
        	    <a href="{{URL::route('galeria.delete_image',array('id'=>$album->id))}}" onclick="returnconfirm('Tem a certeza?')"><button type="button"class="btn btn-danger btn-small">Deletar Imagem</button></a>
        	    <p>Mover Album para outra Galeria:</p>
        	    <form name="movephoto" method="POST"action="{{URL::route('galeria.move_image')}}">
		    {!! Form::token() !!}
                    <select name="new_galeria">
            	    @foreach($galerias as $others)
                        <option value="{{$others->id}}">{{$others->name}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="photo"value="{{$album->id}}" />
                    <button type="submit" class="btn btn-smallbtn-info" onclick="return confirm('Are you sure?')">Mover Album de Galeria</button>
                    </form>
		</div>
	    </div>
	</div>
@endforeach
</div>
@endsection
