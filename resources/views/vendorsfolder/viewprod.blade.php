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
 
 
 <div class="container-lg mt-7">
     <div class="row">
         <div class="col-12 w-100 d-flex justify-content-between">
             {{-- <p class="page-title">Product</p> --}}
             <button class="btn btn-primary p-2 mb-3 mt-3">
                 <i class="fa fa-plus"></i> <a href="{{ route('getprod') }}" class="text-white text-decoration-none">Add Product</a>
             </button>
         </div>
     </div>
 </div>

 <div class="container-lg">

     <!-- Recent orders-->
     <div class="row">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-body">
                     <h3>Uploaded Products</h3>
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
     <!-- Recent orders End-->

 </div>
 @endsection
