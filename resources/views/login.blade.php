@extends('layouts.frontend')
@section('content')
    <section id="mid-content" class="row">
        <div class="col-lg-4">
            <img id="picture-right" class="img-fluid d-none d-lg-block" src="{{asset('images/side-left-login.png')}}" alt="side-picture">
        </div>
        <div class="col-lg-4">
            <div class="d-flex justify-content-center h-100">
                {{-- <div class="container">--}}
                {{-- <div class="row justify-content-center">
                     <div class="col-md-8">--}}
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Login') }}</h3>
                    </div>
                    <div class="card-body mt-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group align-content-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fas fa-envelope-square"></i></span>
                                    <input id="email" type="email" placeholder="E-mailadres"
                                           class="form-control @error('email') is-invalid @enderror rounded-0" name="email" value="{{ old('email') }}"
                                           required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                {{-- <span class="invalid-feedback" role="alert">--}}
                                <strong>{{ $message }}</strong>
                                {{-- </span>--}}
                                @enderror
                            </div>
                            <div class="form-group align-content-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i class="fas fa-key"></i></span>
                                    <input id="password" type="password" placeholder="Paswoord"
                                           class="form-control @error('password') is-invalid @enderror rounded-0" name="password"
                                           required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label remember" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn float-right login_btn">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <img id="picture-left" class="img-fluid d-none d-lg-block" src="{{asset('images/side-right-login.png')}}" alt="side-picture">
        </div>
    </section>
@endsection
