@extends('layouts.nav')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container mt-5">
        <form action="{{ url('submitdeliveryreq') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3><strong>Delivery Request</strong></h3>
                            <p>Do you want us pick up your product and deliver to your door step, You are just a step away!
                            </p>
                        </div>
                        <div class="card-body">

                            <hr>

                            <div class="row form-checkout">
                                @csrf
                                <div class="col-md-6">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control mb-2" name="product_name"
                                        placeholder="Product Name" required>
                                    <span id="product_name_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="description">Description <p>Kindly describ the product</p></label>
                                    <textarea name="description" id="" class="form-control"></textarea>
                                    <span id="description_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="location">
                                        <p>Please select the market we are going to pick it up from</p>
                                    </label>
                                    <select name="location" id="" class="form-control">
                                        @foreach ($market as $markets)
                                            <option value="{{ $markets->name }}">{{ $markets->name }}</option>
                                        @endforeach

                                    </select>
                                    <span id="location_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="dealer_contact">Contact of Dealer</label>
                                    <input type="number" class="form-control" name="dealer_contact"
                                        placeholder="Contact of the Dealer" required>
                                    <span id="dealer_contact_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="product_receipt" class="mt-3">Image of Product Receipt<p>If you have paid
                                            for the product
                                            kindly upload the product receipt</p></label>
                                    <input type="file" class="form-control" name="product_receipt"
                                        placeholder="Product Receipt">
                                    <span id="product_receipt_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="product_cost">Cost of Product <p>If you have not paid for the product please
                                            include the cost</p></label>
                                    <input type="number" class="form-control address" name="product_cost"
                                        placeholder="Please put in your current address, make sure to include the state">
                                    <span id="product_cost" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="delivery_address" class="mt-3">Delivery address <p>This should be your
                                            current address
                                            where we will deliver the product after pick up.</p></label>
                                    <input type="text" class="form-control address" name="delivery_address"
                                        placeholder="make sure to include the state and country" required>
                                    <span id="delivery_address_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="location">
                                        <p>Delivery Method</p>
                                    </label>
                                    <select name="delivery_method" id="" class="form-control" required>
                                        <option value="Express Delivery">Express Delivery</option>
                                        <option value="Normal Delivery">Normal Delivery</option>
                                    </select>
                                    <span id="location_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mb-2 mt-3">Submit Delivery
                                        Request</button>
                                </div>
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
