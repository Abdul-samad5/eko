@extends(((Auth::user()->role_as == 5) ? 'layouts.nav' : 'layouts.adminheader'))
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                    @if (session('status'))
                        <script>
                            swal("{{ session('status') }}");
                        </script>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mt-4 ms-4">Edit/Update Product</h3>
                                <hr>
                                <form action="{{ url('updateproducts/' . $products->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Product
                                                    Name</label><br><br>
                                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                                    name="prod_name" value="{{ $products->prod_name }}"><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1" class="form-label">Description
                                                 </label><br><br>
                                                 <textarea name="description"id="" cols="30" rows="10">{{ $products->descriptions }}</textarea>
                                                <br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Amount</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    name="amount" value="{{ $products->amount }}"><br><br>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Quantity</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    name="quantity" value="{{ $products->quantity }}"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Height</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    name="height" value="{{ $products->height }}"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Breadth</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    name="breadth" value="{{ $products->breadth }}"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Length</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    name="length" value="{{ $products->length }}"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
