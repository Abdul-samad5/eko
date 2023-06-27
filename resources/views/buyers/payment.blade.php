@extends('layouts.nav')
@section('content')
    @php $total = 0; @endphp
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container mt-5">
        <form action="{{ url('make_payment') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h6>Logistics/Marketing Survey</h6>
                            <p>Cross check the information you provided!</p>

                        </div>
                        <div class="card-body">
                            <div class="row form-checkout">
                                @csrf
                                {{-- @foreach($getsurvey as $getsurveys) --}}
                                    {{-- {{ dd($getsurvey) }} --}}
                                {{-- @endforeach --}}
                                
                                <input type="hidden" value="{{ $getsurvey->id }}" name="marketsurvey_id"
                                    class="marketsurvey_id">
                                <div class="col-md-6">
                                    <label for="product_no">Number of products to survey for you</label>
                                    <input type="text" class="form-control product_no" name="product_no"
                                        value="{{ $getsurvey->product_no }}" required>
                                    <span id="product_no_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname">Product Name</label>
                                    <input type="text" class="form-control product_name" name="product_name"
                                        value="{{ $getsurvey->product_name }}" required>
                                    <span id="lname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="" class="form-control description">{{ $getsurvey->description }}</textarea>
                                    <span id="description_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="location" class="mt-2">
                                        <p>Please kindly select the market you want us to look for this product</p>
                                    </label>
                                    <select name="location" id="" class="form-control location">
                                        <option value="{{ $getsurvey->location }}">{{ $getsurvey->location }}</option>
                                    </select>
                                    <span id="location_error" class="text-danger"></span>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Product
                                        Image</label><br><br>
                                    {{-- <input type="file" name="product_image" class="form-control product_image"> --}}
                                    <img src="{{ asset('uploads/receipt/' . $getsurvey->product_image) }}"
                                        alt="Product Image" width="50" height="50" name="product_image">
                                </div>

                                {{-- @foreach ($getsurvey as $getsurveys) --}}
                                @if ($getsurvey->product_no > 2)
                                    @php $total += 500 * $getsurvey->product_no @endphp
                                @else
                                    @php $total += 1000 @endphp
                                @endif
                                <div class="card-footer mb-3">
                                    <h6>Total Price: {{ $total }}
                                        {{-- <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a> --}}
                                    </h6>
                                </div>
                                {{-- @endforeach --}}
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
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


                    var marketsurvey_id = $('.marketsurvey_id').val()
                    var product_no = $('.product_no').val()
                    var product_name = $('.product_name').val()
                    var description = $('.description').val()
                    var location = $('.location').val()
                    var product_image = $('.product_image').val()

                    $.ajax({
                        method: "POST",
                        url: "/make_payment",
                        data: {
                            'marketsurvey_id': marketsurvey_id,
                            'product_no': product_no,
                            'product_name': product_name,
                            'description': description,
                            'location': location,
                            'product_image': product_image,
                            'payment_mode': 'Paid by Paypal',
                            'payment_id': transaction.id,

                        },
                        success: function(responseb) {
                            // alert(responseb.status)
                            Swal.fire(responseb.status)
                                .then((value) => {
                                    window.location.reload();
                                });
                        }
                    })
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
