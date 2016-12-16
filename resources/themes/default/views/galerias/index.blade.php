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
<a href="{{URL::route('galerias.'.$route.'.create')}}">Criar novo {{ $title }}</a>
      <div class="container">
        <div class="starter-template">
        <div class="row">
	  @foreach($grid->rows as $album)
		<?php $album = $album->data ?>
            <div class="col-lg-3">
              <div class="thumbnail">
                <img alt="{{$album->name}}" src="/galeria/{{$route}}/thumb_{{$album->cover_image}}">
                <div class="caption">
                  <h3>{{$album->name}}</h3>
                  <p>{{$album->description}}</p>
                  <p>Criado em:  {{ date("d/m/Y",strtotime($album->created_at)) }} as {{date("H:i",strtotime($album->created_at)) }}</p>
                  <p><a href="/galerias/{{$route}}/view/{{$album->id}}" class="btn btn-big btn-default">Entrar</a></p>
		  <p><a href="/galerias/{{$route}}/edit?modify={{$album->id}}" class="btn btn-big btn-default">Editar {{ $title }}</a></p>
<div class="clearfix">
		  <a class="btn btn-warning pull-left" href="/posicao/galerias.{{$route}}/up/{{ $album->id }}" role="button"><i class="fa fa-arrow-left"></i></a>
		  <a class="btn btn-warning pull-right" href="/posicao/galerias.{{$route}}/down/{{ $album->id }}" role="button"><i class="fa fa-arrow-right"></i></a>
</div>
		</div>
              </div>
            </div>
          @endforeach
	</div>
    
	{!! $grid->paginator->render() !!}
      </div><!-- /.container -->
@endsection
