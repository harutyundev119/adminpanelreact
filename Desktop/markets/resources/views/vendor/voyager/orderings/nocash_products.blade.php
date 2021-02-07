@extends('voyager::master')
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            Օնլայն վճարված պատվերներ
        </h1>
    </div>
@stop

@section('content')
    <style>
        .no-paid{
            padding: 5px 0px;
            background-color: red;
            /*width: 50px;*/
            text-align: center;
            color: #ffffff;
        }

        .paid{
            padding: 5px 2px;
            background-color: #0E9A00;
            /*width: 50px;*/
            text-align: center;
            color: #ffffff;
        }

        .red{
            background-color: red;
        }

        .green{
            background-color: #0E9A00;
        }
    </style>
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="

                                            : activate to sort column ascending" style="width: 20px;">
                                        <input type="checkbox" class="select_all">
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        User Id
                                                                                    : activate to sort column ascending" style="width: 58px;">
                                        Գնորդի Id
                                    </th>
                                    {{--                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="--}}
                                    {{--                                                                                        Customer City--}}
                                    {{--                                                                                    : activate to sort column ascending" style="width: 111px; s">--}}
                                    {{--                                        customer city--}}
                                    {{--                                    </th>--}}
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Customer Addres
                                                                                    : activate to sort column ascending" style="width: 135px;">
                                        Հասցեն
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Customer Telephone
                                                                                    : activate to sort column ascending" style="width: 162px;">
                                        Հեռախոսահամար
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Email
                                                                                    : activate to sort column ascending" style="width: 78px;">
                                        Էլ. փոստ
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Order Status
                                                                                    : activate to sort column ascending" style="width: 101px;">
                                        Կարգավիճակ
                                    </th>
                                    {{--                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="--}}
                                    {{--                                                                                        Curency--}}
                                    {{--                                                                                    : activate to sort column ascending" style="width: 67px;">--}}
                                    {{--                                        Curency--}}
                                    {{--                                    </th>--}}
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Amount
                                                                                    : activate to sort column ascending" style="width: 66px;">
                                        Գումար (դրամ)
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Created At
                                                                                    : activate to sort column ascending" style="width: 138px;">
                                        Ժամանակ
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Order Id
                                                                                    : activate to sort column ascending" style="width: 115px;">
                                        Պատվերի ID
                                    </th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="
                                                                                        Cash
                                                                                    : activate to sort column ascending" style="width: 42px;">
                                        Վճարման տարբերակ
                                    </th><th class="actions text-right sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 163px;">Կարգավորում</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($nocash_products as $product)
                                    <tr>

                                        <td>
                                            <input type="checkbox" name="row_id" id="checkbox_1" value="1">
                                        </td>
                                        <td>
                                            <div>{{$product->user_id}}</div>
                                        </td>
                                        {{--                                        <td>--}}
                                        {{--                                            <div>{{$product->customer_city}}</div>--}}
                                        {{--                                        </td>--}}
                                        <td>
                                            <div>{{$product->customer_addres}}</div>
                                        </td>
                                        <td>
                                            <div>{{$product->customer_telephone}}</div>
                                        </td>
                                        <td>
                                            <div>{{$product->email}}</div>
                                        </td>
                                        <td>
                                            <div class="{{$product->order_status==0 ? "no-paid" : "paid"}}">
                                                @if($product->order_status==0)
                                                    <div>Վճարված չէ</div>
                                                @else
                                                    <div>Վճարված է</div>
                                                @endif</div>
                                        </td>
                                        {{--                                        <td>--}}
                                        {{--                                            <div>{{$product->curency}}</div>--}}
                                        {{--                                        </td>--}}
                                        <td>
                                            <div>{{$product->amount}}</div>
                                        </td>
                                        <td>
                                            {{$product->created_at}}
                                        </td>
                                        <td>
                                            <div>{{$product->order_id}}</div>
                                        </td>
                                        <td>
                                            @if($product->cash == 0)
                                                <div>Օնլայն</div>
                                            @else
                                                <div>Կանխիկ</div>
                                            @endif
                                        </td>


                                        <td class="no-sort no-click bread-actions">
                                            <a href="products_in_order/{{strlen($product->session)>4 ? $product->session : $product->order_id }}" class="btn btn-sm btn-warning pull-right edit">
                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Դիտել պատվերը</span>
                                            </a>

                                            @if($product->order_status==0)
                                                <a href="" title="Paid" class="btn btn-sm pull-right red add-paid" data-id="{{$product->id}}">
                                                    <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Դարձնել վճարված</span>
                                                </a>
                                            @else
                                                {{--                                                <a href="" title="Paid" class="btn btn-sm pull-right green">--}}
                                                {{--                                                    <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Վճարված չէ</span>--}}
                                                {{--                                                </a>--}}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }}</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@stop

@section('javascript')
    <!-- DataTables -->

    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.add-paid').click(function(e){
                e.preventDefault();
                var ordered_product_id = $(this).data( "id" );
                if ( confirm("Olredy paid this order?")) {

                    $.ajax({
                        type: 'POST',
                        url: '/admin/order_add_paid',
                        data: {ordered_product_id: ordered_product_id},
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        },
                        success: function (resp) {
                            $(".no-paid").text(1);
                            $(".no-paid").addClass("paid");
                            $(".no-paid").removeClass("no-paid");
                            $(this).removeClass("red");
                            $(this).addClass("green");
                            $(this).removeClass("add-paid");
                        }
                    });
                }
            });

            $('#search-input select').select2({
                minimumResultsForSearch: Infinity
            });

            $('.select_all').on('click', function(e) {
                $('input[name="row_id"]').prop('checked', $(this).prop('checked')).trigger('change');
            });
        });

        var deleteFormAction;

        $('input[name="row_id"]').on('change', function () {
            var ids = [];
            $('input[name="row_id"]').each(function() {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            $('.selected_ids').val(ids);
        });
    </script>
@stop
