<h2>Formulario de contato do site do Colégio União</h2>
<br>
<table>
<tr>
	<td><b>Unidade:</b></td><td>Unidade {{ $unidade }}</td>
</tr>
<tr>
	<td><b>Nome do pai/mãe:</b></td><td>{{ $nome_pai }}</td>
</tr>
<tr>
	<td><b>Nome do aluno:</b></td><td>{{ $nome_aluno }}</td>
</tr>
<tr>
	<td><b>Email para contato:</b></td><td>{{ $email }}</td>
</tr>
<tr>
	<td><b>Assunto:</b></td><td>{{ $assunto }}</td>
</tr>
<tr>
	<td><b>Mensagem:</b></td><td>{!! str_replace('\r\n','<br>',$mensagem) !!}</td>
</tr>
</table>




