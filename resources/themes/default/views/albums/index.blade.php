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
      <div class="container">
        <div class="starter-template">
        <div class="row">
          @foreach($albums as $album)
            <div class="col-lg-3">
              <div class="thumbnail">
                <img alt="{{$album->name}}" src="/albums/{{$album->cover_image}}">
                <div class="caption">
                  <h3>{{$album->name}}</h3>
                  <p>{{$album->description}}</p>
                  <p>{{count($album->Photos)}} image(s).</p>
                  <p>Created date:  {{ date("d F Y",strtotime($album->created_at)) }} at {{date("g:ha",strtotime($album->created_at)) }}</p>
                  <p><a href="{{URL::route('galeria.show_album',array('id'=>$album->id))}}" class="btn btn-big btn-default">Ver Album</a></p>
                  <p><a href="{{URL::route('galeria.edit_album_form',array('id'=>$album->id))}}" class="btn btn-big btn-default">Editar Album</a></p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
    
      </div><!-- /.container -->
@endsection
