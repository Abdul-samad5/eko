@php
    if (Auth::user()->role_as == '5') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')

@section('title', 'All Product')

@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

    <div class="container-lg">

        <!-- Recent orders-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Uploaded Products</h3>
                        <hr>
                        @if ($products->count() > 0)
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr class="my-4">
                                        <th scope="col">ID</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price (NGN)</th>
                                        <th scope="col" class="text-center">Quantity Available/<br> Total Quantity</th>
                                        <th scope="col">Uploaded by</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" colspan="3">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    {{-- @if ($prods->count > 0) --}}
                                    @foreach ($products as $product)
                                        <tr class="my-4 dash-card">
                                            <td scope="col">{{ $product->id }}</td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/products/' . $product->prod_picture) }}"
                                                    width="50" height="50" lt=""></td>
                                            <td scope="col">{{ $product->prod_name }}</td>
                                            <td scope="col">{{ $product->amount }}</td>
                                            <td scope="col">{{ $product->quantity }}</td>
                                            <td scope="col">{{ $product->user->email }}</td>
                                            <td scope="col">
                                                {{ $product->quantity == 0 ? 'Not Available' : 'Available' }}
                                            </td>
                                            @if ($product->status == 1)
                                            <td scope="col" class="justify-content-center">
                                                <a href="{{ url('disapproveprod/' . $product->id) }}" class="btn btn-danger">Disapprove</a>
                                            </td>

                                            @else
                                            <td scope="col" class="justify-content-center">
                                                <a href="{{ url('approveprod/' . $product->id) }}" class="btn btn-primary">Approve</a>
                                            </td>
                                            @endif

                                            <td scope="col" class="justify-content-center">
                                                <a href="{{ url('viewproducts/' . $product->id) }}" class="btn btn-success">View</a>
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
