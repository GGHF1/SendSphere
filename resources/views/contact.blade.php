@extends('layouts.app')

@section('title', 'Contact Us')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/contactstyle.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>Contact Us</h1>
        <form action="{{ route('contact.send') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="category">Subject:</label>
                <select name="category" id="category" required>
                    <option value="">Select a Category</option>
                    <option value="Account Issues">Account Issues</option>
                    <option value="Payment Problems">Payment Problems</option>
                    <option value="Technical Support">Technical Support</option>
                    <option value="Fraud and Security">Fraud and Security</option>
                    <option value="Disputes and Claims">Disputes and Claims</option>
                    <option value="General Inquiry">General Inquiry</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="{{ Auth::check() ? Auth::user()->fname : '' }}" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="{{ Auth::check() ? Auth::user()->lname : '' }}" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="5" class="restricted-textarea" required></textarea>
            </div>
            <button type="submit">Ask the Question</button>
        </form> 
    </div>
@endsection