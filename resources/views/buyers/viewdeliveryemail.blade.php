@extends('layouts.nav')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                @if ($receivedmail->count() > 0)
                    <div class="card">
                        <div class="card-body">
                            @if ($receivedmail->delivery_package == 'Companys Packaging')
                                <div class="col-md-12">
                                    <h4><strong>Delivery Request Response Details</strong></h4>
                                    <hr>
                                    <label for="">Number of pickup points</label>
                                    <div class="border p-2"> {{ $receivedmail->pickup_no }}</div>
                                    <label for="">Delivery Package:</label><br>
                                    <div class="border p-2"> {{ $receivedmail->delivery_package }}</div>
                                    <label for="">Number of Box:</label><br>
                                    <div class="border p-2">{{ $receivedmail->box_no }}</div>
                                    <label for="">Box Size:</label><br>
                                    <div class="border p-2">
                                        @if ($receivedmail->box_size == 1950)
                                            Small Box <p><strong>Price of each box is: 1950</strong></p>
                                        @elseif($receivedmail->box_size == 2900)
                                            Big Box<p><strong>Price of each box is: 2900</strong></p>
                                        @elseif($receivedmail->box_size == 4300)
                                            Large Box<p><strong>Price of each box is: 4300</strong></p>
                                        @endif
                                    </div>
                                    <label for="">Number of Extra Box:</label><br>
                                    <div class="border p-2">{{ $receivedmail->extrabox_no }}</div>
                                    <label for="">Extra Box is:</label>
                                    <div class="border p-2">
                                        @if ($receivedmail->extra_box == 1000)
                                            Small Box<p><strong>Price of each extra Box: 1000</strong></p>
                                        @elseif($receivedmail->extra_box == 1500)
                                            Big Box <p><strong>Price of each extra Box: 1500</strong></p>
                                        @elseif($receivedmail->extra_box == 2000)
                                            Large Box <p><strong>Price of each extra Box: 2000</strong></p>
                                        @endif
                                    </div>
                                    <label for="">Distance Kilometer</label>
                                    <div class="border p-2"> {{ $receivedmail->distance_km }}</div>
                                    <label for="">Dimentional weight</label>
                                    <div class="border p-2"> {{ $receivedmail->dimensional_w }}</div>
                                    <label for="">Total</label>
                                    <div class="border p-2"> {{ $receivedmail->total_price }}</div>

                                </div>
                            @endif


                            @if ($receivedmail->delivery_package == 'Customers Packaging')
                                <div class="col-md-12">
                                    <h4><strong>Delivery Request Response Details</strong></h4>
                                    <hr>
                                    <label for="">Number of pickup points</label>
                                    <div class="border p-2"> {{ $receivedmail->pickup_no }}</div>
                                    <label for="">Delivery Package</label>
                                    <div class="border p-2"> {{ $receivedmail->delivery_package }}</div>
                                    <label for="">Distance Kilometer</label>
                                    <div class="border p-2"> {{ $receivedmail->distance_km }}</div>
                                    <label for="">Dimentional weight</label>
                                    <div class="border p-2"> {{ $receivedmail->dimensional_w }}</div>
                                    <label for="">Total</label>
                                    <div class="border p-2"> {{ $receivedmail->total_price }}</div>

                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="id" value="{{ $receivedmail->id }}" class="form-control id">
                        @php
                            $total = $receivedmail->total_price;
                        @endphp
                        <div id="paypal-button-container"></div>
                    </div>
                @else
                    <p>Admin is yet to reply your delivery Request</p>
                @endif
            </div>

        </div>
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

                     var id = $('.id').val()

                    $.ajax({
                        method: "POST",
                        url: "/payfordelivery",
                        data: {
                            'id': id,
                            'payment_mode': 'Paid by Paypal',
                            'payment_id': transaction.id,
                            'status' : 1,
                        },
                        success: function(responseb) {
                            // alert(responseb.status)
                            Swal.fire(responseb.status)
                                .then((value) => {
                                    window.location.reload
                                });
                        }
                    })
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
