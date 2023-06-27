$(document).ready(function () {

    $('.razorpay').click(function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var fname = $('.fname').val()
        var lname = $('.lname').val()
        var email = $('.email').val()
        var phone = $('.phone').val()
        var address = $('.address').val()

        if (!fname) {
            fname_error = 'First Name is required';
            $('#fname_error').html('');
            $('#fname_error').html(fname_error);
        } else {
            fname_error = '';
            $('#fname_error').html('');
        }

        if (!lname) {
            lname_error = 'Last Name is required';
            $('#lname_error').html('');
            $('#lname_error').html(lname_error);
        } else {
            fname_error = '';
            $('#lname_error').html('');
        }

        if (!email) {
            email_error = 'Email is required';
            $('#email_error').html('');
            $('#email_error').html(email_error);
        } else {
            email_error = '';
            $('#email_error').html('');
        }

        if (!phone) {
            phone_error = 'Phone is required';
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        } else {
            phone_error = '';
            $('#phone_error').html('');
        }

        if (!address) {
            address_error = 'Address is required';
            $('#address_error').html('');
            $('#address_error').html(fname_error);
        } else {
            address_error = '';
            $('#address_error').html('');
        }
        var data = {
            "fname": fname,
            "lname": lname,
            "email": email,
            "phone": phone,
            "address": address,
        }
        $.ajax({
            method: "POST",
            url: "proceed_to_pay",
            data: data,
            success: function (response) {
                // alert(response.total_price)

                var options = {
                    "key": "rzp_test_leck8PAXO0FYDI", // Enter the Key ID generated from the Dashboard
                    "amount": response.total_price * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": response.fname + ' ' + response.lname,
                    "description": "Thank you for choosing us",
                    "image": "https://example.com/your_logo",
                    // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (responsea) {
                        // alert(responsea.razorpay_payment_id);
                        Swal.fire(responsea.razorpay_payment_id);
                        window.location.href = 'my_orders'
                        $.ajax({
                            method: "POST",
                            url: "/placeorder",
                            data: {
                                'fname': response.fname,
                                'lname': response.lname,
                                'email': response.email,
                                'phone': response.phone,
                                'address': response.address,
                                'payment_mode': 'Paid by Razorpay',
                                'payment_id': responsea.razorpay_payment_id,

                            },
                            success: function (responseb) {
                                // alert(responseb.status)
                                Swal.fire(responseb.status)
                                    .then((value) => {
                                        window.location.href = 'my_orders'
                                    });
                                
                                
                            }
                        })
                    },
                    "prefill": {
                        "name": response.fname + ' ' + response.lname,
                        "email": response.email,
                        "contact": response.phone,
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }
        })
        //  }
    });
    
});