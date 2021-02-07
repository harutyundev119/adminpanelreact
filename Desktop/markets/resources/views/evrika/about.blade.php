@extends('layouts.main')

@section('content')

    <div class="bread-crumb">
        <img src="/evrika/images/top-banner.jpg" class="img-responsive" alt="banner-top" title="banner-top">
        <div class="container">
            <div class="matter">
                <h2><span>@lang('main.evrika-supermarket')</span></h2>
                <ul class="list-inline">
                    <li>
                        <a href="/">@lang('main.general')</a>
                    </li>
                    <li>
                        <a>@lang('main.about')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="organic">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 commontop text-center">
                    <h4>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        @lang('main.welcome-to-our-website')
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                    </h4>
                    <p>{{$about_headers->getTranslatedAttribute('header',config('app.locale'),config('voyager.multilingual.default'))}}</p>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                    <p class="des">{{$about_headers->getTranslatedAttribute('first_text',config('app.locale'),config('voyager.multilingual.default'))}}</p>
                    <p class="des2"><i class="icon_quotations first"></i>{{$about_headers->getTranslatedAttribute('image_text',config('app.locale'),config('voyager.multilingual.default'))}}<i class="icon_quotations last"></i></p>
                    <p class="des">{{$about_headers->getTranslatedAttribute('second_text',config('app.locale'),config('voyager.multilingual.default'))}}</p>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                    <img src="/evrika/images/about/lemon-banner.png" class="img-responsive" alt="banner" title="banner" />
                </div>
            </div>
        </div>
    </div>

    <div class="chooseus">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 commontop text-center">
                    <h4>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        @lang('main.use-our-services')
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                    </h4>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                    <div class="box">
                        <ul class="list-unstyled">
                            @foreach($about_services as $about_service)
                            <li>
                                <img src="{{$about_service->icon_name}}" class="img-responsive" alt="img" title="img">
                                <h3>{{$about_service->getTranslatedAttribute('title',config('app.locale'),config('voyager.multilingual.default'))}}</h3>
                                <p>{{$about_service->getTranslatedAttribute('text',config('app.locale'),config('voyager.multilingual.default'))}}</p>
                            </li>
                            @endforeach
                        </ul>
                        <img src="/evrika/images/about/medium-banner.png" class="img-responsive vegbanner" alt="img" title="img">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($about_avards->isEmpty())
        <div id="carousel10" class="owl-carousel aboutcarousel"></div>
    @else
        <div id="carousel10" class="owl-carousel aboutcarousel">
            @foreach($about_avards as $about_avard)
                <div class="item">
                    <div class="box">
                        <img class="img-responsive" src="/storage/{{$about_avard->image}}" alt="logo" title="logo">
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
