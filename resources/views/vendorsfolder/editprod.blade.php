<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    {{-- <link href="../css/bootstrap.min.css" rel="stylesheet"> --}}
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    @if (session('status'))
                        <script>
                            swal("{{ session('status') }}");
                        </script>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Update Product') }}</div>

                    <div class="card-body">
                        <form method="post" action='{{ url('updateprod/' . $editpro->id) }}'
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Select Category</label><br><br>

                                <select name="cate_id" id="" value="">
                                    {{-- @foreach ($cate as $cates) --}}
                                    <option value="{{ $editpro->cate_id }}">{{ $editpro->category->cate_name }}</option>
                                    {{-- @endforeach --}}

                                </select><br><br>
                            </div>

                            <div class="mb-5">
                                <label for="exampleFormControlInput1" class="form-label">Product Name</label><br><br>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    name="prod_name" value="{{ $editpro->prod_name }}" required><br><br>
                            </div>
                            <div class="mb-5 mt-4">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label><br><br>
                                <textarea class="form-control" id="exampleFormControlTextarea1" value="{{ $editpro->descriptions }}" name="description"
                                    required>{{ $editpro->descriptions }}</textarea><br><br>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Amount</label><br><br>
                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                    value="{{ $editpro->amount }}" name="amount" required><br><br>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Quantity</label><br><br>
                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                    value="{{ $editpro->quantity }}" name="quantity" required><br><br>
                            </div>

                            {{-- <div class="mb-3 mt-5">
                                    <label for="exampleFormControlInput1" class="form-label">Is this Product stil Available</label><br><br>

                                    <select name="status" id="" value="">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                    </select><br><br>
                                </div> --}}


                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Product
                                    Picture</label><br><br>
                                <input type="file" name="prod_picture" class="form-control">
                                <img src="{{ asset('uploads/products/' . $editpro->prod_picture) }}"
                                    alt="Product Image" width="50" height="50">
                            </div><br><br>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Product') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
