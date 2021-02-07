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
                <g fill="none" stroke="#F44812" stroke-width="2">
                    <circle cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                    <circle id="colored" fill="#F44812" cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                    <polyline class="st0" stroke="#fff" stroke-width="10" points="43.5,77.8  112.2,77.8 " style="stroke-dasharray:100px, 100px; stroke-dashoffset: 200px;"/>
                </g>
            </svg>
        </div>
        <br />
        <h2>@lang('main.payment-no-success'). @lang('main.please-try-again')</h2>
        <br>
        <div class="success-paym">
            <p class="prev-btn" style="display: inline-block">@lang('main.you-will-redirect-home') <span id="demo" style="font-weight: bold; display: inline-block;"> 10 @lang('main.secound')</span></p>
{{--            <ul class="fa-ul mb-10" style="display: inline-block">--}}
{{--                <li style="margin-bottom: 5px;"><i class="fa-li fa fa-spinner fa-spin"></i></li>--}}
{{--            </ul>--}}
            <progress value="0" max="9" id="progressBar" style=" margin-left: 20px"></progress>
        </div>
    </div>
    <script>
        var timer = setTimeout(function() {
            window.location='/{{app()->getlocale()}}'
        }, 10000);

        var timeleft = 9;
        var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
            }
            document.getElementById("progressBar").value = 9 - timeleft;
            timeleft -= 1;
        }, 1000);
    </script>
@endsection
