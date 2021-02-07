@extends('layouts.main')

@section('content')
    <style media="screen">

        .alert {
            background: #f8d7da;
            padding: 5px 10px;
            border-radius: 8px;
        }
        .animation-ctn{
            text-align:center;
            margin: 1em auto;
        }

        @-webkit-keyframes checkmark {
            0% {
                stroke-dashoffset: 100px
            }

            100% {
                stroke-dashoffset: 200px
            }
        }

        @-ms-keyframes checkmark {
            0% {
                stroke-dashoffset: 100px
            }

            100% {
                stroke-dashoffset: 200px
            }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100px
            }

            100% {
                stroke-dashoffset: 0px
            }
        }

        @-webkit-keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 480px

            }

            100% {
                stroke-dashoffset: 960px;

            }
        }

        @-ms-keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 240px
            }

            100% {
                stroke-dashoffset: 480px
            }
        }

        @keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 480px
            }

            100% {
                stroke-dashoffset: 960px
            }
        }

        @keyframes colored-circle {
            0% {
                opacity:0
            }

            100% {
                opacity:100
            }
        }

        /* other styles */
        /* .svg svg {
        display: none
        }
        */
        .inlinesvg .svg svg {
            display: inline
        }

        /* .svg img {
        display: none
        } */

        .icon--order-success svg polyline {
            -webkit-animation: checkmark 0.3s ease-in-out 0.9s backwards;
            animation: checkmark 0.3s ease-in-out 0.9s backwards
        }

        .icon--order-success svg circle {
            -webkit-animation: checkmark-circle 0.6s ease-in-out backwards;
            animation: checkmark-circle 0.6s ease-in-out backwards;
        }
        .icon--order-success svg circle#colored {
            -webkit-animation: colored-circle 0.6s ease-in-out 0.7s backwards;
            animation: colored-circle 0.6s ease-in-out 0.7s backwards;
        }
    </style>
    <div class="animation-ctn">
        <div class="icon icon--order-success svg">
            <svg xmlns="http://www.w3.org/2000/svg" width="154px" height="154px">
                <g fill="none" stroke="#22AE73" stroke-width="2">
                    <circle cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                    <circle id="colored" fill="#22AE73" cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                    <polyline class="st0" stroke="#fff" stroke-width="10" points="43.5,77.8 63.7,97.9 112.2,49.4 " style="stroke-dasharray:100px, 100px; stroke-dashoffset: 200px;"/>
                </g>
            </svg>
        </div>
        <br />
        <h2>@lang('main.payment-success')</h2>
        <h3>@lang('main.thank-you-pay')</h3>
        <h4 style="display: inline-block">@lang('main.order-email'): </h4>
        <h4 style="display: inline-block; margin:0;">{{$success_id->email}}</h4><br>
        {{--        <h4 style="display: inline-block">Transaction ID: </h4>--}}
        {{--        <h4 style="display: inline-block; margin:0;">{{$success_id->transaction_id}}</h4><br>--}}
        <h4 style="display: inline-block">@lang('main.order-id'): </h4>
        <h4 style="display: inline-block; margin:0;">{{$success_id->order_id}}</h4><br>
        <h4 style="display: inline-block">@lang('main.order-amount'): </h4>
        <h4 style="display: inline-block; margin:0;">{{$success_id->amount}} {{App\Services\CurrencyConversion::getCurrencySymbol()}}</h4>
        <br>
        <h3 style="color: red;">@lang('main.order-email-history')</h3>
        <div class="success-paym">
            <p class="prev-btn" style="display: inline-block">@lang('main.you-will-redirect-home') <span id="demo" style="font-weight: bold; display: inline-block;"> 30 @lang('main.secound')</span></p>
            <progress value="0" max="29" id="progressBar" style=" margin-top: 10px; margin-left: 10px;"></progress>
        </div>
    </div>
    <script>
        var timer = setTimeout(function() {
            window.location='/{{app()->getlocale()}}'
        }, 30000);

        var timeleft = 29;
        var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
            }
            document.getElementById("progressBar").value = 29 - timeleft;
            timeleft -= 1;
        }, 1000);
    </script>
@endsection
