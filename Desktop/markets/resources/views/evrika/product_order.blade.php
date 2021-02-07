@extends('layouts.main')

@section('content')


    <div class="mycart cart-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form method="post" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table listproducts">
                                <thead>
                                <tr>
                                    <td class="text-left">@lang('main.items')</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">@lang('main.price')</td>
                                    <td class="text-center">@lang('main.total')</td>
                                    <td class="text-center">@lang('main.delete')</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product_orders as $product)
                                <tr id="ordered-product-{{$product->id}}">
                                    <td class="text-left" id="ordered-product-{{$product->id}}">
                                        <a href="#"><img src="/storage/{{$product->image}}" class="img-responsive" alt="img" title="img" /></a>
                                        <div class="name">{{$product->getTranslatedAttribute('product_name',config('app.locale'),config('voyager.multilingual.default'))}}</div>
                                    </td>

                                    <td class="qty">
                                        @if($product->isset == 1)
                                            <span>@lang('main.packetovs')</span>
                                        @elseif($product->isset == 11)
                                            <span>1 @lang('main.pieceovs')</span>
                                        @elseif($product->isset == 2)
                                            <span>@lang('main.kgs')</span>
                                        @elseif($product->isset == 22)
                                            <span>100 @lang('main.grams')</span>
                                        @elseif($product->isset == 3)
                                            <span>@lang('main.litrs')</span>
                                        @elseif($product->isset == 33)
                                            <span>100 @lang('main.mlitrs')</span>
                                        @endif
                                        <div id="input_div ">
                                            <input type="button" value="+" class="quantity-plus minu btn-number" >
                                            <input type="text" value="{{$product->quantity}}" name="quantity" disabled class="count fbord input-sm quan-basket"  data-id="{{$product->id}}">
                                            <input type="button" value="-" class="quantity-moins minu btn-number" >
                                        </div>
                                    </td>

                                    <td class="price">{{round($product->product_price/$currencys->rate,2)}} {{$currencys->symbol}}</td>
                                    <td class="sub-total">{{round($product->product_price/$currencys->rate,2) * $product->quantity}} {{$currencys->symbol}}</td>
                                    <td>
                                        <div class="remove">
                                            <div class="checkbox">
                                                <label>
                                                    <span  data-id="{{$product->id}}" class="delete-order-product">X</span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                    <div class="buttons">
                        <a  href="{{url()->previous()}}" class="btn-continue">Շարունակել գնումները</a>
                        <a  href="{{route('ordering_cart')}}" class="btn-continue pull-right checkout-btn mt-10">@lang('main.checkout')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
