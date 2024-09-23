<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function RegForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'regex:/^[A-Za-z]+$/'], 
            'lname' => ['required', 'regex:/^[A-Za-z]+$/'], 
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'phone' => ['required', 'regex:/^\d+$/'], 
            'email' => ['required', 'email'], 
            'username' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'min:4', 'max:20'],
            'password' => [
                'required', 
                'min:8', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ], 
            'DOB' => ['required', 'date', 'before:today', 'before_or_equal:' . now()->subYears(18)->toDateString()], 
            'gender' => 'required'
        ], [
            'fname.regex' => 'First name must contain only letters.',
            'lname.regex' => 'Last name must contain only letters.',
            'phone.regex' => 'Phone number should only contain digits.',
            'username.regex' => 'Username must contain only letters and digits.',
            'password.regex' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'DOB.before_or_equal' => 'You must be at least 18 years old.',
            'DOB.before' => 'Date of birth cannot be in the future.'
        ]);

        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'DOB' => $request->DOB,
            'gender' => $request->gender,
        ]);

        return redirect('/login')->with('success');
    }

    public function LogForm()
    {
        return view('login');
    }
    
    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/main');
        }

        return redirect('/login')->with('error');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
