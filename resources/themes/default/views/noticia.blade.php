@extends('layouts.frontend_master')
@section('content')

<div class="panel" >
	<div class="panel-heading clearfix"><h2 class="panel-title">{!! $noticia->titulo!!}</h2></div>
	<div class="panel-body"><div class="container-fluid">{!! $noticia->texto !!}</div></br>
		<div class="panel-footer" style="text-align: center;">
			@if(count($prevPages))
				<a class="btn btn-warning pull-left" href="/view/noticia/@if(count($prevPages)){{ $prevPages->id}}@endif" role="button" ><< Anterior</a>
			@endif
			<a class="btn btn-warning" href="/" role="button">Voltar</a>
			@if(count($nextPages))
			<a class="btn btn-warning pull-right" href="/view/noticia/{{ $nextPages->id}}" role="button">Seguinte >></a>
			@endif
        </div>
	</div>
</div>
@stop
