@extends('layouts.main')

@section('content')
<!-- =======================================================
                        CONTENT
========================================================= -->

    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 sub-products">
                    <div class="row">
                        @foreach($action_products as $action_product)
                        <div class="product-layout product-grid col-lg-2 col-md-2 col-sm-4 col-xs-6" id="prod-marg">
                            <div class="product-thumb">
                                <div class="image">
                                    <a class="rec-fill front front--slide-left" href="shop.html"><img src="/storage/{{$action_product->image_path}}" alt="image" title="image" class="img-responsive" /></a>
                                    <a class="rec-fill back back--slide-left" href="shop.html"><img src="/storage/{{$action_product->image_path}}" alt="image" title="image" class="img-responsive" /></a>
                                    <div class="sale">
                                        <p>@lang('main.discount')</p>
                                    </div>
                                </div>
                                <div class="caption">
                                    <h4><a href="/{{config('app.locale', app()->getLocale())}}/product/{{ $action_product->id}}">{{ $action_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></h4>
                                    <p class="price">
                                        @if($action_product->action_price != null)
                                            <span class="price-old">{{$action_product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</span>{{round($action_product->action_price/$currency->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</p>
                                        @else
                                            {{$action_product->price}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</p>
                                        @endif
                                    <div class="onhover">
                                        <ul class="list-inline">
                                            <li>
                                                <a class="thm-btn shoping-cart" data-id="{{$action_product->id}}" data-name="{{$action_product->name}}" data-price="{{$action_product->action_price/$currency->rate}}" data-image="{{$action_product->image_path}}"><i class="fa fa-shopping-cart"></i>@lang('main.add-to-card')</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <ul class="list-inline pagination">
                        {{$action_products->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
