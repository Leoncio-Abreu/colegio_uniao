<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
 public function sendemail(Request $request)
    {
	$unidade = $request->input('unidade');
	$nome_pai = $request->input('nome_pai');
	$nome_aluno = $request->input('nome_aluno');
	$email = $request->input('email');
	$assunto = $request->input('assunto');
	$mensagem = $request->input('mensagem');

		Mail::send(['html' => 'emails.html.contato', 'text' => 'emails.text.contato'], ['unidade' => $unidade, 'nome_pai' => $nome_pai, 'nome_aluno' => $nome_aluno, '' => $,'email' => $email, 'assunto' => $assunto, 'mensagem' => $mensagem], function ($message) {
//		        $message->from('me@gmail.com', 'Christian Nwamba');
//		        $message->to('chrisn@scotch.io');
			$message->from(Setting::get('mail.system_sender_address'), Setting::get('mail.system_sender_label'));
			$message->to('leoncio.abreu@gmail.com', 'Leôncio União');
			$message->subject('Contato pelo site do colégio União');
		});
    }
}
