@extends('layouts.main')

@section('content')
    <div class="blog-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                    <div class="image">
                        <img class="img-responsive" src="/storage/{{$post->image}}" alt="image" title="image">
                        <div class="onhover">
                            <p>{{$post->getDayNews($post->created_at)}}<br>{{$post->getMonthNews($post->created_at)}}</p>
                        </div>
                    </div>
                    <div class="matter">
                        <h4>{{$post->getTranslatedAttribute('title',config('app.locale'),config('voyager.multilingual.default'))}}</h4>
                        <h6>@lang('main.news')<span class="pull-right"></span></h6>
                        <ul class="list-inline link">
                            <li>
                                <i class="icon_heart"></i> 123
                            </li>
                        </ul>
                        <p class="des">{{strip_tags($post->getTranslatedAttribute('body',config('app.locale'),config('voyager.multilingual.default')))}}</p>
                        <p class="des1">{{strip_tags($post->getTranslatedAttribute('excerpt',config('app.locale'),config('voyager.multilingual.default')))}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
