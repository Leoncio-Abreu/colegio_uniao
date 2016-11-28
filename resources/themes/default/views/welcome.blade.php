@extends('layouts.frontend_master')
@section('content')
	<div class="row">
		@for ($i = 0; $i < count($noticias); $i++)
		@if($i == 0)
		<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<h2 class="panel-title">@if(!is_null($noticias[$i]->titulo)){{ $noticias[$i]->titulo }}@endif</h2>

					</div>
                    <div class="panel-body" style="text-align: center;">
						@if(!is_null($noticias[$i]->banner)){!! $noticias[$i]->banner !!}@endif"
						<p>@if(!is_null($noticias[$i]->descricao)){!! $noticias[$i]->descricao !!}@endif
					</div>
					<div class="panel-footer box-footer">
						<div class="bootstrap-eh-pull-bottom clearfix"><br>
							<a class="btn btn-warning pull-right" href="/view/noticia/@if(!is_null($noticias[$i]->id)){!! $noticias[$i]->id !!}@endif" role="button">+ mais »</a></p>
						</div>
					</div>
				</div>
		</div> 
		<div class="col-md-7">
			<div class="row">
		@else
				<div class="col-md-6">
					<div class="panel panel-default">
		                <div class="panel-heading box-heading">
							<h2 class="panel-title">@if(!is_null($noticias[$i]->titulo)){{ $noticias[$i]->titulo }}@endif</h2>
						</div>
						<div class="panel-body box-body">
							<p>@if(!is_null($noticias[$i]->descricao)){!! $noticias[$i]->descricao !!}@endif</p>
						</div>
						<div class="panel-footer box-footer">
							<div class="bootstrap-eh-pull-bottom clearfix">
								<a class="btn btn-warning pull-right" href="/view/noticia/@if(!is_null($noticias[$i]->id)){{ $noticias[$i]->id }}@endif" role="button">+ mais »</a>
						</div>
							</div>
					</div>
				</div>
				@if($i %2 == 0 & count($noticias) != $i+1)
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
			<a href="/view/atividade/@if(!is_null($atividades[$i]->id)){!! $atividades[$i]->id !!}@endif" sti><div class="panel panel-default">
				<div class="panel-heading"><img alt="Bootstrap Image Preview" src="/upload/atividades/banner/@if(!is_null($atividades[$i]->banner)){!! $atividades[$i]->banner !!}@endif" class="img-rounded img-responsive"  style="display: block; margin-left: auto; margin-right: auto;"></div>
				<div class="panel-body">
					<span style="color: black;">@if(!is_null($atividades{0}->descricao)){!! $atividades{0}->descricao !!}@endif</span>
				</div>
				</div>
			</a>
		</div>
		@endfor
	</div>
@stop
