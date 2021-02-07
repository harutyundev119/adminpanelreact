<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google-site-verification" content="jwP74LPCLrtO_M8g0dIJAWXmROIPFs5wLmiUDEmvHkQ" />

    <title>Evrika</title>

    <!-- Fonts -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/evrika/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/evrika/js/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/evrika/js/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,600,700,800,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('/evrika/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/evrika/css/ele-style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/evrika/js/preetycheble/prettyCheckable.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('/evrika/css/custom-bootstrap-margin-padding.css') }}" rel="stylesheet" />
    <link href="{{ asset('/evrika/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/evrika/css/my_style.css') }}" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/evrika/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/evrika/images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/evrika/images/favicon/favicon-16x16.png" sizes="16x16">

</head>
<body>
<?php
use App\Http\Controllers\UrlController;
$iso = UrlController::geturl();
$languages = UrlController::languages();
$set_lang = UrlController::set_language();
?>
<!-- =======================================================
                        HEADER
                        ========================================================= -->
<div class="top top_nav">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 topmenu">
                <ul class="list-inline textcolor">
                    <div id="phone" class="col-sm-4">
                        <a href="tel:{{$contact_us->main_phone}}"><i class="fa fa-phone phoneicon" ></i><p class="phonenumtext">@lang('main.call')՝ {{$contact_us->main_phone}}</p></a>
                    </div>
                </ul>

                <ul class="list-inline pull-right textcolor">
                    <li class="dropdown-submenu">
                        <a href="{{route('maps')}}"><i class="fa fa-map-marker icon_background iconmarker"></i><span class="mobile-maps">@lang('main.our-store')</span></a>
                        <div class="verticalLine"></div>
                    </li>
                    <li class="dropdown-submenu">
                        @if(App::getLocale() == 'hy')
                            <a href=""><i class="fa icon_background"><img src="/evrika/images/flag/flag-arm.jpg" alt="Hy" width="15" height="10"></i><span class="mobile-fonts">Հայերեն</span></a>
                        @elseif(App::getLocale() == 'ru')
                            <a href=""><i class="fa icon_background"><img src="/evrika/images/flag/flag-rus.jpg" alt="Ru" width="15" height="10"></i><span class="mobile-fonts">Русский</span></a>
                        @elseif(App::getLocale() == 'en')
                            <a href=""><i class="fa icon_background"><img src="/evrika/images/flag/flag-en.jpg" alt="En" width="15" height="10"></i><span class="mobile-fonts">English</span></a>
                        @endif

                        <ul class="dropdown-menu">
                            @foreach($languages as $language)
                                <li class="lang">
                                    <a href="/{{$language->iso}}/{{$set_lang}}" class="{{ strtoupper($language->iso) }}"  @if (app()->getLocale() == $language->iso)  @endif>
                                        @if (app()->getLocale() == $language->iso)  @endif
                                        <span class="langtext">
                                          @if(strtoupper($language->iso) == 'HY')
                                                Հայերեն
                                            @elseif(strtoupper($language->iso) == 'RU')
                                                Русский
                                            @elseif(strtoupper($language->iso) == 'EN')
                                                English
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="verticalLine"></div>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#"><i class="fa fa-chevron-down icon_background arrowdropcolor">
                                @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                    Դ
                                @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                    ₽
                                @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                    $
                                @endif</i><span class="mobile-fonts">@lang('main.currency')</span> </a>
                        <ul class="dropdown-menu">
                            @foreach(App\Services\CurrencyConversion::getCurrencies() as $currency)
                                <li>
                                    <a href="{{route('currency', $currency->code)}}">{{$currency->code}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="verticalLine"></div>
                    </li>
                    <li id="mobile-profile">
                    @guest
                        <a href="{{ route('login') }}"><i class="fa fa-user icon_background proficon"></i>@lang('main.sign-in')</a> /
                        <a href="{{ route('register') }}">@lang('main.register')</a>
                    @else

                        <a  href="/profile" style="text-transform: capitalize;"><i class="icon_profile"></i>{{ Auth::user()->name }}</a> /
                        <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> @lang('main.logout')
                            </a>
                        <form id="logout-form"  action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="forlogo">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="logo" class="col-sm-2 pt-0">
                    <a href="/{{app()->getlocale()}}">
                        <img class="img-responsive logo-wh" src="/evrika/images/header1/logo.png" alt="logo" title="logo" />
                    </a>
                </div>

                <div  id="orderings" class="col-sm-1 pull-right dropdown forcart" >
                    <a href="#" id="dropdownMenuCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart carticon"></i>
                        <span class="forcartprice">{{round($sum/$currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</span>
                        <span class="forcartindex count-product">{{$ordering_products_count ?? 0}}</span>
                    </a>
                    <div class="dropdown-menu dropdowndivforcart respcartmenu" aria-labelledby="dropdownMenuCart">
                        @foreach($product_orders as $product_order)
                        <div id="main-ordered-product-{{$product_order->id}}">
                            <button type="button" class="close delete-order-product" data-id="{{$product_order->id}}" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <img src="/storage/{{$product_order->image}}" width="120" height="120">

                                @foreach($prod_orders as $prods_order)
                                    @if($product_order->product_id == $prods_order->id)
                                        <p class="laystext">{{$prods_order->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}} x {{$product_order->quantity}}</p>
            {{--                            @if($product_order->product_price == $prods_order->price)--}}
            {{--                                <p>{{$product_order->quantity}} x {{$prods_order->price}}</p>--}}
            {{--                            @else--}}
            {{--                                <p>{{$product_order->quantity}} x {{$prods_order->action_price}}</p>--}}
            {{--                            @endif--}}
                                    @endif
                                @endforeach

                        </div>
                        @endforeach
                            <hr>
                            <div id="ordering_sum" class="forcartsum">
                                <p>@lang('main.total-amount') <span>{{round($sum/$currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</span></p>
                            </div>
                            <hr>
                            <div class="gotocart">
                                <a href="{{route('product_order')}}"><i class="fa fa-shopping-cart carticon"></i>@lang('main.see-cart')</a>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 fornav">
            <div id="navmenu" class="col-sm-2">
                <nav class="fornavbar">
                    <a href="#" id="menubutton" class="dropdown-toggle menu-header-general navbar-toggler" aria-expanded="false" data-toggle="" data-target="#fornavigationmenu" data-toggle="dropdown">@lang('main.menu')
                        <i class="fa fa-bars" aria-hidden="true"></i></a>
                </nav>
            </div>
            <div class="col-sm-6 col-xs-9" id="forsearchform">
                <form class="searchform" action="/{{app()->getlocale()}}/search" method="get">
                    <input type="hidden" {{csrf_token()}}>
                    <input type="text" name="search" value="" placeholder="&#xF002;" autocomplete="off" class="form-control searchinput" />
                    <button class="searchbtn btn btn-default pull-right" type="submit">@lang('main.search')</button>
                </form>
            </div>
            <div class="col-sm-4 col-xs-12 pull-right forpercent">
                <ul class="list-inline" id="mobile-act">
                    <li>
                        <a href="{{route('promo')}}"><i class="fa fa-percent promoicon"></i>@lang('main.promo')</a>
                    </li>
                    <li>
                        <a href="{{route('action')}}"><i class="fa fa-percent promoicon"></i>@lang('main.discounts')</a>
                    </li>
                    <li>
                        <a href="{{route('deliver')}}"><i class="fas fa-shipping-fast promoicon"></i>@lang('main.delivery-and-handling')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

        @if(Route::current()->getName() === 'home')
        <div class="row content1">
            <div id="fornavigationmenu" class="fornavigationmenu col-sm-3 ">
                <ul class="listmenu nav ">
                    @foreach($one_categories as $one_category)
                        <li class="active dropdown-submenu">
                            <a href="/{{config('app.locale')}}/{{$one_category->slug}}/" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                @if($one_category->icon != null) {!! $one_category->icon !!} @endif {{$one_category->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>
                        <div class="forbread dropdown-menu col-sm-12 col-xs-12" >
                            <div class="fortypebread col-xs-12">
                            @foreach($sub_categories as $sub_category)
                                @if($one_category->id ==  $sub_category->category_id)
                                    <div class="col-sm-4 col-xs-6">
                                        <ul class="nav">
                                            <li><a href="/{{config('app.locale')}}/{{$one_category->slug}}/{{$sub_category->slug}}" id="black0">{{$sub_category->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a></li>
                                            @foreach($groups as $group)
                                                @if($sub_category->id == $group->subcategory_id)

                                                    <li><a href="/{{config('app.locale')}}/{{$one_category->slug}}/{{$sub_category->slug}}/{{$group->slug}}">{{$group->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a></li>

                                                 @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                                </div>
{{--                                <div class="forbreadimage col-sm-12 col-xs-12">--}}
{{--                                    <img src="/evrika/images/product/bread.jpg">--}}
{{--                                </div>--}}
                            </div>
                        </li>
                        <hr>
                    @endforeach

                </ul>
            </div>
        @else
        <div class="row content2">
            <div id="fornavigationmenu" class="fornavigationmenu col-sm-3" style="display: none">
                <ul class="listmenu nav ">
                    @foreach($one_categories as $one_category)
                        <li class="active dropdown-submenu">
                            <a href="/{{config('app.locale')}}/{{$one_category->slug}}/" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                @if($one_category->icon != null) {!! $one_category->icon !!} @endif {{$one_category->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>
                            <div class="forbread dropdown-menu col-sm-12 col-xs-12" >
                                <div class="fortypebread col-xs-12">
                                    @foreach($sub_categories as $sub_category)
                                        @if($one_category->id ==  $sub_category->category_id)
                                            <div class="col-sm-4 col-xs-6">
                                                <ul class="nav">
                                                    <li><a href="/{{config('app.locale')}}/{{$one_category->slug}}/{{$sub_category->slug}}" id="black0">{{$sub_category->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a></li>
                                                    @foreach($groups as $group)
                                                        @if($sub_category->id == $group->subcategory_id)

                                                            <li><a href="/{{config('app.locale')}}/{{$one_category->slug}}/{{$sub_category->slug}}/{{$group->slug}}">{{$group->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a></li>

                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                {{--                                <div class="forbreadimage col-sm-12 col-xs-12">--}}
                                {{--                                    <img src="/evrika/images/product/bread.jpg">--}}
                                {{--                                </div>--}}
                            </div>
                        </li>
                        <hr>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Route::current()->getName() === 'home')
            <div class="forslidebar col-sm-9 pull-right pt-slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php $zero = 0; ?>
                    @foreach($home_sliders as $home_slider)
                    <?php $zero++; ?>
                        @if($zero <= 1)
                            <li data-target="#myCarousel" data-slide-to="{{$home_slider->id}}" class="active"></li>
                        @else
                            <li data-target="#myCarousel" data-slide-to="{{$home_slider->id}}"></li>
                        @endif
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $one = 0; ?>
                    @foreach($home_sliders as $home_slider)
                    <?php $one++; ?>
                        @if($one <= 1)
                            <div class="item active">
                                <img src="/storage/{{$home_slider->image}}" alt="evrika">
                            </div>
                        @else
                            <div class="item">
                                <img src="/storage/{{$home_slider->image}}" alt="evrika">
                            </div>
                        @endif
                    @endforeach
                </div>

                <a class="rigthslide right carousel-control" href="#myCarousel" data-slide="next">
                    <i class="fa fa-chevron-right icon_background righticonforslide"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

    @if (session('status'))
        <div class="alert-success info-alert">
            {{ session('status') }}
        </div>
    @endif

    @yield('content')

    <!-- =======================================================
                        FOOTER
========================================================= -->
        <div class="lastpart">
            <div class="forpage">

            </div>
            <div class="container">
                <div class="col-sm-2 logofooterdiv">
                    <img  class="img-responsive logofooter" src="/evrika/images/header1/logo.png" alt="logo" title="logo" />
                </div>
                <div class="col-sm-4 addrevrika">
                    <p>@lang('main.address') {{$contact_us->getTranslatedAttribute('address',config('app.locale'),config('voyager.multilingual.default'))}}</p>
                    <p>@lang('main.phone') - {{$contact_us->main_phone}}</p>
                    <p>@lang('main.email') - {{$contact_us->email}}</p>
                </div>
                <div class="mypage">
                    <div class="pull-right ">
                        <ul class="nav listmenu">
                            <li>@lang('main.everywhere')</li>
                            <li></li>
                            <li><a href="https://www.facebook.com/evrikasupermarkets/?ref=br_rs" target="_blank">Facebook <i class="fa fa-facebook iconfb"></i></a></li>
                            <li><a href="https://www.instagram.com/evrika_supermarkets/" target="_blank">Instagram <i class="fa fa-instagram iconinst"></i></a></li>
                        </ul>
                    </div>
                    <div class="pull-right ">
                        <ul class="nav listmenu">
                            <li>@lang('main.terms-use')</li>
                            <li></li>
                            <li><a href="{{route('deliver')}}">@lang('main.delivery-and-handling')</a></li>
                            <li><a href="{{route('return')}}">@lang('main.return')</a></li>
                            <li><a href="{{route('payment-method')}}">@lang('main.payment-method')</a></li>

                        </ul>
                    </div>

                    <div class="pull-right listmenu" >
                        <ul class="nav">
                            <li>@lang('main.pages')</li>
                            <li> <a href="{{route('action')}}">@lang('main.discount')</a></li>
                            <li><a href="{{route('about')}}">@lang('main.about-us')</a></li>
                            <li><a href="{{route('contact')}}">@lang('main.contact-us')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <footer class="forfooter">
                <div class="powered">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-xs-12">
                                <p>© Copyright 2020 @lang('main.evrika-supermarket'). @lang('main.reserved')</p>
                            </div>
                            <div class="col-md-4 col-xs-12 text-right">
                                <ul class="list-inline">
                                    <li>
                                        <img src="/evrika/images/card1.png" class="img-responsive" alt="card" title="card" />
                                    </li>
                                    <li>
                                        <img src="/evrika/images/arca_footer.png" class="img-responsive" alt="card" title="card" />
                                    </li>
                                    <li>
                                        <img src="/evrika/images/card3.png" class="img-responsive" alt="card" title="card" />
                                    </li>
                                    <li>
                                        <img src="/evrika/images/idrams.png" class="img-responsive" alt="card" title="card" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

        </footer>
<button class="scrollTop"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>

        <!-- jQuery scripts -->
        <script src="{{asset('/evrika/js/check.js')}}"></script>
        <script src="{{asset('/evrika/js/preetycheble/prettyCheckable.min.js')}}"></script>
        <script src="{{asset('/evrika/js/jquery.2.1.1.min.js')}}"></script>
        <script src="{{asset('/evrika/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/evrika/js/dist/js/bootstrap-select.js')}}"></script>
        <script src="{{asset('/evrika/js/internal.js')}}"></script>
        <script src="{{asset('/evrika/js/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('/evrika/js/custom.js')}}"></script>
        <script src="{{asset('/evrika/js/shop_cart.js')}}"></script>
        <script>
            function minusis($minus_id) {
                var count_id = "count_product_"+$minus_id;
                var val = Number( document.getElementById(count_id).value)
                if(val == 1 ) {

                } else {
                    var prod_val =  val - 1;
                    document.getElementById(count_id).value = prod_val;
                }
            }
            function plusis($plus_id) {
                var count_id = "count_product_"+$plus_id;
                var val = Number( document.getElementById(count_id).value);
                // var val = document.getElementById(count_id).value;
                var z =val+1;
                var x = 0;
                document.getElementById(count_id).value = x ;
                document.getElementById(count_id).value = z ;
            }

            function refreshPage(prod) {

                var count_id = "count_product_"+prod;
                var val = Number( document.getElementById(count_id).value);
                var id = prod;
                $('.shoping-cart').attr('data-count', val);
            }

            $('.shoping-cart').on('click', function() {
                var $this = $(this);
                $this.button('loading');
                setTimeout(function() {
                    $this.button('reset');
                }, 1000);
            });

            setTimeout(myFunction, 30000)
            function myFunction() {
                $.ajax({
                    type: 'POST',
                    url: '/currency_update',
                    data:{} ,
                    error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                    },
                    success: function(resp){

                    }
                });
            }
            $(document).ready(function(){
                $('.count').prop('disabled', true);
                $(document).on('click','.plus',function(){
                    $('.count').val(parseInt($('.count').val()) + 1 );
                });
                $(document).on('click','.minus',function(){
                    $('.count').val(parseInt($('.count').val()) - 1 );
                    if ($('.count').val() == 0) {
                        $('.count').val(1);
                    }
                });

                $("#menubutton").click(function() {
                    if($("#fornavigationmenu").is(":visible")){
                        $('#fornavigationmenu').hide();
                    } else{
                        $('#fornavigationmenu').show();
                    }
                });
            });
        </script>
        <!-- thm custom script -->
{{--        <script src="{{asset('/evrika/js/custom.js')}}"></script>--}}
</body>
</html>
