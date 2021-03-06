@extends('layouts.frontend_master')
@section('content')
      <div class="row">
          <div class="col-md-12">
@if(Session::has('alert-success'))
        <div class="alert alert-warning">
            <a class="close" data-dismiss="alert">×</a>
            {!!Session::get('alert-success')!!}
        </div>
@endif					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> Houve alguns problemas.<br /><br />
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
<form class="form-horizontal" action="/sendemail" method="post">
<fieldset>

<!-- Form Name -->
<legend><span style="color: black;">Formul&aacute;rio de Contato</span></legend>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Escolha a unidade: </label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
    <input type="radio" name="radios" id="radios-0" value="I" @if(Input::old('radios')=="I") checked @endif>
      Unidade I
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="II" @if(Input::old('radios')=="II") checked @endif>
      Unidade II
    </label>
	</div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome_pai">Nome do pai/mãe:</label>  
  <div class="col-md-4">
  <input id="nome_pai" name="nome_pai" type="text" placeholder="Digite o seu nome" class="form-control input-md" required="" value="{{ old('nome_pai') }}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome_aluno">Nome do aluno:</label>  
  <div class="col-md-4">
  <input id="nome_aluno" name="nome_aluno" type="text" placeholder="Digite o nome do aluno" class="form-control input-md" value="{{ old('nome_aluno') }}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email para contato:</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="Digite o seu email" class="form-control input-md" required="" value="{{ old('email') }}">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="assunto">Assunto:</label>  
  <div class="col-md-4">
  <input id="assunto" name="assunto" type="text" placeholder="Digite o assunto" class="form-control input-md" required="" value="{{ old('assunto') }}">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="mensagem">Mensagem:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="mensagem" placeholder="Digite a mensagem" name="mensagem" rows="10" cols="50">{{ old('mensagem') }}</textarea>
  </div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label">Captcha</label>
	<div class="col-md-6">
		{!! app('captcha')->display(); !!}
	</div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-warning">Enviar</button>
  </div>
</div>

</fieldset>
</form>
          </div>
      </div>
@stop
