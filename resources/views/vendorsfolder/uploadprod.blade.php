@php
    if (Auth::user()->role_as == '5') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')

@section('title', 'Upload Product')

@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
<body>
    <div>
    <div class="col-md-8">
                <div class="card">
                    <h3 class="mt-4 ms-4">Upload Product</h3>
                    <hr>
                    <form action="{{ route('addprod') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleFormControlInput1" class="form-label">Select Category</label><br><br>
                                    <select name="cate_id" id="">
                                        @foreach ($cate as $cates)
                                            <option value="{{ $cates->id }}">{{ $cates->cate_name }}</option>
                                        @endforeach

                                    </select><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label><br><br>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        name="prod_name" required><br><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label><br><br>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" required></textarea><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">Amount</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="amount"
                                        required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">Quantity</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="quantity"
                                        required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">length</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="length"
                                        required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">Breadth</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="breadth"
                                        required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">height</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="height"
                                        required><br><br>
                                </div>



                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">Product
                                        Picture</label><br><br>
                                    <input type="file" class="form-control" id="exampleFormControlInput1"
                                        name="prod_picture" required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
</body>

@endsection
