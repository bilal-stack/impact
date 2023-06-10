@extends('front.layouts.app')
@section('template_title')
   {{config('app.name', Lang::get('titles.app')) }} | Login
@endsection

@section('css')
    <style>
        .invalid-feedback {
            color: red;
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
                        <h1>Login</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Inner Page Banner  -->
    <!-- Login  -->
    <section class="Login-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="iner-baner-head">
                        <h3>WELCOME TO</h3>
                        <h1>Images2 Impact </h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna alion.</p>
                    </div>
                </div>
                <div class="col-md-6 form-bg">
                    <div class="log-forms">
                        <h1>LOGIN</h1>
                        <p>Agent Login Panel</p>
                        <!-- Error message -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" required autofocus type="email" placeholder="Email Address">
                                <span style="color: red"></span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Password" name="password" required>
                                <span style="color: red"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn login-btn" name="form1">Login</button>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" value="" id="flexCheckDefault" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Keep me logged in
                                </label>
                            </div>
                        </form>
                        <div class="form-under-btn">
                            <div class="forgot">
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('auth.forgot') }}
                                </a>
                            </div>
                            <p>Don't have an account? <a href="{{route('register')}}">Register</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
