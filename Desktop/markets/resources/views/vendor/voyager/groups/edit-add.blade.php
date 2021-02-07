@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());

    use App\Subcategory;
    $subcategories = Subcategory::all();
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    {{--    css--}}
    <style>
        .menu {
            width: auto;
            height: auto;
            padding-left: 0;
        }
        .menu li {
            list-style-type: none;
        }
        .menu > li > a {
            cursor: pointer;
            background-color: #0392ce;
            border-bottom: 2px solid #fff;
            width: 100%;
            height: 45px;
            line-height: 45px;
            text-indent: 12px;
            display: block;
            position: relative;
            color: #fff;
            font-size: 19px;
        }
        .menu ul li a {
            background: #ffffff;
            width: 100%;
            height: 30px;
            line-height: 30px;
            text-indent: 30px;
            display: block;
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: #666;
        }
        .menu ul li a:hover {
            color: #337ab7;
        }
        .menu li a img {
            height: 30px;
            width: 30px;
            margin-top: 5px;
        }
        .menu li a .ttl {
            margin: 1px 0 0 -5px;
            position: absolute;
        }
        .menu ul li:last-child a {
            border-bottom: 1px solid #c1c1c1;
        }
        .menu > li > a:hover, .menu > li > a.active {
            color: #000;
        }
        .menu > li > a .ttl_arrow {
            font-family: Tahoma;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            position: absolute;
            right: 20px;
            top: 50%;
            line-height: 18px;
            margin: -10px 0 0 0;
            color: #fff;
            text-indent: 0;
            text-align: center;
            transition: all 0s ease;
        }
        .menu > li > a:hover .ttl_arrow, .menu > li a.active .ttl_arrow {
            transform: rotate(-90deg);
        }
        .menu > li > ul li a:before {
            content: '●';
            font-size: 16px;
            color: #337ab7;
            position: absolute;
            width: 1em;
            height: 1em;
            top: 0;
            left: -15px;
        }

        .menu > li > ul li:hover a, .menu > li > ul li:hover a span, .menu > li > ul li:hover a:before {
            color: #0392ce;
            cursor: pointer;
        }
        .menu ul > li > a span {
            font-size: 0.857em;
            display: inline-block;
            position: absolute;
            right: 1em;
            top: 50%;
            background: #fff;
            border: 1px solid #d0d0d3;
            line-height: 1em;
            height: 1em;
            padding: 3px 4px;
            margin: -8px -5px 0 0;
            color: #878d95;
            text-indent: 0;
            text-align: center;
            -webkit-border-radius: .769em;
            -moz-border-radius: 769em;
            border-radius: 769em;
            text-shadow: 0px 0px 0px rgba(255,255,255,.01);
        }
        .menu-cat {
            border: 2px solid #0392ce;
            width: 100%;
            margin-bottom: 15px;
            padding: 5px
        }

    </style>
    {{--    end css--}}

    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                          method="POST" enctype="multipart/form-data">



                        <!-- PUT Method if we are editing -->
                    @if($edit)
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            <ul class="menu">
                                <h3>Ընտրեք Ենթա կատեգորիան (SubCategory)</h3>
                                <input type="text" name=""  class="menu-cat" disabled>
                                <li class="item1">
                                    <a><span class="ttl">Ենթա կատեգորիա (SubCategory)</span><span class="ttl_arrow"><</span></a>
                                    <ul>
                                        @foreach($subcategories  as $item)
                                            <li class="subitem1 category-{{$item->id}}" data-id="{{$item->id}}" data-name="{{$item->name}}">
                                                <a href="/{{config('app.locale')}}/subcategory/{{$item->id}}">{{$item->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>


                            @foreach($dataTypeRows as $row)
                            <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif

                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}
                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function() {
                $file = $(this).siblings(tag);

                params = {
                    slug:   '{{ $dataType->slug }}',
                    filename:  $file.data('file-name'),
                    id:     $file.data('id'),
                    field:  $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();



            $('.subitem1').click(function (e) {
                e.preventDefault();
                var cat_name = $(this).data('name');
                var cat_id = $(this).data('id');
                $('.menu-cat').val(cat_name);
                $("input[name='subcategory_id']").val(cat_id);
                console.log( $("input[name='subcategory_id']").val());
            });

            var categori_id = $("input[name='subcategory_id']").val();
            if(categori_id>0){
                var select = "#category-"+categori_id;
                console.log(select);

                var category_name = $("#category-"+categori_id).attr('data-name');
                console.log(category_name);
                $('.menu-cat').val(category_name);
            }

            console.log($("input[name='subcategory_id']").val());

            $('select').change( function () {
                var option_val =  $(this).val();
                $("input[name='subcategory_id']").val(option_val);
            });

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(function() {
            var menu_ul = $('.menu > li > ul'), menu_a = $('.menu > li > a');

            menu_ul.hide();

            menu_a.click(function(e) {
                e.preventDefault();
                if (!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true, true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true, true).slideUp('normal');
                }
            });
        });
    </script>
    {{--js--}}

@stop
