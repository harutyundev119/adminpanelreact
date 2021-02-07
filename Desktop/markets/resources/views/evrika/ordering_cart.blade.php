@extends('layouts.main')

@section('content')
    <section class="checkout-area">
        <div class="confirm">
        <div class="container">
            <div class="row cart-area mb-30 " id="cart-area-ordering">
                <div class="col-md-6 col-sm-6 colxs-12">
                    <div class="commontop text-left">
                        @if(Auth::user() == null)
                            <h5>@lang('main.do-you-have-an-account') <a href="{{route('login')}}">@lang('main.login-now')</a></h5>
                            <br>
                        @endif
                        <h4 >@lang('main.order-details')</h4>
                    </div>
                    <table>
                        <tr>
                            <th class="prod-column p-10" id="black0">@lang('main.product-name')</th>
                            <th></th>
                            <th class="" style="text-align: center" id="black0">@lang('main.quantity')</th>
                            <th id="black0">@lang('main.total')</th>
                        </tr>
                        <tbody>
                        @foreach($product_orders as $product)
                            <tr>
                                <td colspan="2" class="prod-column">
                                    <div class="column-box">
                                        <div class="title ">
                                            <p class="p-10" id="ord-col">{{$product->getTranslatedAttribute('product_name',config('app.locale'),config('voyager.multilingual.default'))}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="qty" style="text-align: center" ><span>{{$product->quantity}}</span></td>

                                <td class="sub-total"><span>{{round($product->product_price / $currencys->rate,2) * $product->quantity}}</span><span class="single-currency"> {{$currencys->symbol}}</span></td>
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>

                    <div class="form billing-info">
                        <div class="sec-title pdb-50">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1 id="black0">@lang('main.shipping-information')</h1>
                            <span class="border"></span>
                        </div>
                        <form action="/ordering" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <table>
                                <tr>
                                    <td style="width:13%;">@lang('main.name')</td>
                                    <td style="width:12%;">:</td>
                                    <td class="p-10" style="width:70%;"><input class="ord-area" type="text" required name="name" placeholder="@lang('main.your-name')" value=" <?= Auth::user() != null ? Auth::user()->name : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('main.phone')</td>
                                    <td>:</td>
                                    <td class="p-10" ><input class="ord-area" type="text" required name="phone" placeholder="@lang('main.your-phone')" value=" <?= Auth::user() != null ? Auth::user()->phone : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('main.email')</td>
                                    <td>:</td>
                                    <td class="p-10"><input class="ord-area" type="text" required name="email" placeholder="@lang('main.your-email')" value=" <?= Auth::user() != null ? Auth::user()->email : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('main.address')</td>
                                    <td>:</td>
                                    <td class="p-10"><input class="ord-area" type="text" required name="address" placeholder="@lang('main.your-address')" value=" <?= Auth::user() != null ? Auth::user()->address : '' ?>">
                                    </td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>@lang('main.index')</td>--}}
{{--                                    <td>:</td>--}}
{{--                                    <td class="p-10 "><input class="ord-area" type="text" required name="post_index" placeholder="@lang('main.index')" value="<?= Auth::user() != null ? Auth::user()->post_index : '' ?>">--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                            </table>

                            <h4 class="single-price " id="ordpric">@lang('main.pre-result')<span class="rightt">@if($currencys->code == 'RUB') {{Str::substr($sum / $currencys->rate,0, 5)}} @else {{Str::substr($sum / $currencys->rate,0, 4)}} @endif {{$currencys->symbol}}  </span></h4>
                           @if($araqum_sum == 0)

                            @else
                                <h4 class="single-price ">@lang('main.delivery-and-handling')<span class="rightt ">@if($currencys->code == 'RUB') {{Str::substr($araqum_sum,0, 4)}}  @else {{Str::substr($araqum_sum,0, 4)}} @endif {{$currencys->symbol}}</span></h4>
                            @endif

                            <h4 class="single-price " id="ordpric">@lang('main.total')<span class="rightt ">@if($currencys->code == 'RUB')  {{Str::substr($sum / $currencys->rate + $araqum_sum, 0, 5)}} @else {{Str::substr($sum / $currencys->rate + $araqum_sum, 0, 4)}} @endif {{$currencys->symbol}}</span></h4>

                            <div class="col-md-12">
                                <h3>@lang('main.payment-type')</h3>
                                <input type="radio" checked name="pay" value="cash" id="cash" />
                                <label class="cash" for="cash">@lang('main.online')</label>

                                <input type="radio" name="pay" value="non_cash" id="no_cash" />
                                <label class="cash" for="no_cash">@lang('main.cash')</label>
                            </div>
                            <div class="payment-options ml-10">
                                <div class="option-block"></div>
                                <div class="option-block">
                                    <div class="radio-block cc-selector">
                                        <input type="radio" name="payment_type" value="ameria" id="visa" class="pl-40 pl-xs-0 pl-sm-0" />
                                        <label class="drinkcard-cc visa" for="visa"></label>

                                        <input type="radio" name="payment_type" value="idram" id="idram" />
                                        <label class="drinkcard-cc idram" for="idram"></label>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="sum" value="{{$sum+$araqum_sum}}">
                            <div class="placeorder-button text-left pb-20 pb-xs-30">
                                <button class="btn-primary checkbutton" type="submit">@lang('main.pay')</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                    <div class="image">
                        <img src="/evrika/images/confirmation.png" class="img-responsive" alt="confirm" title="confirm" />
                    </div>
                </div>
{{--                <div class="col-md-12 col-sm-12 col-xs-12 text-center">--}}
{{--                    <div class="buttons">--}}
{{--                        <a type="button" class="btn-primary" href="/">Վերադառնալ գլխավոր էջ</a>--}}
{{--                        <a type="button" class="btn-primary" href="">Շարունակել գնումները</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
        </div>
    </section>
@endsection
