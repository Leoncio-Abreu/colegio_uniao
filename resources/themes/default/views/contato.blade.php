@extends('layouts.frontend_master')
@section('content')
      <div class="row">
          <div class="col-md-12">
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend><span style="color: black;">Formul&aacute;rio de Contato</span></legend>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Escolha a unidade:</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
      <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
      Unidade I
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="2">
      Unidade II
    </label>
	</div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome_pai">Seu nome:</label>  
  <div class="col-md-4">
  <input id="nome_pai" name="nome_pai" type="text" placeholder="Digite o seu nome" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome_aluno">Nome do aluno:</label>  
  <div class="col-md-4">
  <input id="nome_aluno" name="nome_aluno" type="text" placeholder="Digite o nome do aluno" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email para contato:</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="Digite o seu email" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="assunto">Assunto:</label>  
  <div class="col-md-4">
  <input id="assunto" name="assunto" type="text" placeholder="Digite o assunto" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Mensagem:">Mensagem:</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="Mensagem:" placeholder="Digite a mensagem" name="Mensagem:"></textarea>
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
