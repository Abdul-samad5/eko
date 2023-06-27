@php
    if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    @if (session('status'))
                        <script>
                            swal("{{ session('status') }}");
                        </script>
                    @endif
                    <div class="card-body">
                        {{-- @if ($allorders->count > 0) --}}
                            <table class="table table-bodered">
                                <thead>
                                    <tr>
                                        <th>Client Email</th>
                                        <th>Number of products surveyed</th>
                                        <th>Product Name</th>
                                        <th>Market Name</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ( $surveyemail as  $sentemails)
                                        <tr>
                                            <td>{{ $sentemails->client_email }}</td>
                                            <td>{{ $sentemails->product_no }}</td>
                                            <td>{{ $sentemails->product_name }}</td>
                                            <td>{{ $sentemails->market_name }}</td>
                                            <td>{{ $sentemails->description }}</td>
                                            <td>{{ date('d-m-y', strtotime($sentemails->create_at)) }}</td>
                                            {{-- <td>
                                                <a href="{{ url('vieworder/' . $orders->id) }}"
                                                    class="btn btn-primary">View</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        {{-- @else
                            <p>No Order has been placed</p>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
