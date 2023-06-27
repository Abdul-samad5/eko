@php
    if (Auth::user()->role_as == '5') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')

@section('title', 'Dashboard')

@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

    <div class="row my-5" style="margin-left:40px;">
        @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">

                        Total Buyers
                        <h2>{{ $buyers }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link  text-decoration-none" href="{{ route('allbuyer') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif


        @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
            <div class="col-md-3">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        Total Products
                        <h2>{{ $product }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link  text-decoration-none" href="{{ route('allprod') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif

        {{-- for vendors --}}
    
        @if (Auth::user()->role_as == 4)
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-success text-black mb-4">
                    <div class="card-body order">
                        Total Products
                        <h2>{{ $total_userprod }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between mine">
                        <a class="small text-black stretched-link  text-decoration-none" href="{{ route('viewprod') }}">View Details</a>
                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        
        @endif
        @if (Auth::user()->role_as == 4)
        
            <div class="col-md-4">
                <div class="card bg-info text-black mb-4">
                    <div class="card-body order">
                        Total Orders
                        <h2>{{ $order }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between mine">
                        <a class="small text-black stretched-link  text-decoration-none" href="{{ route('vendorprod') }}">View Details</a>
                        <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endif
    


        @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
            <div class="col-md-3">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        Total Vendors
                        <h2>{{ $vendor }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link  text-decoration-none" href="{{ route('viewvendors') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
            <div class="col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        Total Completed Orders
                        <h2>{{  $completed_order }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link text-decoration-none" href="{{ url('orderhistory') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
            <div class="col-md-3">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        Total New Orders
                        <h2>{{ $uncompleted_order }}</h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link  text-decoration-none" href="{{ url('orders') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        @endif

       <!-- oreder  -->

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <h3 class="mt-4 ms-4" style="color: #FF725E;">Add Product</h3>
                    <hr>
                    <form action="{{ route('addprod') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleFormControlInput1" class="form-label" style="color: #FF725E;">Select Category</label><br><br>
                                    <select name="cate_id" id="">
                                        @foreach ($cate as $cates)
                                            <option value="{{ $cates->id }}">{{ $cates->cate_name }}</option>
                                        @endforeach

                                    </select><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlInput1" class="form-label" style="color: #FF725E;">Product Name</label><br><br>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        name="prod_name" required><br><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="color: #FF725E;">Description</label><br><br>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" required></textarea><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="color: #FF725E;">Amount</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="amount"
                                        required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="color: #FF725E;">Quantity</label><br><br>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="quantity"
                                        required><br><br>
                                </div>


                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label" style="color: #FF725E;">Product
                                        Picture</label><br><br>
                                    <input type="file" class="form-control" id="exampleFormControlInput1"
                                        name="prod_picture" required><br><br>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Uploaded Products</h6>
                        <hr>
                        @if ($prod->count() > 0)
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr class="my-4">
                                        <th scope="col">ID</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price (NGN)</th>
                                        <th scope="col" class="text-center">Quantity Available/<br> Total Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    {{-- @if ($prods->count > 0) --}}
                                    @foreach ($prod as $prods)
                                        <tr class="my-4 dash-card">
                                            <td scope="col">{{ $prods->id }}</td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/products/' . $prods->prod_picture) }}"
                                                    width="50" height="50" lt=""></td>
                                            <td scope="col">{{ $prods->prod_name }}</td>
                                            <td scope="col">{{ $prods->amount }}</td>
                                            <td scope="col">{{ $prods->quantity }}</td>
                                            <td scope="col">
                                                {{ $prods->status == 1 ? 'Available' : 'Not Available' }}
                                            </td>
                                            <td scope="col" class="justify-content-center">
                                                <a href="{{ url('editprod/' . $prods->id) }}">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p>You have not uploaded any product</p>
                        @endif

                    </div>

                </div>
            </div>
        </div>



    </div>
    <style scoped>
    .order{
        background-color: rgba(235, 234, 234, 1);
    }
    .mine{
        background: rgba(235, 234, 234, 1);
    }
</style>
@endsection
{{-- @endsection --}}