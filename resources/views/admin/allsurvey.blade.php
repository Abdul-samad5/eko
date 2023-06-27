@php
     if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

@extends('layouts.adminheader')

@section('title', 'New survey request')

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
                        <h4>New Survey Request
                            <a href="{{ url('surveyhistory') }}" class="btn btn-warning float-end">Survey Request History</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- <h3>New Survey Request</h3> --}}
                        {{-- <hr> --}}
                        @if ($viewsurvey->count() > 0)
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr class="my-4">
                                        <th scope="col">Number of Products to be surveyed</th>
                                        <th scope="col">Products Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Payment Mode</th>
                                        <th scope="col">Payment Id</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Products Image</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    {{-- @if ($prods->count > 0) --}}
                                    @foreach ( $viewsurvey as $viewsurveys)
                                        <tr class="my-4 dash-card">
                                            <td scope="col">{{ $viewsurveys->product_no }}</td>
                                            <td scope="col">{{ $viewsurveys->product_name }}</td>
                                            <td scope="col">{{ $viewsurveys->description }}</td>
                                            <td scope="col">{{ $viewsurveys->location }}</td>
                                            <td scope="col">{{ $viewsurveys->payment_mode }}</td>
                                            <td scope="col">{{ $viewsurveys->payment_id }}</td>
                                            <td scope="col">{{ $viewsurveys->total_price }}</td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/receipt/' . $viewsurveys->survey->product_image) }}"
                                                    width="50" height="50" lt=""></td>
                                            <td>

                                                @if ($viewsurveys->status == 0)
                                                    {{ 'pending' }}
                                                @elseif($viewsurveys->status == 1)
                                                    {{ 'In Progress' }}
                                                @elseif($viewsurveys->status == 2)
                                                    {{ 'completed' }}
                                                @elseif($viewsurveys->status == 3)
                                                    {{ 'declined' }}
                                                @endif

                                            </td>
                                            <td scope="col" class="justify-content-center">
                                                <a href="{{ url('viewsurvey/' . $viewsurveys->id) }}" class="btn btn-success">View</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p>No survey request yet!</p>
                        @endif

                    </div>

                </div>
            </div>

        </div>
        <!-- Recent orders End-->

    </div>
@endsection
