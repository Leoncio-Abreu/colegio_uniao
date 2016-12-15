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
      <div class="container">
        <div class="starter-template">
        <div class="row">
          @foreach($galerias as $galeria)
            <div class="col-lg-3">
              <div class="thumbnail">
                <img alt="{{$galeria->name}}" src="/galerias/{{$galeria->cover_image}}">
                <div class="caption">
                  <h3>{{$galeria->name}}</h3>
                  <p>{{$galeria->description}}</p>
                  <p>{{count($galeria->Photos)}} imagem(s).</p>
                  <p>Criado em:  {{ date("d F Y",strtotime($galeria->created_at)) }} at {{date("g:ha",strtotime($galeria->created_at)) }}</p>
                  <p><a href="{{URL::route('galeria.show_galeria',array('id'=>$galeria->id))}}" class="btn btn-big btn-default">Ver Galeria</a></p>
                  <p><a href="{{URL::route('galeria.edit_galeria_form',array('id'=>$galeria->id))}}" class="btn btn-big btn-default">Editar Galeria</a></p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
    
      </div><!-- /.container -->
@endsection
