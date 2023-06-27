@extends('layouts.nav')
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h4>
                <a href="{{ url('/') }}" class="text-black text-decoration-none">
                    Home
                </a>/

                <a href="{{ url('checkout') }}" class="text-black text-decoration-none">
                    Checkout
                </a>/
            </h4>
        </div>
    </div>
    @php $total = 0; @endphp
    @php $pickup_no = 0; @endphp
    @php $dw = 0; @endphp

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container mt-5">
        <form action="{{ url('placeorder') }}" method="POST">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <p>This Details will be use for your delivery so please make sure they are all correct and
                                active, if not kindly change it</p>
                            <hr>

                            <div class="row form-checkout">
                                @csrf
                                <div class="col-md-6">
                                    <label for="address">Enter Your address please kindly be specific</label>
                                    <input type="text" class="form-control address" name="address"
                                        placeholder="make sure to include the state and country" required>
                                    <span id="address_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control fname" name="fname"
                                        value="{{ Auth::user()->firstname }}" required>
                                    <span id="fname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control lname" name="lname"
                                        value="{{ Auth::user()->lastname }}" required>
                                    <span id="lname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control email" name="email"
                                        value="{{ Auth::user()->email }}" required>
                                    <span id="email_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone">Phone Number<p>Please crosscheck your phone number before
                                            submitting</p></label>
                                    <input type="number" class="form-control phone" name="phone"
                                        value="{{ Auth::user()->phone_number }}" required>
                                    <span id="phone_error" class="text-danger"></span>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>

                            @if ($cart_item->count() > 0)
                                @php
                                    $total_cart_items = $cart_item->count();
                                    if ($total_cart_items > 2) {
                                        $pickup_no += 500 * $total_cart_items;
                                    } else {
                                        $pickup_no += 1000;
                                    }
                                @endphp

                                {{-- @php
                        foreach ($prod as $prods) {
                            if ($prods->dimensional_w < 2) {
                                $dw = $prods->dimensional_w * 850;
                            } elseif ($prods->dimensional_w >= 2) {
                                $dw = $prods->dimensional_w * 400;
                            } elseif ($prods->dimensional_w >= 7) {
                                $dw = $prods->dimensional_w * 250;
                            }
                        }

                        @endphp --}}

                                <table class="table table-striped table-border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cart_item as $carts)
                                            @php
                                                $product = $carts->product;
                                                //displaying the breadth, height and length of the product
                                                $prod_l = $product->length;
                                                $prod_b = $product->breadth;
                                                $prod_h = $product->height;

                                                //getting the dimension of the product by multiplying the height, breadth and length of the product

                                                $dimensional_w = $prod_l * $prod_b * $prod_h;
                                                if ($dimensional_w < 2) {
                                                    $dw += $dimensional_w * 850;
                                                } elseif ($dimensional_w >= 2 && $product->dimensional_w < 7) {
                                                    $dw += $dimensional_w * 400;
                                                } elseif ($dimensional_w >= 7) {
                                                    $dw += $dimensional_w * 250;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $carts->product->prod_name }}</td>
                                                <td>{{ $carts->prod_qty }}</td>
                                                <td>{{ $carts->product->amount }}</td>
                                            </tr>
                                            @php $total += $carts->product->amount * $carts->prod_qty + $pickup_no + $dw;@endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Pickup Charges: <span class="float-end">Rs {{ $pickup_no }}</span>
                                </h6>
                                <h6 class="px-2">Dimensional Charges: <span class="float-end">Rs
                                        {{ $dw }}</span></h6>
                                {{-- <h6 class="px-2">Grand Total: <span class="float-end">Rs {{ $total + $pickup_no + $dw }}</span></h6> --}}
                                <h6 class="px-2">Grand Total: <span class="float-end">Rs {{ $total }}</span></h6>

                                <hr>
                                <input type="hidden" name="payment_mode" value="Paid by Razorpay">
                                {{-- <button type="submit" class="btn btn-outline-primary form-control">Place Order |
                                    COD</button> --}}
                                <button type="submit" class="btn btn-success mt-3 mb-3 form-control razorpay">Pay with
                                    Razorpay</button>
                                <div id="paypal-button-container"></div>

                        </div>
                    @else
                        <h6 class="text-center">No Product in Cart</h6>
                        @endif

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AXHFYG989DngxybvLGpdsYpRYvwMd3fMI2pvObPk9gv0bdujW6LNc70VjKEPiycpyUXtbBGjuUVmxX4-">
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>



    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert(
                    //     `Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
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



                    $.ajax({
                        method: "POST",
                        url: "/placeorder",
                        data: {
                            'fname': fname,
                            'lname': lname,
                            'email': email,
                            'phone': phone,
                            'address': address,
                            'payment_mode': 'Paid by Paypal',
                            'payment_id': transaction.id,

                        },
                        success: function(responseb) {
                            // alert(responseb.status)
                            Swal.fire(responseb.status)
                                .then((value) => {
                                    window.location.href = 'my_orders'
                                });
                        }
                    })
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
