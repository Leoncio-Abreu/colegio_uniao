@extends('layouts.frontend_master')
@section('content')

<div class="panel" >
	<div class="panel-heading clearfix"><h2 class="panel-title">@if (count($noticia)){{ $noticia->titulo}}@endif</h2></div>
	<div class="panel-body">@if (count($noticia)){!! $noticia->texto !!}@endif</br>
		<div class="panel-footer bootstrap-eh-pull-bottom clearfix" style="text-align: center;">
			@if ($prevPages > 0)
				<a class="btn btn-warning pull-left" href="/view/noticia/{{ $noticia->id}}/prev" role="button"><< Anterior</a>
			@endif
			<a class="btn btn-warning" href="/" role="button">Voltar</a>
			@if ($nextPages > 0)
			<a class="btn btn-warning pull-right" href="/view/noticia/{{ $noticia->id}}/next" role="button">Seguinte >></a>
			@endif
        </div>
	</div>
</div>
@stop