@php
     if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

@extends('layouts.adminheader')

@section('title', 'Delivery request history')

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
                <div class="card mt-5">
                <div class="card-header bg-primary">
                        <h4> Delivery Request History
                            <a href="{{ url('viewdeliveryreq') }}" class="btn btn-warning float-end">New Delivery Request</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- <h3>New Delivery Request</h3> --}}
                        {{-- <hr> --}}
                        @if ($deliveryhistory->count() > 0)
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr class="my-4">
                                        <th scope="col">Products Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Dealer Contact</th>
                                        <th scope="col">Product Cost</th>
                                        <th scope="col">Delivery Address</th>
                                        <th scope="col">Delivery Method</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Products Receipt</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    {{-- @if ($prods->count > 0) --}}
                                    @foreach ($deliveryhistory as $deliveryhistorys)
                                        <tr class="my-4 dash-card">
                                            <td scope="col">{{ $deliveryhistorys->product_name }}</td>
                                            <td scope="col">{{ $deliveryhistorys->description }}</td>
                                            <td scope="col">{{ $deliveryhistorys->location }}</td>
                                            <td scope="col">{{ $deliveryhistorys->dealer_contact }}</td>
                                            <td scope="col">{{ $deliveryhistorys->product_cost }}</td>
                                            <td scope="col">{{ $deliveryhistorys->delivery_address }}</td>
                                            <td scope="col">{{ $deliveryhistorys->delivery_method }}</td>
                                            <td>

                                                @if ($deliveryhistorys->status == 1)
                                                    {{ 'In Progress' }}
                                                @elseif($deliveryhistorys->status == 2)
                                                    {{ 'completed' }}
                                                @endif

                                            </td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/receipt/' . $deliveryhistorys->product_receipt) }}"
                                                    width="50" height="50" lt=""></td>
                                            
                                            <td scope="col" class="justify-content-center">
                                                <a href="{{ url('viewdelivery/' . $deliveryhistorys->id) }}" class="btn btn-success">View</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p>No delivery request has been progressed or completed yet!</p>
                        @endif

                    </div>

                </div>
            </div>

        </div>
        <!-- Recent orders End-->

    </div>
@endsection
