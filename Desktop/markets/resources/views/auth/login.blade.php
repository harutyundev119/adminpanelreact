@extends('layouts.main')

@section('content')

<div class="register">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-6 col-sm-6 col-xs-12 box">
                <div class="commontop text-left">
                    <h4>@lang('main.registered-customers')</h4>
                    <h5 class="pt-10">@lang('main.if-have-acc')</h5>
                </div>
                <ul class="list-inline">
                    <li>
                        <a href="{{ url('auth/facebook') }}" target="_blank">
                            <i class="social_facebook"></i> Facebook
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('auth/google') }}" target="_blank">
                            <i class="social_googleplus"></i> Google +
                        </a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">@lang('main.email')</label>
                        <input id="email input-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">@lang('main.password')</label>
                        <input id="password input-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="links">
                        <input class="checkclass checkbox-inline" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            @lang('main.remember-me')
                        </label>
                        @if (Route::has('password.request'))
                            <a class="pull-right pt-10" href="{{ route('password.request') }}">
                                @lang('main.forgot-password')
                            </a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary col-xs-12 mb-30">@lang('main.login')</button>
                </form>
                <h4 class="mt-10">@lang('main.dont-have-an-account-yet') </h4>
                <a href="{{route('register')}}" class="btn btn-primary col-xs-12" type="submit">@lang('main.register') </a>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12"></div>
        </div>
    </div>
</div>
@endsection
