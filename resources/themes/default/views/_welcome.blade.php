@extends('layouts.frontend_master')
@section('content')
	<div class="row">
dd($noticias);
@if(count($noticias))
	@for($i = 0; $i < 1; $i++)
			@if($i == 0)
		<div class="col-md-5">
			<div class="panel panel-default">
				@if(is_null($noticias[$i]->titulo))
				<div class="panel-heading">
					<h2 class="panel-title">{{ $noticias[$i]->titulo }}</h2>
				</div>
				@endif
				<div class="panel-body">
					@if(is_null($noticias[$i]->descricao))<p>{!! $noticias[$i]->descricao !!}</p>@endif
					@if(is_null($noticias[$i]->texto))<p>{!! $noticias[$i]->texto !!}</p>@endif
					<div class="bootstrap-eh-pull-bottom clearfix">
						<a class="btn btn-warning pull-right" href="/view/noticia/{{ $noticias[$i]->id }}" role="button">+ mais »</a>
					</div>
				</div>
			</div>
		</div> 
			@else
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
		                <div class="panel-heading">
							<h2 class="panel-title">{{ $noticias[$i]->titulo }}</h2>
						</div>
						<div class="panel-body">
							<p>{!! $noticias[$i]->descricao !!}</p>
							<div class="bootstrap-eh-pull-bottom clearfix">
								<a class="btn btn-warning pull-right" href="/view/noticia/{{ $noticias[$i]->id }}" role="button">+ mais »</a>
							</div>
						</div>
					</div>
				</div>
				@if($i %2 == 0 & count($noticias) != $i)
			</div>	
			<div class="row">
				@endif
			@endif
		@endfor
			</div>
		</div>
	</div>
	<div class="row" style="padding-top:15px;">
		@for ($i = 0; $i < count($atividades); $i++)
		<div class="col-md-3">
			<a href="/view/atividade/{!! $atividades[$i]->id !!}"><div class="panel panel-default">
				<div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/{!! $atividades[$i]->banner !!}" class="img-rounded text-center img-responsive"></div>
				<div class="panel-body">
					<p>{!! $atividades{0}->descricao !!}</p>
				</div>
				</div>
			</a>
		</div>
		@endfor
	</div>
@endif
@stop