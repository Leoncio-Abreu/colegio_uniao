@extends('layouts.frontend_master')
@section('head_extra')
   <link href="{{ asset("/css/magnific-popup.css") }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
      .starter-template {
        padding: 40px 15px;
      text-align: center;
      }


.image-source-link {
	color: #e35a00;
}

.mfp-with-zoom .mfp-container,
.mfp-with-zoom.mfp-bg {
	opacity: 0;
	-webkit-backface-visibility: hidden;
	/* ideally, transition speed should match zoom duration */
	-webkit-transition: all 0.3s ease-out; 
	-moz-transition: all 0.3s ease-out; 
	-o-transition: all 0.3s ease-out; 
	transition: all 0.3s ease-out;
}

.mfp-with-zoom.mfp-ready .mfp-container {
		opacity: 1;
}
.mfp-with-zoom.mfp-ready.mfp-bg {
		opacity: 0.8;
}

.mfp-with-zoom.mfp-removing .mfp-container, 
.mfp-with-zoom.mfp-removing.mfp-bg {
	opacity: 0;
}

    </style>
@endsection
@section('content')
@if($back == 'null')
@elseif($back <> '')
	<p><a href="/galeria/view/{{$back}}/{{$id}}" class="btn btn-big btn-warning">Voltar</a></p>
@else
	<p><a href="/galeria" class="btn btn-big btn-warning">Voltar</a></p>
@Endif
<div class="container">
        <div class="starter-template">
        	<div class="row">
	  		@foreach($grid->rows as $album)
			<?php $album = $album->data ?>
			<div class="col-lg-3">
				<div class="thumbnail">
				@if($album->filename <> '')
					<div class="zoom-gallery">
						<a href="/images/full_size/{{$album->filename}}" data-source="/images/full_size/{{$album->filename}}" title="{{$album->description}}" ><!-- style="width:193px;height:125px;"> -->
							<img src="/images/icon_size/{{$album->filename}}" alt="{{$album->filename}}" width="120" height="80">
						</a>
					</div>
				@endif
			                <div class="caption">
				 		@if($album->name != '')
						<h3>{{$album->name}}</h3>
						@endif
						@if($album->description != '')
						<p style="color:white;">{{$album->description}}</p>
						@endif
				 		@if($album->name != '')
				                <p style="color:white;">Criado em:  {{ date("d/m/Y",strtotime($album->created_at)) }} as {{date("H:i",strtotime($album->created_at)) }}</p>
						<p style="color:white;"><a href="/galeria/view/{{$route}}/{{$album->id}}" class="btn btn-big btn-warning">Entrar</a></p>
						@else
						<br>
						@endif
				       </div> <!-- caption -->
				</div> <!-- Thumbnails -->
			</div> <!-- col -->
          @endforeach
		</div> <!-- row -->
	</div> <!-- /.starter-template -->
</div> <!-- /.container -->
@if($back == 'null')
@elseif($back <> '')
	<p><a href="/galeria/view/{{$back}}/{{$id}}" class="btn btn-big btn-warning">Voltar</a></p>
@else
	<p><a href="/galeria" class="btn btn-big btn-warning">Voltar</a></p>
@Endif
    
@endsection
@section('footer_extra')
<script src="{{ asset("/js/magnific-popup.js") }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.zoom-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
			return item.el.attr('title');
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
		
	});
});
</script>
@endsection
