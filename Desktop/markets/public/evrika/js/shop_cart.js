$( document ).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.shoping-cart').click(function () {
        // let product_count = $('.order-plus').val();
        let product_id = $(this).data('id');
        let product_name = $(this).data('name');
        let product_price = $(this).data('price');
        let product_image = $(this).data('image');
        let id_prod = "count_product_"+product_id;
        let product_count = Number(document.getElementById(id_prod).value);

        // console.log(product_count);

        $.ajax({
            type: 'POST',
            url: '/shop_cart',
            data:{product_id:product_id, product_name:product_name, product_price:product_price, product_image:product_image, product_count:product_count} ,
            error: function(data){
                var errors = data.responseJSON;
                console.log(errors);
            },
            success: function(resp){
                $("#orderings").load(" #orderings");
                $('#main-ordered-product-' + resp).load(' #main-ordered-product-' + resp);


                var count_product = $('.count-product').text();
                count_product++;
                $('.count-product').text(count_product);
            }
        });

    });

    $('.quantity-moins').click(function(e){
        e.preventDefault();
        var count = $(this).parent( "div" ).children('input.count').val();

        if (count > 1) {
            count--;
        }

        var id = $(this).parent( "div" ).children('input.count').data('id');
        var sub_total = $(this).parent().parent().parent().children('td.sub-total');
        var price1 = $(this).parent().parent().parent().children('td.price').text();
        var count_input = $(this).parent( "div" ).children('input.count');
        var price2 = price1.split(" ");
        var price = price2[0];

        $.ajax({
            type: 'POST',
            url: '/shop_cart_quantity',
            data:{id:id, quantity:count} ,
            error: function(data){
                var errors = data.responseJSON;

            },
            success: function(resp){
                count_input.val(count);
                sub_total.text(price*count+"  "+resp);
            }
        });
    });

    $('.quantity-plus').click(function(e){
        e.preventDefault();
        var count = $(this).parent( "div" ).children('input.count').val();
        count++;

        var id = $(this).parent( "div" ).children('input.count').data('id');
        var sub_total = $(this).parent().parent().parent().children('td.sub-total');
        var price1 = $(this).parent().parent().parent().children('td.price').text();
        var count_input = $(this).parent( "div" ).children('input.count');
        var price2 = price1.split(" ");
        var price = price2[0];
        $.ajax({
            type: 'POST',
            url: '/shop_cart_quantity',
            data:{id:id, quantity:count} ,
            error: function(data){
                var errors = data.responseJSON;

            },
            success: function(resp){
                count_input.val(count);
                sub_total.text(price*count+"  "+resp);
            }
        });
    });

    $(document).on('click', '.delete-order-product', function(e){
        e.preventDefault();
        var ordered_product = $(this).data( "id" );

        $.ajax({
            type: 'POST',
            url: '/delete_ordered_product',
            data: {ordered_product: ordered_product},
            error: function (data) {
                var errors = data.responseJSON;

            },
            success: function (resp) {
                $('#main-ordered-product-' + resp).remove();
                $('#ordered-product-' + resp).remove();

                $("#ordering_sum").load(" #ordering_sum");
                $("#orderings").load(" #orderings");

                var count_product = $('.count-product').text();
                count_product--;

                $('.count-product').text(count_product);
            }
        });
    });

    $("#piece").change(function (e) {
        e.preventDefault();
        var singl_price = $(this).data("singlprice");
        $('.single-price').text(singl_price);
        $('#addtocart-single').attr('data-price', singl_price);
        // console.log(singl_price);
    });

    $("#main-piece-packet").change(function (e) {
        e.preventDefault();
        var singl_price = $(this).data("singlprice");
        $('.single-price').text(singl_price);
        $('#addtocart-single').attr('data-price', singl_price);
        // console.log(singl_price);
    });

    $('.singl-shoping-cart').click(function () {

        let product_id = $(this).data('id');
        let product_name = $(this).data('name');
        let product_price = $(this).data('price');
        let product_image = $(this).data('image');

        $.ajax({
            type: 'POST',
            url: '/singl_shop_cart',
            data:{product_id:product_id, product_name:product_name, product_price:product_price, product_image:product_image} ,
            error: function(data){
                var errors = data.responseJSON;
                console.log(errors);
            },
            success: function(resp){
                $("#orderings").load(" #orderings");
                $('#main-ordered-product-' + resp).load(' #main-ordered-product-' + resp);
                var count_product = $('.count-product').text();
                count_product++;
                $('.count-product').text(count_product);
                location.reload();
            }
        });

    });


});


