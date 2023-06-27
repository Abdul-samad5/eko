@extends('layouts.nav')
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">

            <h4>
                <a href="{{ url('allproducts') }}" class="text-black text-decoration-none">
                    Home
                </a>/

                <a href="{{ url('cartlist') }}" class="text-black text-decoration-none">
                    Cart
                </a>/
            </h4>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container my-5">
        <div class="card shadow">
            @if ($cart->count() > 0)
                <div class="card-body">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart as $carts)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('uploads/products/' . $carts->product->prod_picture) }}" alt="image here"
                                    height="170px" class="w-100">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h3>{{ $carts->product->prod_name }}</h3>
                            </div>

                            <div class="col-md-2 my-auto">
                                <h4>  {{ $carts->product->amount }}</h4>
                            </div>

                            <div class="col-md-3 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $carts->prod_id }}">
                                @if ($carts->product->quantity > $carts->prod_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <span class="input-group-text changeqty decrement-btn">-</span>
                                        <input type="number" name="quantity" min="1"
                                         style="width: 100px;" value="{{ $carts->prod_qty }}"
                                            class="form-control qty-input">
                                        <span class="input-group-text changeqty increment-btn">+</span>
                                    </div>
                                    @php
                                        $total += $carts->product->amount * $carts->prod_qty;
                                    @endphp
                                @else
                                <div class="input-group text-center mb-3">
                                        <span class="input-group-text changeqty decrement-btn">-</span>
                                        <input type="text" name="quantity" min="1"
                                         style="width: 100px;" value="{{ $carts->prod_qty }}"
                                            class="form-control qty-input">
                                        {{-- <span class="input-group-text changeqty increment-btn">+</span> --}}
                                    </div>
                                    <button class="btn btn-danger">Out of Stock</button>
                                @endif

                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger delete-cart">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total Price: {{ $total }}
                        <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                    </h6>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your Cart is Empty</h2>
                    <a href="{{ route('allproducts') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
@endsection

<script>
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


</script>


@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
@endsection
