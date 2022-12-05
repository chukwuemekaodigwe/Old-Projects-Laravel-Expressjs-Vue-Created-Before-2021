<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    //

    public function index()
    {

        return view('support');
    }

    public function forward(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'max:300'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $name = strip_tags($request->name);
        $subject = strip_tags($request->subject);
        $message = strip_tags($request->message);

        $subj1 = ' Message Received From a visitor @' . $_SERVER['SERVER_NAME'];
        $msgs = '';
        $msgs .= '
			The details is as follows:<br>
            <ul style="list-style: none;">
            <li> Subject: ' . $subject . '</li>
			<li> Name: ' . ucwords($name) . '</li>
			<li> Email Address: ' . strtolower($request->email) . '</li>

			<li style="text-align: justify; padding: 10px 20px;"> Message: ' . $message . '</li>

			</ul>

			<p> Dated: ' . date('Y-m-d', strtotime('today')) . '</p>
            ';

        $subj = $subj1 . ' @ ' . $_SERVER['SERVER_NAME'];
        $headers = array(
            'FROM: "PECO - ONLINE" <engine@' . $_SERVER['SERVER_NAME'] . '>',
            'Reply-To: "DO-NOT-REPLY" <noreply@' . $_SERVER['SERVER_NAME'] . '>',
            'X-Mailer: PHP/' . phpversion(),
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=utf-8',
            'Content-Transfer-Encoding: 7bit',

        );
        $headers = implode("\r\n", $headers);

        $messagebody = $msgs;
        $message = '';

        $message .= $messagebody . "\r\n";

        $mailsent = mail('support@'.$_SERVER['SERVER_NAME'], $subj, $message, $headers);
        if ($mailsent) {
            $request->session()->flash('message', 'Request Sent Successful!, you will be responded shortly');
            $request->session()->flash('alert-class', 'alert-success');
        } else {
            $request->session()->flash('message', 'Not Successful, please retry!');
            $request->session()->flash('alert-class', 'alert-danger');

        }
    }
}
