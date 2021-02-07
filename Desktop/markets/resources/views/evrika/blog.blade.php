@extends('layouts.main')

@section('content')
    <!-- mainblog start here -->
    <div class="mainblog">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12 hidden-xs">
                    <div class="slide">
                        <div class="slideshow1 owl-carousel reclam">
                            @foreach($reclames as $reclam)
                                <div class="item">
                                    <img src="/storage/{{$reclam->image}}"  class="img-responsive"  style="height: 360px"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="leftside">
                        <div class="bestseller">
                            <h3>@lang('main.popular-item')</h3>
                            <?php use App\Category; ?>
                            @foreach($popular_products as $popular_product)
                            <div class="box">
                                <div class="image">
                                    <img src="/storage/{{$popular_product->image_path}}" style="width: 120px;" alt="image" title="image" class="img-responsive">
                                </div>
                                <div class="caption">
                                    <h4>{{$popular_product->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default'))}}hr</h4>
                                    <p hidden>{{$prod_cat = Category::where('id', $popular_product->category)->first()}}</p>

                                    <div class="button-group">
                                        <button type="button" class=" shoping-cart" data-id="{{$popular_product->id}}" data-name="{{$popular_product->name}}" data-price="{{$popular_product->price}}" data-image="{{$popular_product->image_path}}"> <i class="icon_cart" aria-hidden="true"></i></button>
                                        <a href="/{{config('app.locale')}}/product/{{$popular_product->id}}" type="button"><i class="fa fa-expand"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-lg-9 col-xs-12 blog">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="box">
                                    <div class="image">
                                        <img class="img-responsive" src="/storage/{{$post->image}} " style="height: 360px" alt="image" title="image">
                                        <div class="onhover">
                                            <p>{{$post->getDayNews($post->created_at)}}<br>{{$post->getMonthNews($post->created_at)}}</p>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h4>{{$post->getTranslatedAttribute('title',config('app.locale'),config('voyager.multilingual.default'))}}</h4>
                                        <h6>@lang('main.news')<span class="pull-right"></span></h6>
                                        <p>{{mb_substr(strip_tags($post->getTranslatedAttribute('body',config('app.locale'),config('voyager.multilingual.default'))),0,250)}}</p>
                                        <div class="button-group">
                                            <button type="button"><i class="icon_heart"></i></button>
                                        <hr>
                                        <a class="pull-right" href="{{route('blog.show', $post->slug)}}">@lang('main.read-more') <i class="arrow_carrot-2right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <ul class="list-inline pagination">
                        {{$posts->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- mainblog end here -->
@endsection
