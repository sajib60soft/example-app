<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('pages.send-mail');
    }

    public function mailSend(Request $request)
    {
        $details = [
            'title' => 'Mail from Test',
            'message' => 'This is for testing email using smtp'
        ];
        Mail::to($request->email)->send(new MyTestMail($details));
        dd("Email is Sent.");
    }
}
