@php
     if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

@extends('layouts.adminheader')

@section('title', 'New delivery')

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
                        <h4> New Delivery Request
                            <a href="{{ url('deliveryhistory') }}" class="btn btn-warning float-end">Delivery Request History</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- <h3>New Delivery Request</h3> --}}
                        {{-- <hr> --}}
                        @if ($viewdelivery->count() > 0)
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
                                        {{-- <th scope="col">Payment</th> --}}
                                        <th scope="col">Products Receipt</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    {{-- @if ($prods->count > 0) --}}
                                    @foreach ($viewdelivery as $viewdeliverys)
                                        <tr class="my-4 dash-card">
                                            <td scope="col">{{ $viewdeliverys->product_name }}</td>
                                            <td scope="col">{{ $viewdeliverys->description }}</td>
                                            <td scope="col">{{ $viewdeliverys->location }}</td>
                                            <td scope="col">{{ $viewdeliverys->dealer_contact }}</td>
                                            <td scope="col">{{ $viewdeliverys->product_cost }}</td>
                                            <td scope="col">{{ $viewdeliverys->delivery_address }}</td>
                                            <td scope="col">{{ $viewdeliverys->delivery_method }}</td>
                                            <td>

                                                @if ($viewdeliverys->status == 0)
                                                    {{ 'pending' }}
                                                @elseif($viewdeliverys->status == 1)
                                                    {{ 'In Progress' }}
                                                @elseif($viewdeliverys->status == 2)
                                                    {{ 'completed' }}
                                                @elseif($viewdeliverys->status == 3)
                                                    {{ 'declined' }}
                                                @endif

                                            </td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/receipt/' . $viewdeliverys->product_receipt) }}"
                                                    width="50" height="50" lt=""></td>
                                            
                                            <td scope="col" class="justify-content-center">
                                           
                                            <a href="{{ url('viewdelivery/' . $viewdeliverys->id) }}" class="btn btn-primary">View</a>
                                           
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p>No delivery request yet!</p>
                        @endif

                    </div>

                </div>
            </div>

        </div>
        <!-- Recent orders End-->

    </div>
@endsection
