@extends('layouts.main')

@section('content')

<div class="demo">
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-tabs-dropdown" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('main.my-profile')</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">@lang('main.orders-history')</a></li>
{{--            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">@lang('main.settings')</a></li>--}}
        </ul>

        <!-- Tab panes -->
        <div class="tab-content m-10">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="profile-page">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <form class="form-horizontal" method="post" action="/profile" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>
                                                        <h4>@lang('main.name') @lang('main.surname')</h4>
                                                    </label>
                                                    <input name="name" placeholder="{{ Auth::user()->name }}" value="{{ Auth::user()->name}}" id="name" class="form-control" type="text">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>
                                                        <h4>@lang('main.email')</h4>
                                                    </label>
                                                    <input name="email" placeholder="{{ Auth::user()->email }}" value="{{ Auth::user()->email }}" id="email" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>
                                                        <h4>@lang('main.your-phone')</h4>
                                                    </label>
                                                    <input name="phone" placeholder="{{ Auth::user()->phone }}" value="{{ Auth::user()->phone }}" id="phone" class="form-control" type="text">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>
                                                        <h4>@lang('main.your-address')</h4>
                                                    </label>
                                                    <input  name="address" placeholder="{{ Auth::user()->address }}" value="{{ Auth::user()->address }}" id="country" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>
                                                        <h4>@lang('main.index')</h4>
                                                    </label>
                                                    <input  name="post_index" placeholder="{{ Auth::user()->post_index }}" value="{{ Auth::user()->post_index }}"  id="index" class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="clearfix"></div>
                                    <div class="buttons text-center col-sm-12">
                                        <button type="submit" class="btn-primary">@lang('main.save')</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <section id="orders_prof">
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <th>@lang('main.product-name')</th>
                                <th>@lang('main.price')</th>
                                <th>@lang('main.quantity')</th>
                                <th><i class="fa fa-clock-o" aria-hidden="true"></i></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                            @foreach($user_order_products as $product)
                                <tr>
                                    <td>{{$product->getTranslatedAttribute('product_name',config('app.locale'),config('voyager.multilingual.default'))}}</td>
                                    <td>{{round($product->product_price * $product->quantity / $currencys->rate,2)}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
{{--            <div role="tabpanel" class="tab-pane" id="settings">Settings...</div>--}}
        </div>
    </div>
</div>
@endsection
