@extends('layouts.master')
@section('content')
    <div class='row'>
        <div class='col-md-12'>
                {!! Form::open([ 'route' => [ 'galerias.fotos.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'book-image' ]) !!}
                <div>
                    <h3>Enviar Imagem</h3>
                </div>
                {!! Form::close() !!}
	</div>
    </div>
@endsection
@section('head_extra')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	{!! Html::script('js/upload.js') !!}
<link href="http://uniao.local/css/dropzone.css" rel="stylesheet" type="text/css" />	
@stop
