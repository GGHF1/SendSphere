<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 

class MainController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function main(){
        $user = Auth::user();

        return view('main');
    }

    public function contact(){
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'email' => 'required|email',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only('category', 'email', 'fname', 'lname', 'message');

        Mail::send([], [], function ($message) use ($data) {
            $message->to('spheresend@gmail.com')
                ->subject('Subject: ' . $data['category'])
                ->text('Email: ' . $data['email'] . "\n" .
                          'First Name: ' . $data['fname'] . "\n" .
                          'Last Name: ' . $data['lname'] . "\n" .
                          'Message: ' . $data['message']);
        });

        return redirect()->route('contact.submitted');
    }
}
