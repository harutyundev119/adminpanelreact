@extends('layouts.main')

@section('content')
    <div class="shopdetail">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">
                            <a class="thumbnail" href="#"><img src="/storage/{{$product->image_path}}" title="img" alt="img" /></a>
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                            <h5>{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</h5>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="shortdes">
                                {{$product->getTranslatedAttribute('description',config('app.locale'),config('voyager.multilingual.default'))}}
                            </p>
                            <hr>
                            <h5>@lang('main.o-product')</h5>
                            <ul class="list-unstyled featured">
                                @if($product->country != null)
                                <li><i class="icon_box-checked"></i><span class="boldo">@lang('main.manuf-country'):</span> {{$product->getTranslatedAttribute('country',config('app.locale'),config('voyager.multilingual.default'))}}</li>
                                @endif
                                @if($product->manufacturer != null)
                                    <li><i class="icon_box-checked"></i><span class="boldo">@lang('main.manufac'):</span> {{$product->getTranslatedAttribute('manufacturer',config('app.locale'),config('voyager.multilingual.default'))}}</li>
                                @endif
                                @if($product->serial_number != null)
                                    <li><i class="icon_box-checked"></i><span class="boldo">@lang('main.spec-number'):</span> {{$product->serial_number}}</li>
                                @endif
                            </ul>
                            <hr>
                            <div class="price">
                                @if($product->action_price != null)
                                    <span class="price-old">{{$product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</span> <span>{{round($product->action_price / $currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</span>
                                @else
                                    <span>{{$product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</span>
                                @endif
                                @if($product->hatavachar != null)
                                    (@lang('main.packetov'))
                                @elseif($product->litr != null)
                                    (@lang('main.litr'))
                                @elseif($product->gram != null)
                                    (@lang('main.kg'))
                                @endif
                            </div>
                            <hr>
                            @if($product->count != null)
                                <div class="common">
                                    <p class="qtypara pull-left">
                                        <h3><strong>@lang('main.count')։ </strong>{{$product->count}}</h3>
                                    </p>
                                </div>
                            @endif
                            <div class="buttons">
                                @if($product->hatavachar != null)
                                    <div class="radio">
                                        @if($product->action_price != null)
                                            <input id="main-piece-packet" name="sort" type="radio" class="ml-40" checked data-singlprice="1">
                                            <label for="packet" class="radio-label pl-70">@lang('main.packetov') - {{round($product->action_price / $currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                        @else
                                            <input id="main-piece-packet" name="sort" type="radio" class="ml-40" checked data-singlprice="1">
                                            <label for="packet" class="radio-label pl-70">@lang('main.packetov') - {{$product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}.</label>
                                        @endif
                                    </div>
                                    <div class="radio">
                                        <input id="piece" name="sort" type="radio" class="ml-40" data-singlprice="11">
                                        <label  for="piece" class="radio-label pl-70">@lang('main.pieceov') - {{round($product->hatavachar/$currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                    </div>
                                    <br>
                                    <div class="buttons">
                                        <button type="button addtocart-single" class="btn-default addtocart singl-shoping-cart" id="addtocart-single" data-type="{{$product->product_type}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="1" data-image="{{$product->image_path}}"><i id="{{$product->id}}" class="icon_cart"></i> @lang('main.add-to-card')</button>
                                    </div>
                                @endif
                                @if($product->gram != null)
                                    <hr>
                                    <div class="radio">
                                        @if($product->action_price != null)
                                            <input id="main-piece-packet" name="sort" type="radio" class="ml-40" checked data-singlprice="2">
                                            <label for="packet" class="radio-label pl-70">@lang('main.kg') - {{round($product->action_price / $currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                        @else
                                            <input id="main-piece-packet"  name="sort" type="radio" class="ml-40" checked  data-singlprice="2">
                                            <label for="packet" class="radio-label pl-70">@lang('main.kg') - {{$product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                        @endif
                                    </div>
                                    <div class="radio">
                                        <input id="piece" name="sort" type="radio"  class="ml-40"  data-singlprice="22">
                                        <label  for="piece" class="radio-label pl-70">@lang('main.gram') - {{round($product->gram/$currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                    </div>
                                    <hr>
                                        <div class="buttons">
                                            <button  type="button addtocart-single" class="btn-default addtocart singl-shoping-cart" id="addtocart-single" data-type="{{$product->product_type}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="2" data-image="{{$product->image_path}}"><i id="{{$product->id}}" class="icon_cart"></i> @lang('main.add-to-card')</button>
                                        </div>
                                @endif
                                @if($product->litr != null)
                                    <div class="radio">
                                        @if($product->action_price != null)
                                            <input id="main-piece-packet" name="sort" type="radio" class="ml-40" checked data-singlprice="3">
                                            <label for="packet" class="radio-label pl-70">@lang('main.litr') - {{round($product->action_price / $currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                        @else
                                            <input id="main-piece-packet" name="sort" type="radio" class="ml-40" checked data-singlprice="3">
                                            <label for="packet" class="radio-label pl-70">@lang('main.litr') - {{$product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                        @endif
                                    </div>
                                    <div class="radio">
                                        <input id="piece" name="sort" type="radio" class="ml-40" data-singlprice="33">
                                        <label  for="piece" class="radio-label pl-70">@lang('main.mlitr') - {{round($product->litr/$currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</label>
                                    </div>
                                <br>
                                <div class="buttons">
                                    <button type="button addtocart-single" class="btn-default addtocart singl-shoping-cart" id="addtocart-single" data-type="{{$product->product_type}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="3" data-image="{{$product->image_path}}"><i id="{{$product->id}}" class="icon_cart"></i> @lang('main.add-to-card')</button>
                                </div>
                                @endif
                                @if($product->hatavachar == null &&  $product->litr == null && $product->gram == null)
                                        <div class="buttons">
                                            <button type="button addtocart-single" class="btn-default addtocart singl-shoping-cart" id="addtocart-single" data-type="{{$product->product_type}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="3" data-image="{{$product->image_path}}"><i id="{{$product->id}}" class="icon_cart"></i> @lang('main.add-to-card')</button>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($product->active_substance != '')
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-description" data-toggle="tab">@lang('main.usefulness')</a>
                            </li>
    {{--                        <li>--}}
    {{--                            <a href="#tab-review" data-toggle="tab">Կարծիքներ</a>--}}
    {{--                        </li>--}}
    {{--                        <li>--}}
    {{--                            <a href="#tab-add" data-toggle="tab">Ավելացնել կարծիք</a>--}}
    {{--                        </li>--}}
                        </ul>
                        <div class="row">
                            <div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-description">
                                        <p>{{$product->getTranslatedAttribute('active_substance',config('app.locale'),config('voyager.multilingual.default'))}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                <img src="/evrika/images/banner-1.png" alt="img" title="img" class="img-responsive shopbanner" />
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 commontop text-center">
                            <h4>
                                <i class="icon_star_alt"></i>
                                <i class="icon_star_alt"></i>
                                <i class="icon_star_alt"></i>
                                @lang('main.live-porducts')
                                <i class="icon_star_alt"></i>
                                <i class="icon_star_alt"></i>
                                <i class="icon_star_alt"></i>
                            </h4>
                            <hr>
                        </div>

                        @foreach($all_prod_cats as $similar_product)
                            <div class="product-layout product-grid col-lg-2 col-md-4 col-xs-6" id="prod-marg-singl">

                                <img src="/storage/{{$similar_product->image_path}}" width="115" height="115">
                                <p  class="laystext" style="height: 80px;"><a href="/{{config('app.locale')}}/product/{{ $similar_product->id}}" class="laystext">{{ $similar_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                <hr class="prodhr">

                                @if($similar_product->action_price != null)
                                    <p class="oldprice">@lang('main.old-price') <strike>{{$similar_product->price}}</strike> </p>
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
                                        <sup style="top:-4px">{{round($similar_product->action_price / $currencys->rate,2)}}</sup>
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
                                        <sup style="top:-4px">{{$similar_product->price}}</sup>
                                    </p>
                                @endif
                                <hr class="prodhr">
                                <div class="foraddcart">
                                    @if($similar_product->action_price != null)
                                        <a onclick="refreshPage({{$similar_product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$similar_product->id}}" data-name="{{$similar_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$similar_product->action_price/$currencys->rate}}" data-image="{{$similar_product->image_path}}" style="font-size: 12px;"><i id="{{$similar_product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                    @else
                                        <a onclick="refreshPage({{$similar_product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$similar_product->id}}" data-name="{{$similar_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$similar_product->price}}" data-image="{{$similar_product->image_path}}" style="font-size: 12px;"><i id="{{$similar_product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                    @endif
                                    <div class="number col-sm-5 pull-right classforcounter">
                                        <span id="minusis_{{$similar_product->id}}" onclick="minusis({{$similar_product->id}})" class="minusis minus forcount">-</span>
                                        <input class="order-plus forcountinput" id="count_product_{{$similar_product->id}}" type="text" value="1"/>
                                        <span id="plusis_{{$similar_product->id}}" onclick="plusis({{$similar_product->id}})" class="plusis plus forcount">+</span>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="">
@endsection
