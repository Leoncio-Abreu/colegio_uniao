<?php

namespace App\Http\Controllers;

use App\Models\Setting as SettingModel;
use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Setting;

use Input;
use Validator;
use Redirect;
use Session;
use Flash;
class EmailController extends Controller
{
 public function sendemail(Request $request)
 {
	    $data = Input::all();
	    $rules = array(
		  	'radios' => 'required',
		  	'nome_pai' => 'required',
		  	'nome_aluno' => 'required',
		  	'email' => 'required|email',
			'assunto' => 'required',
//			'g-recaptcha-response' => 'required|captcha',
			'mensagem' => 'required',
		);
		$validator = Validator::make($data, $rules, [],['g-recaptcha-response' => ' Captcha']);
		if ($validator->fails()){
		    return Redirect::to('/contato')->withInput()->withErrors($validator);
		}
		else{
		    // Do your stuff.
	$unidade = $request->input('radios');
	$nome_pai = $request->input('nome_pai');
	$nome_aluno = $request->input('nome_aluno');
	$email = $request->input('email');
	$assunto = $request->input('assunto');
	$mensagem = $request->input('mensagem');
	$froma = Setting::get('mail.system_sender_address');
	$froml = Setting::get('mail.system_sender_label');
	

	// To Colegio
	Mail::send(['html' => 'emails.html.contato', 'text' => 'emails.text.contato'], ['unidade' => $unidade, 'nome_pai' => $nome_pai, 'nome_aluno' => $nome_aluno, 'email' => $email, 'assunto' => $assunto, 'mensagem' => $mensagem], function ($message) use ($email, $nome_aluno, $assunto, $froma, $froml) {
		$message->replyTo($email);
		$message->from($froma, $froml);
		$message->to($froma, $froml);
		$message->subject($assunto);
	});
	
 	// To Sender
	Mail::send(['html' => 'emails.html.contato', 'text' => 'emails.text.contato'], ['unidade' => $unidade, 'nome_pai' => $nome_pai, 'nome_aluno' => $nome_aluno, 'email' => $email, 'assunto' => $assunto, 'mensagem' => $mensagem], function ($message) use ($email, $froma, $froml) {
		$message->from($froma, $froml);
		$message->to($email);
		$message->subject('Contato pelo site do colégio União');
	});
    $request->session()->flash('alert-success', 'O formulario foi enviado por email com sucesso!');
    return redirect()->route("contato");	
		}
 }
}
