@php
    if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-primary">
                        <h4 class="text-white"> Order View
                            <a href="{{ url('orders') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Shipping Details</strong></h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $vieworder->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $vieworder->lname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $vieworder->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $vieworder->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2">
                                    {{ $vieworder->address }},
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Order Details</strong></h4>
                                <hr>
                                <table class="table table-bodered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $orders)
                                            <tr>
                                                <td>{{ $orders->product->prod_name }}</td>
                                                <td>{{ $orders->prod_qty }}</td>
                                                <td>{{ $orders->price }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/products/' . $orders->product->prod_picture) }}"
                                                        alt="Image" height="100px" width="100px">
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- <p>hi</p> --}}

                                    </tbody>
                                </table>


                                <h4>Grand Total : <span class="float-end">{{ $vieworder->total_price }}</span></h4>
                                <div class="mt-3">
                                    <label for="" clas="col-md-12">Order Status</label>
                                    <form method="post" action="{{ url('update_status/' . $vieworder->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select form-control" name="status">
                                            <option {{ $vieworder->status == '0' ? 'selected' : '' }} value="0">
                                                Pending</option>
                                            <option {{ $vieworder->status == '1' ? 'selected' : '' }} value="1">
                                                Completed</option>
                                        </select>

                                        <button type="submit" class="btn btn-primary mt-3 form-control">Update
                                            Status</button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <h4><strong>Vendor Details</strong></h4>
                            <hr>
                            @foreach ($order as $orders)
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $orders->product->user->firstname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $orders->product->user->lastname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $orders->product->user->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $orders->product->user->phone_number }}</div>
                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
