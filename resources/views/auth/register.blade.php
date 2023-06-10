@extends('front.layouts.app')
@section('template_title')
    {{config('app.name', Lang::get('titles.app')) }} | Register
@endsection

@section('css')
    <style>
        .invalid-feedback {
            color: red;
        }
        .new-agents input[type="number"] {
            margin-bottom: 20px;
            background-color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('content')
    <!-- Inner Page Banner  -->
    <section class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-page-heading">
                        <h1>Sign Up</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- sign-up form -->
    <section class="signup-form">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="new-agents">
                        <h2>Create a New Account</h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="sing-form">
                        @csrf
                        <div class="new-agents form-row pt-3">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Username" name="name" value="{{ old('name') }}" required autofocus autocomplete="off">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="number" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="Confirm Password" required>

                            </div>

                            @if(config('settings.reCaptchStatus'))
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-4">
                                        <div class="g-recaptcha" data-sitekey="{{ config('settings.reCaptchSite') }}"></div>
                                    </div>
                                </div>
                            @endif

                            @if ($errors->has('captcha'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                            @endif
                            <div class="form-group col-md-12 enroll-frm-btn">
                                <button type="submit" class="btn btn-warning-signup btn-new" name="form1">Register</button>
                            </div>
                            <div class="form-group form-check" style="padding-left: 35px">
                                <p class="account">Already have an Account?  <a href="{{route('login')}}">Log In</a></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="enroll-image">
                        <img src="{{asset('front/assets/images/about.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign-up form -->
@endsection

@section('footer_scripts')
    @if(config('settings.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endsection
