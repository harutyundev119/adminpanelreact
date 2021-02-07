
@extends('layouts.main')

@section('content')

            <div class="container bestofferdaydiv mt-20">

                <div id="caruselforbestofferday" class="carousel slide col-lg-2 col-md-2" data-ride="carousel">

                    <div class="carousel-inner">
                        <div class="item active">
                            @if(!$action_product1s->isEmpty())
                                @foreach($action_product1s as $action_product1)
                                    <div class="col-sm-12 bestofferday">
                                <p class="textfordayoffer" >@lang('main.best-offer-day')</p>
                                <img src="/storage/{{$action_product1->image_path}}" width="130" height="130">
                                <p class="laystext ph60"><a href="/{{config('app.locale')}}/product/{{ $action_product1->id}}" class="laystext">{{ $action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                <hr>
                                    @if($action_product1->action_price != null)
                                        <p class="oldprice">@lang('main.old-price') <strike>{{$action_product1->price}}</strike> </p>
                                        <p class="priceofoffer">
                                            <sup>
                                                @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                    Դ
                                                @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                    ₽
                                                @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                    $
                                                @endif
                                            </sup>
                                            <sup classs="tp4">{{round($action_product1->action_price / $currencys->rate,2)}}</sup>
                                        </p>
                                    @else
                                        <p class="priceofoffer">
                                            <sup>
                                                @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                    Դ
                                                @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                    ₽
                                                @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                    $
                                                @endif
                                            </sup>
                                            <sup classs="tp4">{{$action_product1->price}}</sup>
                                        </p>
                                    @endif
                                <hr>
                                <div class="foraddcart">
                                    @if($action_product1->action_price != null)
                                        <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->action_price/$currencys->rate}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                    @else
                                        <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->price}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                    @endif
                                    <div class="number col-sm-5 pull-right classforcounter">
                                        <span id="minusis_{{$action_product1->id}}" onclick="minusis({{$action_product1->id}})" class="minusis minus forcount">-</span>
                                        <input class="order-plus forcountinput" id="count_product_{{$action_product1->id}}" type="text" value="1"/>
                                        <span id="plusis_{{$action_product1->id}}" onclick="plusis({{$action_product1->id}})" class="plusis plus forcount">+</span>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="item">
                            @if(!$action_product2s->isEmpty())
                                @foreach($action_product2s as $action_product1)
                                    <div class="col-sm-12 bestofferday">
                                        <p class="textfordayoffer" >@lang('main.best-offer-day')</p>
                                        <img src="/storage/{{$action_product1->image_path}}" width="130" height="130">
                                        <p class="laystext h60"><a href="/{{config('app.locale')}}/product/{{ $action_product1->id}}" class="laystext">{{ $action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                        <hr>
                                        @if($action_product1->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$action_product1->price}}</strike> </p>
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{round($action_product1->action_price / $currencys->rate,2)}}</sup>
                                            </p>
                                        @else
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{$action_product1->price}}</sup>
                                            </p>
                                        @endif
                                        <hr>
                                        <div class="foraddcart">
                                            @if($action_product1->action_price != null)
                                                <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->action_price/$currencys->rate}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @else
                                                <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->price}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @endif
                                            <div class="number col-sm-5 pull-right classforcounter">
                                                <span id="minusis_{{$action_product1->id}}" onclick="minusis({{$action_product1->id}})" class="minusis minus forcount">-</span>
                                                <input class="order-plus forcountinput" id="count_product_{{$action_product1->id}}" type="text" value="1"/>
                                                <span id="plusis_{{$action_product1->id}}" onclick="plusis({{$action_product1->id}})" class="plusis plus forcount">+</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="item">
                            @if(!$action_product3s->isEmpty())
                                @foreach($action_product3s as $action_product1)
                                    <div class="col-sm-12 bestofferday">
                                        <p class="textfordayoffer" >@lang('main.best-offer-day')</p>
                                        <img src="/storage/{{$action_product1->image_path}}" width="130" height="130">
                                        <p class="laystext h60"><a href="/{{config('app.locale')}}/product/{{ $action_product1->id}}" class="laystext">{{ $action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                        <hr>
                                        @if($action_product1->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$action_product1->price}}</strike> </p>
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{round($action_product1->action_price / $currencys->rate,2)}}</sup>
                                            </p>
                                        @else
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{$action_product1->price}}</sup>
                                            </p>
                                        @endif
                                        <hr>
                                        <div class="foraddcart">
                                            @if($action_product1->action_price != null)
                                                <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->action_price/$currencys->rate}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @else
                                                <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->price}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @endif
                                            <div class="number col-sm-5 pull-right classforcounter">
                                                <span id="minusis_{{$action_product1->id}}" onclick="minusis({{$action_product1->id}})" class="minusis minus forcount">-</span>
                                                <input class="order-plus forcountinput" id="count_product_{{$action_product1->id}}" type="text" value="1"/>
                                                <span id="plusis_{{$action_product1->id}}" onclick="plusis({{$action_product1->id}})" class="plusis plus forcount">+</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="item">
                            @if(!$action_product4s->isEmpty())
                                @foreach($action_product4s as $action_product1)
                                    <div class="col-sm-12 bestofferday">
                                        <p class="textfordayoffer" >@lang('main.best-offer-day')</p>
                                        <img src="/storage/{{$action_product1->image_path}}" width="130" height="130">
                                        <p class="laystext h60" ><a href="/{{config('app.locale')}}/product/{{ $action_product1->id}}" class="laystext">{{ $action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                        <hr>
                                        @if($action_product1->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$action_product1->price}}</strike> </p>
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{round($action_product1->action_price / $currencys->rate,2)}}</sup>
                                            </p>
                                        @else
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{$action_product1->price}}</sup>
                                            </p>
                                        @endif
                                        <hr>
                                        <div class="foraddcart">
                                            @if($action_product1->action_price != null)
                                                <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->action_price/$currencys->rate}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @else
                                                <a onclick="refreshPage({{$action_product1->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$action_product1->id}}" data-name="{{$action_product1->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$action_product1->price}}" data-image="{{$action_product1->image_path}}" ><i id="{{$action_product1->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @endif
                                            <div class="number col-sm-5 pull-right classforcounter">
                                                <span id="minusis_{{$action_product1->id}}" onclick="minusis({{$action_product1->id}})" class="minusis minus forcount">-</span>
                                                <input class="order-plus forcountinput" id="count_product_{{$action_product1->id}}" type="text" value="1"/>
                                                <span id="plusis_{{$action_product1->id}}" onclick="plusis({{$action_product1->id}})" class="plusis plus forcount">+</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <a class="left carousel-control rigthslide" href="#caruselforbestofferday" data-slide="prev">
                        <i class="fa fa-chevron-left iconfornextproduct"></i>
                    </a>
                    <a class="right carousel-control rigthslide" href="#caruselforbestofferday" data-slide="next">
                        <i class="fa fa-chevron-right iconfornextproduct"></i>
                    </a>
                </div>

                <div class="col-lg-10 col-md-10 pull-right formostsoldpr" id="pad0">
                    <div class="col-sm-12">
                        <div class="col-sm-3 forhorline"></div>
                        <div class="mostsoldtext col-sm-6">@lang('main.todays-sellers')</div>
                        <div class="col-sm-3 forhorline"></div>
                    </div>

                    <div id="caruselforproduct" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">

                            <div class="item active">
                                @foreach($mix_products as $mix_product)
                                    <div class="col-sm-2 bestofferday">
                                    @if($mix_product->action_price != null)
                                        <div class="fordiscount">ԽՆԱՅԻՐ {{$mix_product->price-$mix_product->action_price}}</div>
                                    @endif
                                    <img src="/storage/{{$mix_product->image_path}}" width="115" height="115">
                                    <p  class="laystext h80"><a href="/{{config('app.locale')}}/product/{{ $mix_product->id}}" class="laystext">{{ $mix_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                    <hr>
                                        @if($mix_product->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$mix_product->price}}</strike> </p>
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{round($mix_product->action_price / $currencys->rate,2)}}</sup>
                                            </p>
                                        @else
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{$mix_product->price}}</sup>
                                            </p>
                                        @endif
                                    <hr>
                                    <div class="foraddcart">
                                        @if($mix_product->action_price != null)
                                            <a onclick="refreshPage({{$mix_product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_product->id}}" data-name="{{$mix_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_product->action_price/$currencys->rate}}" data-image="{{$mix_product->image_path}}" ><i id="{{$mix_product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                        @else
                                            <a onclick="refreshPage({{$mix_product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_product->id}}" data-name="{{$mix_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_product->price}}" data-image="{{$mix_product->image_path}}" ><i id="{{$mix_product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                        @endif
                                        <div class="number col-sm-5 pull-right classforcounter">
                                            <span id="minusis_{{$mix_product->id}}" onclick="minusis({{$mix_product->id}})" class="minusis minus forcount">-</span>
                                            <input class="order-plus forcountinput" id="count_product_{{$mix_product->id}}" type="text" value="1"/>
                                            <span id="plusis_{{$mix_product->id}}" onclick="plusis({{$mix_product->id}})" class="plusis plus forcount">+</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="item">
                                @foreach($mix_products2 as $mix_productt)
                                    <div class="col-sm-2 bestofferday">
                                        @if($mix_product->action_price != null)
                                            <div class="fordiscount">ԽՆԱՅԻՐ {{$mix_product->price-$mix_product->action_price}}</div>
                                        @endif
                                        <img src="/storage/{{$mix_productt->image_path}}" width="115" height="115">
                                        <p  class="laystext h80"><a href="/{{config('app.locale')}}/product/{{ $mix_productt->id}}" class="laystext">{{ $mix_productt->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                        <hr>

                                        @if($mix_productt->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$mix_productt->price}}</strike> </p>
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{round($mix_productt->action_price / $currencys->rate,2)}}</sup>
                                            </p>
                                        @else
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{$mix_productt->price}}</sup>
                                            </p>
                                        @endif
                                        <hr>
                                        <div class="foraddcart">
                                            @if($mix_productt->action_price != null)
                                                <a onclick="refreshPage({{$mix_productt->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_productt->id}}" data-name="{{$mix_productt->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_productt->action_price/$currencys->rate}}" data-image="{{$mix_productt->image_path}}"><i id="{{$mix_productt->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @else
                                                <a onclick="refreshPage({{$mix_productt->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_productt->id}}" data-name="{{$mix_productt->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_productt->price}}" data-image="{{$mix_productt->image_path}}"><i id="{{$mix_productt->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @endif
                                            <div class="number col-sm-5 pull-right classforcounter">
                                                <span id="minusis_{{$mix_productt->id}}" onclick="minusis({{$mix_productt->id}})" class="minusis minus forcount">-</span>
                                                <input class="order-plus forcountinput" id="count_product_{{$mix_productt->id}}" type="text" value="1"/>
                                                <span id="plusis_{{$mix_productt->id}}" onclick="plusis({{$mix_productt->id}})" class="plusis plus forcount">+</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a class="left carousel-control rigthslide" href="#caruselforproduct" data-slide="prev">
                            <i class="fa fa-chevron-left iconfornextproduct"></i>
                        </a>
                        <a class="right carousel-control rigthslide" href="#caruselforproduct" data-slide="next">
                            <i class="fa fa-chevron-right iconfornextproduct"></i>
                        </a>
                    </div>

                    <!-- slide for phone -->
                    <div id="caruselforproductphone" style="display: none" >
                        <div class="container">
                            <div class="row">
                                @foreach($mix_products as $mix_product)
                                <div class="col-xs-6  col-sm-3 bestmobile">
                                    @if($mix_product->action_price != null)
                                        <div class="fordiscount">ԽՆԱՅԻՐ {{$mix_product->price-$mix_product->action_price}}</div>
                                    @endif
                                        <img src="/storage/{{$mix_product->image_path}}" width="115" height="115">
                                        <p  class="laystext h80"><a href="/{{config('app.locale')}}/product/{{ $mix_product->id}}" class="laystext">{{ $mix_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                        <hr>
                                        @if($mix_product->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$mix_product->price}}</strike> </p>
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{round($mix_product->action_price / $currencys->rate,2)}}</sup>
                                            </p>
                                        @else
                                            <p class="priceofoffer">
                                                <sup>
                                                    @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                        Դ
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                        ₽
                                                    @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                        $
                                                    @endif
                                                </sup>
                                                <sup classs="tp4">{{$mix_product->price}}</sup>
                                            </p>
                                        @endif
                                    <hr>
                                    <div class="foraddcart">
                                        @if($mix_product->action_price != null)
                                            <a onclick="refreshPage({{$mix_product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_product->id}}" data-name="{{$mix_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_product->action_price/$currencys->rate}}" data-image="{{$mix_product->image_path}}"><i id="{{$mix_product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                        @else
                                            <a onclick="refreshPage({{$mix_product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_product->id}}" data-name="{{$mix_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_product->price}}" data-image="{{$mix_product->image_path}}"><i id="{{$mix_product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                        @endif
                                        <div class="number col-sm-5 pull-right classforcounter">
                                            <span id="minusis_{{$mix_product->id}}" onclick="minusis({{$mix_product->id}})" class="minusis minus forcount">-</span>
                                            <input class="order-plus forcountinput" id="count_product_{{$mix_product->id}}" type="text" value="1"/>
                                            <span id="plusis_{{$mix_product->id}}" onclick="plusis({{$mix_product->id}})" class="plusis plus forcount">+</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @foreach($mix_products2 as $mix_productt)
                                        <div class="col-xs-6  col-sm-3 bestmobile">
                                            @if($mix_productt->action_price != null)
                                                <div class="fordiscount">ԽՆԱՅԻՐ {{$mix_productt->price-$mix_product->action_price}}</div>
                                            @endif
                                            <img src="/storage/{{$mix_productt->image_path}}" width="115" height="115">
                                            <p  class="laystext h80"><a href="/{{config('app.locale')}}/product/{{ $mix_productt->id}}" class="laystext">{{ $mix_productt->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                            <hr>
                                            @if($mix_productt->action_price != null)
                                                <p class="oldprice">@lang('main.old-price') <strike>{{$mix_productt->price}}</strike> </p>
                                                <p class="priceofoffer">
                                                    <sup>
                                                        @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                            Դ
                                                        @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                            ₽
                                                        @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                            $
                                                        @endif
                                                    </sup>
                                                    <sup classs="tp4">{{round($mix_productt->action_price / $currencys->rate,2)}}</sup>
                                                </p>
                                            @else
                                                <p class="priceofoffer">
                                                    <sup>
                                                        @if(App\Services\CurrencyConversion::getCurrencySymbol() == 'AMD')
                                                            Դ
                                                        @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'RUB')
                                                            ₽
                                                        @elseif(App\Services\CurrencyConversion::getCurrencySymbol() == 'USD')
                                                            $
                                                        @endif
                                                    </sup>
                                                    <sup classs="tp4">{{$mix_productt->price}}</sup>
                                                </p>
                                            @endif
                                            <hr>
                                            <div class="foraddcart">
                                                @if($mix_productt->action_price != null)
                                                    <a onclick="refreshPage({{$mix_productt->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_productt->id}}" data-name="{{$mix_productt->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_productt->action_price/$currencys->rate}}" data-image="{{$mix_productt->image_path}}"><i id="{{$mix_productt->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                                @else
                                                    <a onclick="refreshPage({{$mix_productt->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$mix_productt->id}}" data-name="{{$mix_productt->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$mix_productt->price}}" data-image="{{$mix_productt->image_path}}"><i id="{{$mix_productt->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                                @endif
                                                <div class="number col-sm-5 pull-right classforcounter">
                                                    <span id="minusis_{{$mix_productt->id}}" onclick="minusis({{$mix_productt->id}})" class="minusis minus forcount">-</span>
                                                    <input class="order-plus forcountinput" id="count_product_{{$mix_productt->id}}" type="text" value="1"/>
                                                    <span id="plusis_{{$mix_productt->id}}" onclick="plusis({{$mix_productt->id}})" class="plusis plus forcount">+</span>
                                                </div>
                                            </div>
                                        </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection
