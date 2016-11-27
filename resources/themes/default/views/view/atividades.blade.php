@extends('layouts.frontend_master')
@section('content')
              <div class="row">
                  <div class="col-md-12">
<div class="panel panel-default">dd($atividades);
	<div class="panel-heading"><h2 class="panel-title">@if (count($atividade)){{ $atividade->titulo}}@endif</h2></div>
	<div class="panel-body"><div class="container-fluid">@if (count($atividade)){!! $atividade->texto !!}@endif</div></br>
		<div class="panel-footer" style="text-align: center;">
			@if (count($prevPages))
				<a class="btn btn-warning pull-left" href="/view/atividade/{{ $prevPages->id}}" role="button">Anterior</a>
			@endif
			<a class="btn btn-warning" href="/" role="button">Voltar</a>
			@if (count($nextPages))
				<a class="btn btn-warning pull-right" href="/view/atividade/{{ $nextPages->id}}" role="button">Seguinte </a>
			@endif
        </div>
	</div>
</div>
	</div>
</div>
@stop