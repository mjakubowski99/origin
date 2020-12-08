@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5%;">
    <div class="row justify-content-center">
        <div class="col-md-8" style="border-radius: 25%;">
            <div class="card bg-light">
                <div class="card-header h1 text-light text-center" style="background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url('{{asset('storage/train-bg.jpg')}}') no-repeat center center fixed;"> Zaloguj się </div>

                <div class="card-body mt-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">

                        <input id="email" placeholder="email address" type="email" class="inputs w-50 mb-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <br>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" placeholder="password" type="password" class="inputs w-50 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <br>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>

                            <button type="submit" class="btn btn-primary btn-lg w-25 text-center" style="border-radius: 25px;">
                                {{ __('Login') }}
                            </button>
                            <br>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <div class="form-check" >
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
