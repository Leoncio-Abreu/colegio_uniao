@extends('layouts.frontend_master')
@section('content')
	<div class="row">
		@for ($i = 0; $i < count($noticias); $i++)
		@if($i == 0)
		<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<h2 class="panel-title">{{ $noticias[$i]->titulo }}</h2>

					</div>
                    <div class="panel-body">
						<img class="img-rounded text-center img-responsive" alt="" src="/upload/noticias/banner/{!! $noticias[$i]->banner !!}">						<div class="bootstrap-eh-pull-bottom clearfix"><br>
							<p>{!! $noticias[$i]->descricao !!}
							<a class="btn btn-warning pull-right" href="/view/noticia/{!! $noticias[$i]->id !!}" role="button">+ mais »</a></p>
						</div>
					</div>
				</div>
		</div> 
		<div class="col-md-7">
			<div class="row">
		@else
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
				@if($i+1 %2 == 0 & count($noticias) != $i)
			</div>	
			<div class="row">
				@endif
		@endif
		@endfor
			</div>
		</div>
	</div>
	<div class="row">
		@for ($i = 0; $i < count($atividades); $i++)
		<div class="col-md-3">
			<a href="/view/atividade/{!! $atividades[$i]->id !!}"><div class="panel panel-default">
				<div class="panel-heading text-center"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/{!! $atividades[$i]->banner !!}" class="img-rounded text-center img-responsive"></div>
				<div class="panel-body">
					<span>{!! $atividades{0}->descricao !!}</span>
				</div>
				</div>
			</a>
		</div>
		@endfor
	</div>
@stop