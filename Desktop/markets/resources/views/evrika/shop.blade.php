@extends('layouts.main')

@section('content')
{{--    <section class="shop-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-12 pull-left">--}}
{{--                    <div class="sidebar-wrapper">--}}
{{--                        <div class="single-sidebar">--}}
{{--                            <form class="search-form" action="/search" method="get">--}}
{{--                                @csrf--}}
{{--                                <input placeholder="@lang('main.search')" name="search" type="text">--}}
{{--                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="single-sidebar">--}}
{{--                            <div class="sec-title">--}}
{{--                                <h3>@lang('main.category')</h3>--}}
{{--                            </div>--}}
{{--                            <ul class="menu">--}}
{{--                                <li class="item1">--}}
{{--                                    @foreach($categories  as $item)--}}
{{--                                        @if($item->children->count() > 0)--}}
{{--                                            <a href="#"><span class="ttl">{{ $item->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span><span class="ttl_arrow"><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>--}}
{{--                                            <ul>--}}
{{--                                                @foreach($item->children as $submenu)--}}
{{--                                                    <li class="subitem1">--}}
{{--                                                        <a href="/{{config('app.locale')}}/products/{{$submenu->id}}">{{ $submenu->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>--}}
{{--                                                    </li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        @else--}}
{{--                                            <a href="#"><span class="ttl">{{ $item->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span><span class="ttl_arrow"><</span></a>--}}
{{--                                            <ul>--}}
{{--                                                <li class="subitem1">--}}
{{--                                                    <a href="/{{config('app.locale')}}/products/{{$item->id}}">{{ $item->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="single-sidebar">--}}
{{--                            <div class="sec-title">--}}
{{--                                <h3>@lang('main.popular-item')</h3>--}}
{{--                            </div>--}}
{{--                            <ul class="popular-product">--}}
{{--                                @foreach($popular_products as $popular_product)--}}
{{--                                    <li>--}}
{{--                                        <div class="img-holder">--}}
{{--                                            <img src="/storage/{{$popular_product->image_path}}" alt="Awesome Image">--}}
{{--                                            <div class="overlay-style-one">--}}
{{--                                                <div class="box">--}}
{{--                                                    <div class="content">--}}
{{--                                                        <a href="/{{config('app.locale')}}/product/{{$popular_product->id}}"><i class="fa fa-link" aria-hidden="true"></i></a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="title-holder">--}}
{{--                                            <a href="/{{config('app.locale')}}/product/{{$popular_product->id}}">--}}
{{--                                                <h4>{{$popular_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</h4>--}}
{{--                                            </a>--}}
{{--                                            <h5 class="single-price">{{$popular_product->price}}</h5><span class="single-currency"> AMD</span>--}}
{{--                                            <div class="review-box">--}}
{{--                                                <ul>--}}
{{--                                                    <li><i class="fa fa-star"></i></li>--}}
{{--                                                    <li><i class="fa fa-star"></i></li>--}}
{{--                                                    <li><i class="fa fa-star"></i></li>--}}
{{--                                                    <li><i class="fa fa-star"></i></li>--}}
{{--                                                    <li><i class="fa fa-star"></i></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pull-right">--}}
{{--                    <div class="shop-content">--}}
{{--                        <div class="row showing-result-shorting">--}}
{{--                            <div class="col-md-12"></div>--}}
{{--                        </div>--}}

{{--                        <?php $count = 1; $products_count = count($products); ?>--}}

{{--                        @foreach($products as $product)--}}

{{--                            @if(($count-1)%3 === 0)--}}
{{--                                <div class="row product-row">--}}
{{--                                    @endif--}}
{{--                                    <div class="col-md-4 col-sm-12 col-xs-12">--}}

{{--                                        <div class="single-product-item">--}}
{{--                                            <div class="img-holder">--}}
{{--                                                <img src="/storage/{{$product->image_path}}" alt="">--}}
{{--                                                <div class="overlay-style-one">--}}
{{--                                                    <div class="box">--}}
{{--                                                        <div class="content">--}}
{{--                                                            <a class="thm-btn bgclr-1 shoping-cart" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-image="{{$product->image_path}}" href="#">@lang('main.add-to-card')</a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="title-holder">--}}
{{--                                                <div class="top clearfix">--}}
{{--                                                    <div class="product-title pull-left">--}}
{{--                                                        <a href="/{{config('app.locale')}}/product/{{$product->id}}">--}}
{{--                                                            <h5>{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</h5>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="review-box pull-right">--}}
{{--                                                        <ul>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="product-value">--}}
{{--                                                    <h4 class="single-price">{{$product->price}}</h4><span class="single-currency"> AMD</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                @if( ($count%3 === 0 || $count==$products_count))--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <?php $count++; ?>--}}
{{--                        @endforeach--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                {{$products->links()}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


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
                        <a href="{{route('shop')}}">@lang('main.store')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="sort col-sm-12 col-md-12 col-lg-12 col-xs-12">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                            <div class="form-group input-group input-group-sm">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                            <div class="form-group input-group input-group-sm">
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4 col-xs-12">
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12 list hidden-xs text-right">
                            <div class="btn-group btn-group-sm">
                                <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="icon_grid-2x2"></i></button>
                                <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-list-ul"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 hidden-xs">
                    <div class="leftside">
                        <div class="highlight">
                            <h3>Կատեգորիա</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <input type="radio" value="None" name="pool" class="checkclass checkbox-inline" />
                                    <a href="#">Բանջարեղեն</a>
                                </li>
                                <li>
                                    <input type="radio" value="None" name="pool" class="checkclass checkbox-inline" />
                                    <a href="#">Մրգեր</a>
                                </li>
                                <li>
                                    <input type="radio" value="None" name="pool" class="checkclass checkbox-inline" />
                                    <a href="#">Մսամթերք</a>
                                </li>
                                <li>
                                    <input type="radio" value="None" name="pool" class="checkclass checkbox-inline" />
                                    <a href="#">Կաթնամթերք</a>
                                </li>
                                <li>
                                    <input type="radio" value="None" name="pool" class="checkclass checkbox-inline" />
                                    <a href="#">Խառը</a>
                                </li>
                            </ul>
                        </div>
                        <div class="bestseller">
                            <h3>@lang('main.best-seller-products')</h3>
                            @foreach($popular_products as $popular_product)
                            <div class="box">
                                <div class="image">
                                    <img src="/storage/{{$popular_product->image_path}}" alt="image" title="image" class="img-responsive popular-prod">
                                </div>
                                <div class="caption">
                                    <h4>{{$popular_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</h4>
                                    <p>{{$popular_product->price}}</p>
                                    <div class="button-group">
                                        <a href="/{{config('app.locale')}}/product/{{$popular_product->id}}" type="button"><i class="fa fa-expand"></i></a>
                                        <button type="button" class=" shoping-cart" data-id="{{$popular_product->id}}" data-name="{{$popular_product->name}}" data-price="{{$popular_product->price}}" data-image="{{$popular_product->image_path}}"> <i class="icon_cart" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <?php $count = 1; $products_count = count($products); ?>

                    @foreach($products as $product)

                        @if(($count-1)%3 === 0)
                            <div class="row">
                        @endif
                        <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-6">

                            <div class="product-thumb">
                                <div class="image">
                                    <a class="rec-fill front front--slide-left" href="/{{config('app.locale')}}/product/{{$product->id}}"><img src="/storage/{{$product->image_path}}" alt="image" title="image" class="img-responsive" /></a>
                                    <a class="rec-fill back back--slide-left" href="/{{config('app.locale')}}/product/{{$product->id}}"><img src="/storage/{{$product->image_path}}" alt="image" title="image" class="img-responsive" /></a>
                                    @if($product->action_price != null)
                                        <div class="sale">
                                            <p>Ակցիա</p>
                                        </div>
                                    @endif
                                    <div class="onhover">
                                        <ul class="list-inline">
                                            <li><a  class="shoping-cart" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-image="{{$product->image_path}}" >@lang('main.add-to-card')<i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="/{{config('app.locale')}}/product/{{$product->id}}"><i class="fa fa-retweet"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="caption">
                                    <h4><a href="/{{config('app.locale')}}/product/{{$product->id}}">{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</a></h4>
                                    <p class="price">
                                        @if($product->action_price != null)
                                            <span class="price-old">{{$product->price}} դր.</span>{{$product->action_price}} դր.</p>
                                    @else
                                        {{$product->price}} դր.</p>
                                    @endif
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <p class="des">{{$product->description}}</p>
                                    <div class="button-group">
                                        <button type="button"  class="shoping-cart" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-image="{{$product->image_path}}"><i class="fa fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                                @if( ($count%3 === 0 || $count==$products_count))
                            </div>
                            @endif
                            <?php $count++; ?>
                        @endforeach
                    <ul class="list-inline pagination">
                        {{$products->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
