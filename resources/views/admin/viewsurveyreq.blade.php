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
                        <h4 class="text-white"> Survey Request View
                            <a href="{{ url('viewsurveyreq') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Survey Request Details</strong></h4>
                                <hr>
                                <label for="">Product Number</label>
                                <div class="border p-2"> {{ $viewsurvey->product_no }}</div>
                                <label for="">Product Name</label>
                                <div class="border p-2"> {{ $viewsurvey->product_name }}</div>
                                <label for="">Description</label>
                                <div class="border p-2"> {{ $viewsurvey->description }}</div>
                                <label for="">Location</label>
                                <div class="border p-2"> {{ $viewsurvey->location }}</div>
                                <label for="">Payment Mode</label>
                                <div class="border p-2"> {{ $viewsurvey->payment_mode }}</div>
                                <label for="">Payment Id</label>
                                <div class="border p-2">{{ $viewsurvey->product_id }}</div>
                                <label for="">Total Price</label>
                                <div class="border p-2"> {{ $viewsurvey->total_price }}</div>
                                <label for="">Product Image</label>
                                <div class="border p-2">
                                    <img src="{{ asset('/uploads/receipt/' . $viewsurvey->survey->product_image) }}"
                                        width="50" height="50" alt="">
                                </div>

                                <div class="mt-3">
                                    <label for="" clas="col-md-12">Survey Request Status</label>
                                    <form method="post" action="{{ url('update_surveystatus/' . $viewsurvey->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select form-control" name="status">
                                            <option {{ $viewsurvey->status == '0' ? 'selected' : '' }} value="0">
                                                Pending</option>
                                            <option {{ $viewsurvey->status == '1' ? 'selected' : '' }} value="1">
                                                In Progress</option>
                                            <option {{ $viewsurvey->status == '2' ? 'selected' : '' }} value="2">
                                                Completed</option>
                                            <option {{ $viewsurvey->status == '3' ? 'selected' : '' }} value="3">
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
                                    <h4><strong>Send Response to this Client</strong></h4>
                                </div>

                                <hr>
                                <form method="post" action="{{ url('sendsurveyresp') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($viewsurv as $viewsurvs)
                                                <input type="hidden" name="client_email"
                                                    value="{{ $viewsurvs->survey->user->email }}" required>
                                            @endforeach
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Number of Products
                                                    Surveyed</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="Enter the no of products you surveyed" name="product_no"
                                                    required><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Names of Products
                                                    Surveyed</label><br><br>
                                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="Enter the names of products you surveyed"
                                                    name="product_name" required><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Select Market where
                                                    you
                                                    searched for the products</label><br><br>
                                                <select name="market_name" id="">
                                                    @foreach ($market as $markets)
                                                        <option value="{{ $markets->id }}">{{ $markets->name }}</option>
                                                    @endforeach

                                                </select><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Give a break down
                                                    of what you found out abouts the product and where to the client can
                                                    find it.</label><br><br>
                                                <textarea name="description" id="" class="form-control"></textarea>
                                            </div>


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
                            @foreach ($viewsurv as $viewsurvs)
                                <label for="">First Name</label>
                                <div class="border p-2"> {{ $viewsurvs->survey->user->firstname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $viewsurvs->survey->user->lastname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $viewsurvs->survey->user->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $viewsurvs->survey->user->phone_number }}</div>
                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
