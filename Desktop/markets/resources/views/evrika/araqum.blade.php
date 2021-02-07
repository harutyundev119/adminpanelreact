@extends('layouts.main')

@section('content')
    <!-- faq start here -->
    <div class="faq">
        <div class="container">
            <div class="row">
                <hr>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 text-left" style="margin-bottom: -30px;">
                    <h2>{{$deliver->getTranslatedAttribute('title',config('app.locale'),config('voyager.multilingual.default')) }}</h2>
                    <hr>
                </div>
                <div class="col-md-12">
                    <p>{!! $deliver->getTranslatedAttribute('text',config('app.locale'),config('voyager.multilingual.default')) !!}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- faq end here -->
@endsection