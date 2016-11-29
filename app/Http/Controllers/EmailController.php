<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
 public function sendemail(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('chrisn@scotch.io');

        });

		Mail::send(['html' => 'emails.html.password_changed', 'text' => 'emails.text.password_changed'], ['user' => $this], function ($message) {
			$message->from(Setting::get('mail.system_sender_address'), Setting::get('mail.system_sender_label'));
			$message->to($this->email, $this->full_name)->subject('Contato do site do colégio União'));
		});
    }
}
