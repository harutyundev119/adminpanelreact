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
                        <a href="{{route('contact', app()->getLocale())}}">@lang('main.contact-us')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contactus">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 commontop text-center">
                    <h4>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        @lang('main.contact-us')
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                        <i class="icon_star_alt"></i>
                    </h4>
                    <p>@lang('main.send-us-message')</p>
                </div>
                <div class="col-sm-offset-2 col-md-8 col-sm-8  col-xs-12">
                    <form id="contact-form" name="contact_form" class="form-horizontal" action="{{route('contact_post', app()->getLocale())}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" value="" placeholder="@lang('main.name')" id="input-name" class="form-control"  />
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="email" value="" placeholder="@lang('main.email')" id="input-email" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="phone" value="" placeholder="@lang('main.phone')" id="input-phone" class="form-control" />
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="subject" value="" placeholder="@lang('main.subject')" id="input-subject" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 col-md-12 col-xs-12">
                                <i class="icofont icofont-pencil-alt-5"></i>
                                <textarea name="message" placeholder="@lang('main.message')" id="input-enquiry" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="buttons text-right">
                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                            <button class="btn btn-primary col-xs-12" type="submit" value="">@lang('main.send')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="address">
                    <ul class="list-inline">
                        <li>
                            <i class="icon_map_alt"></i>
                            {{$contact_us->getTranslatedAttribute('address',config('app.locale'),config('voyager.multilingual.default'))}}
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            {{$contact_us->email}}
                        </li>
                        <li>
                            <i class="icon_mobile"></i>
                            {{$contact_us->phone}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12200.768706196564!2d44.45748249975192!3d40.13800278674861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abe95602c9451%3A0x9eed9c7615c73ea8!2zMjggU2hhcnVyIFN0LCBZZXJldmFuLCDQkNGA0LzQtdC90LjRjw!5e0!3m2!1sru!2s!4v1586603444371!5m2!1sru!2s"></iframe>
    </div>

@endsection
