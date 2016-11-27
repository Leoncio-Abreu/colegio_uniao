@extends('layouts.frontend_master')
@section('content')

<div class="panel" >
	<div class="panel-heading clearfix"><h2 class="panel-title">{!! $noticia->titulo!!}</h2></div>
	<div class="panel-body"><span>{!! $noticia->texto !!}</br></span>
		<div class="panel-footer" style="text-align: center;background-color: white;">
			@if (count($prevPages))
				<a class="btn btn-warning pull-left" href="/view/noticia/{{ $prevPages->id}}" role="button"><< Anterior</a>
			@endif
			<a class="btn btn-warning" href="/" role="button">Voltar</a>
			@if (count($nextPages))
			<a class="btn btn-warning pull-right" href="/view/noticia/{{ $nextPages->id}}" role="button">Seguinte >></a>
			@endif
        </div>
	</div>
</div>
@stop