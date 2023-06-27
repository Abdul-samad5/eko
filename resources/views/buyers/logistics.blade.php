@extends('layouts.nav')
@section('content')
    {{-- @php $total = 0; @endphp --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container mt-5">
        <form action="{{ url('submitlogistics') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h6>Logistics/Marketing Survey</h6>
                            <p>Are you looking for someone to look for a product for you, You are just a step away!</p>

                        </div>
                        <div class="card-body">
                            <h6>Below is the price for our market survey</h6>
                            <p><strong>Price for 1 or 2 product is 1000</strong></p>
                            <p><strong>Price for surveying products above 2 is additional 500</strong></p>
                            <hr>

                            <div class="row form-checkout">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                {{-- <input type="hidden" name="user_email" value="{{ Auth::user()->email }}"> --}}
                                <div class="col-md-6">
                                    <label for="product_no">
                                        <p>How many products do you want us to survey</p>
                                    </label>
                                    <input type="text" class="form-control" name="product_no"
                                        placeholder="Number of Products" required>
                                    <span id="product_no_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="product_name">Product Name <p>List out the name of Products you want us to
                                            survey</p></label>
                                    <input type="text" class="form-control mb-2" name="product_name"
                                        placeholder="Product Name" required>
                                    <span id="product_name_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="" class="form-control"></textarea>
                                    <span id="description_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="location" class="mt-2">
                                        <p>Please kindly select the market you want us to look for this product</p>
                                    </label>
                                    <select name="location" id="" class="form-control">
                                        @foreach ($market as $markets)
                                            <option value="{{ $markets->name }}">{{ $markets->name }}</option>
                                        @endforeach

                                    </select>
                                    <span id="location_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="product_image">Image of Product<p>If Available</p></label>
                                    <input type="file" class="form-control phone" name="product_image"
                                        placeholder="Product Image" required>
                                    <span id="product_image_error" class="text-danger"></span>
                                </div>
                                {{-- @php $total += $carts->product->amount * $carts->prod_qty;@endphp --}}

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mb-2 mt-3">Submit Survey Request</button>
                                </div>

                                {{-- <div id="paypal-button-container"></div> --}}
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

@endsection
