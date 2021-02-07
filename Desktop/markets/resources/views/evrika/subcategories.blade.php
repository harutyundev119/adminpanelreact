@extends('layouts.main')

@section('content')
    @if(isset($groupies))
        <div class="shop">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <span class="subcats-title"><a href="/{{config('app.locale')}}/{{$category_id->slug}}" class="previous">{{ $category_id->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a></span>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="subcats-title">{{ $subcategory_id->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span>
                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <span class="subcats-title">{{$products_all->count()}}</span>
                        <div class="row">
                            <div class="product-layout product-grid col-lg-12" id="products-category">
                                @foreach($groupies as $group)
                                    <div class="disp-inl-right col-md-2 col-xs-6">
                                        @if($group->image != null)
                                            <img src="/storage/{{$group->image}}" style="width: 120px; height:90px; margin: 0 auto" alt="image" title="image" class="img-responsive">
                                        @else
                                            <img src="/evrika/img/no-cat-image.png" style=" height:90px; margin: 0 auto" alt="image" title="image" class="img-responsive">
                                        @endif
                                        <a class="btn btn-sub" href="/{{config('app.locale')}}/{{$category_id->slug}}/{{$subcategory_id->slug}}/{{$group->slug}}"><span>{{$group->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 sub-products">
                        <div class="row">
                            @foreach($products_all as $product)
                                <div class="product-layout product-grid col-lg-2 col-md-3 col-sm-4 col-xs-6" id="prod-marg">

                                        <img src="/storage/{{$product->image_path}}" width="115" height="115">
                                        <p  class="laystext" style="height: 80px;"><a href="/{{config('app.locale')}}/product/{{ $product->id}}" class="laystext">{{ $product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                    <hr class="prodhr">

                                        @if($product->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$product->price}}</strike> </p>
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
                                                <sup style="top:-4px">{{round($product->action_price / $currencys->rate,2)}}</sup>
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
                                                <sup style="top:-4px">{{$product->price}}</sup>
                                            </p>
                                        @endif
                                    <hr class="prodhr">
                                        <div class="foraddcart">
                                            @if($product->action_price != null)
                                                <a onclick="refreshPage({{$product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$product->id}}" data-name="{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$product->action_price/$currencys->rate}}" data-image="{{$product->image_path}}"><i id="{{$product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @else
                                                <a onclick="refreshPage({{$product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$product->id}}" data-name="{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$product->price}}" data-image="{{$product->image_path}}" ><i id="{{$product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @endif
                                            <div class="number col-sm-5 pull-right classforcounter">
                                                <span id="minusis_{{$product->id}}" onclick="minusis({{$product->id}})" class="minusis minus forcount">-</span>
                                                <input class="order-plus forcountinput" id="count_product_{{$product->id}}" type="text" value="1"/>
                                                <span id="plusis_{{$product->id}}" onclick="plusis({{$product->id}})" class="plusis plus forcount">+</span>
                                            </div>
                                        </div>

                                </div>

                            @endforeach

                        </div>
                        <ul class="list-inline pagination">
                            {{$products_all->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="shop">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 sub-products" >
                        <div class="row">
                            @foreach($products_all as $product)
                                <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-12" id="prod-marg">

                                        <img src="/storage/{{$product->image_path}}" width="115" height="115">
                                        <p  class="laystext" style="height: 80px;"><a href="/{{config('app.locale')}}/product/{{ $product->id}}" class="laystext">{{ $product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></p>
                                    <hr class="prodhr">

                                        @if($product->action_price != null)
                                            <p class="oldprice">@lang('main.old-price') <strike>{{$product->price}}</strike> </p>
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
                                                <sup style="top:-4px">{{round($product->action_price / $currencys->rate,2)}}</sup>
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
                                                <sup style="top:-4px">{{$product->price}}</sup>
                                            </p>
                                        @endif
                                    <hr class="prodhr">
                                        <div class="foraddcart">
                                            @if($product->action_price != null)
                                                <a onclick="refreshPage({{$product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$product->id}}" data-name="{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$product->action_price/$currencys->rate}}" data-image="{{$product->image_path}}" style="font-size: 12px;"><i id="{{$product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @else
                                                <a onclick="refreshPage({{$product->id}})" class="thm-btn shoping-cart" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> @lang('main.add-to-card')" data-id="{{$product->id}}" data-name="{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}" data-price="{{$product->price}}" data-image="{{$product->image_path}}" style="font-size: 12px;"><i id="{{$product->id}}" class="fa fa-shopping-cart iconforaddcart"></i> @lang('main.add-to-card')</a>
                                            @endif
                                            <div class="number col-sm-5 pull-right classforcounter">
                                                <span id="minusis_{{$product->id}}" onclick="minusis({{$product->id}})" class="minusis minus forcount">-</span>
                                                <input class="order-plus forcountinput" id="count_product_{{$product->id}}" type="text" value="1"/>
                                                <span id="plusis_{{$product->id}}" onclick="plusis({{$product->id}})" class="plusis plus forcount">+</span>
                                            </div>
                                        </div>

                                </div>
                            @endforeach
                        </div>
                        <ul class="list-inline pagination">
                            {{$products_all->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
