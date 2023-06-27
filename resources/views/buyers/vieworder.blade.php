@extends('layouts.nav')
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
                            <a href="{{ url('my_orders') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Shipping Details</strong></h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $order->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $order->lname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $order->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $order->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2">
                                    {{ $order->address }},
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

                                        @foreach ($orderitem as $orderitems)
                                            <tr>
                                                <td>{{ $orderitems->product->prod_name }}</td>
                                                <td>{{ $orderitems->prod_qty }}</td>
                                                <td>{{ $orderitems->price }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/products/' . $orderitems->product->prod_picture) }}"
                                                        alt="Image" height="100px" width="100px">
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <h4>Grand Total : <span class="float-end">{{ $order->total_price }}</span></h4>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
