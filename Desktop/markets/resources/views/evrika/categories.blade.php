@extends('layouts.main')

@section('content')
    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="subcats-title">{{ $category_id->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</span>
                    <div class="row">
                        <div class="product-layout product-grid col-lg-12" id="products-category">
                            @foreach($subcategories as $subcategory)
                                <div class="disp-inl-right col-md-2 col-xs-6">
                                    @if($subcategory->image != null)
                                        <img src="/storage/{{$subcategory->image}}" style="width: 120px; height: 90px; margin: 0 auto" alt="image" title="image" class="img-responsive">
                                    @else
                                        <img src="/evrika/img/no-cat-image.png" style=" height: 90px; margin: 0 auto" alt="image" title="image" class="img-responsive">
                                    @endif
                                    <a class="btn btn-sub" href="/{{config('app.locale')}}/{{$category_id->slug}}/{{$subcategory->slug}}">{{$subcategory->getTranslatedAttribute('name',config('app.locale'),config('voyager.multilingual.default')) }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
