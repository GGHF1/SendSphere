@extends('layouts.app')

@section('title', 'Registration')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/registerstyle.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>Registration</h1>

        <form id="registration-form" action="{{ route('register') }}" method="post">
            @csrf
            <div id="step1">
                <div class="group">
                    <input type="text" name="email" id="email" placeholder="Email" required value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="emailError" class="error-message"></div>
                </div>
                <div class="group">
                    <input type="text" name="username" id="username" placeholder="Username" required minlength="4" value="{{ old('username') }}" class="@error('username') is-invalid @enderror">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="usernameError" class="error-message"></div>
                </div>
                <div class="group">
                    <input type="password" name="password" id="password" placeholder="Password" required class="@error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="passwordError" class="error-message"></div>
                </div>
                <div class="group">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required class="@error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="confirmPasswordError" class="error-message"></div>
                </div>
                <button type="button" id="next-button" disabled>Next</button>
            </div>

            <div id="step2" style="display: none;">
                <div class="row">
                    <div class="group">
                        <input type="text" name="fname" id="fname" placeholder="First Name" required value="{{ old('fname') }}" class="@error('fname') is-invalid @enderror">
                        @error('fname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="fnameError" class="error-message"></div>
                    </div>
                    <div class="group">
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required value="{{ old('lname') }}" class="@error('lname') is-invalid @enderror">
                        @error('lname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="lnameError" class="error-message"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="group">
                        <select name="country_id" id="country" required>
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->country_id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="group">
                        <select name="city_id" id="city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="group">
                        <input type="text" name="address" id="address" placeholder="Address" required value="{{ old('address') }}" class="@error('address') is-invalid @enderror">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="group">
                        <input type="text" name="zip" id="zip" placeholder="Zip" maxlength="10" required value="{{ old('zip') }}" class="@error('zip') is-invalid @enderror">
                        @error('zip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="group">
                        <input type="text" name="phone" id="phone" placeholder="Phone" required value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="phoneError" class="error-message"></div>
                    </div>
                    <div class="group">
                        <input type="date" name="DOB" id="DOB" placeholder="Date of Birth" required value="{{ old('DOB') }}" class="@error('DOB') is-invalid @enderror">
                        @error('DOB')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="dobError" class="error-message"></div>
                    </div>
                    <div class="group">
                        <select id="gender" name="gender" required class="@error('gender') is-invalid @enderror">
                            <option value="">Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" id="reg-button">Register</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/regcheck.js') }}"></script>
    <script src="{{ asset('js/cityfilter.js') }}"></script>
@endsection
