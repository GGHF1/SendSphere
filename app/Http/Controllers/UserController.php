<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Countries;
use App\Models\Cities;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function RegForm()
    {
        $countries = Countries::all();
        $cities = Cities::all();
        return view('register', compact('countries', 'cities'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'regex:/^[A-Za-z]+$/'], 
            'lname' => ['required', 'regex:/^[A-Za-z]+$/'], 
            'country_id' => 'required|exists:countries,country_id', 
            'city_id' => 'required|exists:cities,city_id',   
            'address' => 'required',
            'zip' => 'required',
            'phone' => ['required', 'regex:/^\d+$/', 'unique:users,phone'], 
            'email' => ['required', 'email', 'unique:users,email'], 
            'username' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'min:4', 'max:20', 'unique:users,username'],
            'password' => [
                'required',
                'confirmed', 
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

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'DOB' => $request->DOB,
            'gender' => $request->gender,
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect('/email/verify')->with('success', 'Please verify your email address.');
    }

    public function LogForm()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at) {
                return redirect()->intended('/main');
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Please verify your email address first.');
            }
        }
    
        return redirect('/login')->with('error', 'Invalid credentials.');
    }
    

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
