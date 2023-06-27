// @section('script')

$(document).ready(function() {
    loadcart()
    loadwish()

    $('.addtocart').click(function(e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        // alert(product_id);
        // alert(product_qty);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            method: "POST",
            url: "/addto_cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            
            success: function(response) {
                loadcart()
                Swal.fire(response.status);
            }

        })



    });

 function loadcart()
 {
    $.ajax({
        method: "GET",
        url: "/load-cart",
        success: function(response) {
             $('.cart-count').html('');
            $('.cart-count').html(response.count);

            // Swal.fire(response.count);
        }

    })
    }

    function loadwish()
 {
    $.ajax({
        method: "GET",
        url: "/load-wish",
        success: function(response) {
             $('.wish-count').html('');
            $('.wish-count').html(response.count);

            // Swal.fire(response.count);
        }

    })
    }    

    $('.increment-btn').click(function(e) {
        e.preventDefault();
        // var inc_value = $('.qty-input').val();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
            // $('.qty-input').val(value);
        }
    });


    $('.decrement-btn').click(function(e) {
        e.preventDefault();
        // var dec_value = $('.qty-input').val();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
            // $('.qty-input').val(value);
        }
    });
    $('.delete-cart').click(function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/delet_cart",
            data: {
                'prod_id': prod_id,
               
            },
            
            success: function(response) {
                window.location.reload();
                Swal.fire(response.status);
            }

        })

    });


    $('.changeqty').click(function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        data = {
            'prod_id' : prod_id,
            'prod_qty' : qty,
        }
        $.ajax({
            method: "POST",
            url: "update_cart",
            data: data,
            success: function (response) {
                window.location.reload();
                Swal.fire(response.status);
            }
        })
    });

});