<?php

namespace App\Http\Controllers;

use App\Models\Setting as SettingModel;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Setting;

class EmailController extends Controller
{
 public function sendemail(Request $request)
 {
	$unidade = $request->input('radios');
	$nome_pai = $request->input('nome_pai');
	$nome_aluno = $request->input('nome_aluno');
	$email = $request->input('email');
	$assunto = $request->input('assunto');
	$mensagem = $request->input('mensagem');

	dd($request);
	// To Colegio
	Mail::send(['html' => 'emails.html.contato', 'text' => 'emails.text.contato'], ['unidade' => $unidade, 'nome_pai' => $nome_pai, 'nome_aluno' => $nome_aluno, 'email' => $email, 'assunto' => $assunto, 'mensagem' => $mensagem], function ($message) use ($email, $nome_aluno, $assunto) {
		$message->replyTo($email);
		$message->from(Setting::get('mail.system_sender_address'), Setting::get('mail.system_sender_label'));
		$message->to(Setting::get('mail.system_sender_address'), Setting::get('mail.system_sender_label'));
		$message->subject($assunto);
	});
	
 	// To Sender
	Mail::send(['html' => 'emails.html.contato', 'text' => 'emails.text.contato'], ['unidade' => $unidade, 'nome_pai' => $nome_pai, 'nome_aluno' => $nome_aluno, 'email' => $email, 'assunto' => $assunto, 'mensagem' => $mensagem], function ($message) use ($email) {
		$message->from(Setting::get('mail.system_sender_address'), Setting::get('mail.system_sender_label'));
		$message->to($email);
		$message->subject('Contato pelo site do colégio União');
	});
 }
}
