@extends('layouts.main')

@section('content')
    <section class="shop-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-7 col-sm-7 col-xs-12 pull-left">
                    <div class="sidebar-wrapper">
                        <div class="single-sidebar">
                            <form class="search-form" action="/search" method="get">
                                @csrf
                                <input placeholder="@lang('main.search')" name="search" type="text">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <div class="single-sidebar">
                            <div class="sec-title">
                                <h3>@lang('main.category')</h3>
                            </div>
                            <ul class="menu">
                                <li class="item1">
                                    @foreach($categories  as $item)
                                        @if($item->children->count() > 0)
                                            <a href="#"><span class="ttl">{{ $item->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span><span class="ttl_arrow"><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>
                                            <ul>
                                                @foreach($item->children as $submenu)
                                                    <li class="subitem1">
                                                        <a href="/{{config('app.locale')}}/products/{{$submenu->id}}">{{ $submenu->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <a href="#"><span class="ttl">{{ $item->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span><span class="ttl_arrow"><</span></a>
                                            <ul>
                                                <li class="subitem1">
                                                    <a href="/{{config('app.locale')}}/products/{{$item->id}}">{{ $submenu->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="single-sidebar">
                            <div class="sec-title">
                                <h3>@lang('main.popular-item')</h3>
                            </div>
                            <ul class="popular-product">
                                @foreach($popular_products as $popular_product)
                                    <li>
                                        <div class="img-holder">
                                            <img src="/storage/{{$popular_product->image_path}}" alt="Awesome Image">
                                            <div class="overlay-style-one">
                                                <div class="box">
                                                    <div class="content">
                                                        <a href="/{{config('app.locale')}}/product/{{$popular_product->id}}"><i class="fa fa-link" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="title-holder">
                                            <a href="/{{config('app.locale')}}/product/{{$popular_product->id}}">
                                                <h4>{{$popular_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</h4>
                                            </a>
                                            <h5 class="single-price">{{$popular_product->price}}</h5><span class="single-currency"> AMD</span>
                                            <div class="review-box">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 pull-right">
                    <div class="shop-content">
                        <div class="row showing-result-shorting">
                            <div class="col-md-12"></div>
                        </div>

                        <?php $count = 1; $products_count = count($products); ?>

                        @foreach($products as $product)

                            @if(($count-1)%3 === 0)
                                <div class="row product-row">
                                    @endif
                                    <div class="col-md-4 col-sm-12 col-xs-12">

                                        <div class="single-product-item">
                                            <div class="img-holder">
                                                <img src="/storage/{{$product->image_path}}" alt="">
                                                <div class="overlay-style-one">
                                                    <div class="box">
                                                        <div class="content">
                                                            <a class="thm-btn bgclr-1 shoping-cart" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-image="{{$product->image_path}}" href="#">@lang('main.add-to-card')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="title-holder">
                                                <div class="top clearfix">
                                                    <div class="product-title pull-left">
                                                        <a href="/{{config('app.locale')}}/product/{{$product->id}}">
                                                            <h5>{{$product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}</h5>
                                                        </a>
                                                    </div>
                                                    <div class="review-box pull-right">
                                                        <ul>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-value">
                                                    <h4 class="single-price">{{$product->price}}</h4><span class="single-currency"> AMD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if( ($count%3 === 0 || $count==$products_count))
                                </div>
                            @endif
                            <?php $count++; ?>
                        @endforeach

                        <div class="row">
                            <div class="col-md-12">
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
