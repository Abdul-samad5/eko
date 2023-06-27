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
                        <h4 class="text-white"> Delivery Request View
                            <a href="{{ url('viewdeliveryreq') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Delivery Request Details</strong></h4>
                                <hr>
                                <label for="">Product Name</label>
                                <div class="border p-2"> {{ $viewdelivery->product_name }}</div>
                                <label for="">Description</label>
                                <div class="border p-2"> {{ $viewdelivery->description }}</div>
                                <label for="">Location</label>
                                <div class="border p-2"> {{ $viewdelivery->location }}</div>
                                <label for="">Dealer Contact</label>
                                <div class="border p-2"> {{ $viewdelivery->dealer_contact }}</div>
                                <label for="">Product Cost</label>
                                <div class="border p-2">{{ $viewdelivery->product_cost }}</div>
                                <label for="">Delivery Address</label>
                                <div class="border p-2"> {{ $viewdelivery->delivery_address }}</div>
                                <label for="">Delivery Method</label>
                                <div class="border p-2"> {{ $viewdelivery->delivery_method }}</div>
                                <label for="">Product Receipt</label>
                                <div class="border p-2">
                                    <img src="{{ asset('/uploads/receipt/' . $viewdelivery->product_receipt) }}"
                                        width="50" height="50" alt="">
                                </div>

                                <div class="mt-3">
                                    <label for="" clas="col-md-12">Delivery Request Status</label>
                                    <form method="post" action="{{ url('update_deliverystatus/' . $viewdelivery->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select form-control" name="status">
                                            <option {{ $viewdelivery->status == '0' ? 'selected' : '' }} value="0">
                                                Pending</option>
                                            <option {{ $viewdelivery->status == '1' ? 'selected' : '' }} value="1">
                                                In Progress</option>
                                            <option {{ $viewdelivery->status == '2' ? 'selected' : '' }} value="2">
                                                Completed</option>
                                            <option {{ $viewdelivery->status == '3' ? 'selected' : '' }} value="3">
                                                Declined</option>
                                        </select>

                                        <button type="submit" class="btn btn-primary mt-3 form-control">Update
                                            Status</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-6">
                                {{-- <h4>Grand Total : <span class="float-end">{{ $vieworder->total_price }}</span></h4> --}}
                                <div class="card-header">
                                    <h4><strong>Send Delivery Response to this Client</strong></h4>
                                </div>
                                <hr>
                                <form method="post" action="{{ url('senddeliveryresp') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($viewdeli as $viewdelis)
                                                <input type="hidden" name="client_email"
                                                    value="{{ $viewdelis->user->email }}" required>
                                            @endforeach
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Number of Pickup
                                                    Points</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="Enter the number of pickup points" name="pickup_no"
                                                    required><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Select Delivery
                                                    Package</label><br><br>
                                                <select name="delivery_package" id="" class="form-control">
                                                    <option value="Companys Packaging">Company's Packaging</option>
                                                    <option value="Customers Packaging">Customer's Packaging</option>
                                                </select><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Number of Box size</label><br><br>
                                                <input type="text" name="box_no"
                                                    placeholder="Enter the box number" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Select Box
                                                    Size</label><br><br>
                                                <select name="box_size" id="" class="form-control">
                                                    <option value="1950">Small</option>
                                                    <option value="2900">Big</option>
                                                    <option value="4300">Large</option>
                                                </select><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Number of Extra Box</label><br><br>
                                                <input type="number" name="extrabox_no"
                                                    placeholder="Enter the extra box number" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Select Extra
                                                    Box</label><br><br>
                                                <select name="extra_box" id="" class="form-control">
                                                    <option value="1000">Small(N40 per Kilomiter)</option>
                                                    <option value="1500">Big(N60 per Kilomiter)</option>
                                                    <option value="2000">Large(N100 per Kilomiter)</option>
                                                </select><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Distance
                                                    Kilometer</label><br><br>
                                                <input type="text" name="distance_km"
                                                    placeholder="Enter the distance km" class="form-control">
                                            </div>

                                            <h1>Customers Packaging</h1>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Dimensional weight</label><br><br>
                                                <input type="text" name="dimensional_w"
                                                    placeholder="Enter the Dimentional weight" class="form-control">
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Distance
                                                    Km</label><br><br>
                                                <input type="text" name="distance_km"
                                                    placeholder="Enter the distance km">
                                            </div> --}}

                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary form-control mt-3">Send Response
                                                via Email</button>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <h4><strong>Buyer Details</strong></h4>
                            <hr>
                            @foreach ($viewdeli as $viewdelis)
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $viewdelis->user->firstname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $viewdelis->user->lastname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $viewdelis->user->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $viewdelis->user->phone_number }}</div>
                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
