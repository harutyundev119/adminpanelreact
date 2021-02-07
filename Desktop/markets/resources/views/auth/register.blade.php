@extends('layouts.main')

@section('content')
<div class="register">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12"></div>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="commontop text-left">
                <h4>
                    <i class="icon_star_alt"></i>
                    <i class="icon_star_alt"></i>
                    <i class="icon_star_alt"></i>
                    @lang('main.register')
                    <i class="icon_star_alt"></i>
                    <i class="icon_star_alt"></i>
                    <i class="icon_star_alt"></i>
                </h4>
            </div>

            <form method="POST" action="{{ route('register') }}" class="default-form">
                @csrf
                <div class="form-group">
                    <label for="name">@lang('main.name')</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">@lang('main.phone')</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">@lang('main.address')</label>
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">@lang('main.email')</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">@lang('main.password')</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">@lang('main.confirm-password')</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
{{--                <div class="links">--}}
{{--                    <input class="checkclass checkbox-inline" type="checkbox">Համաձայն եմ պայմաններին--}}
{{--                </div>--}}
                <button class="btn btn-primary col-xs-12" type="submit">@lang('main.register')</button>
            </form>
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
                <h4 class="p-15 mt-10 pb-10">@lang('main.do-you-have-an-account') <a href="{{route('login')}}" class="btn btn-primary col-xs-12" type="submit">@lang('main.login-now')</a></h4>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12"></div>
        </div>
    </div>
</div>
@endsection
