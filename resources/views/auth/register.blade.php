@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5%;">
    <div class="row justify-content-center">
        <div class="col-md-8" style="border-radius: 25%;">
            <div class="card bg-light">
                <div class="card-header h1 text-dark text-center"> Zarejestruj się  </div>

                <div class="card-body mt-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-center">

                        <label for="name" class="text-center">Name </label>
                        <br>
                        <input id="name" type="text" class="inputs w-50 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <br><br>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <label for="email" class="text-center">Email </label>
                        <br>
                        <input id="email" type="email" class="inputs w-50 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <br>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label for="password" class="text-center">{{ __('Password') }}</label>
                        <br>
                        <input id="password" type="password" class="inputs w-50 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <br>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <label for="password-confirm" class="text-center">Confirm password</label>
                        <br>
                        <input id="password-confirm" type="password" class="inputs w-50" name="password_confirmation" required autocomplete="new-password">
                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary btn-lg w-25 text-center" style="border-radius: 25px;">
                            {{ __('Register') }}
                        </button>
                            <br>

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
