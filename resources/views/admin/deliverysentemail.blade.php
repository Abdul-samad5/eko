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
                                    <th>Sender Email</th>
                                    <th>Client Email</th>
                                    <th>Number of pick up points</th>
                                    <th>Delivery package</th>
                                    <th>Number of Box</th>
                                    <th>Box Size</th>
                                    <th>Number of Extra Box</th>
                                    <th>Extra Box</th>
                                    <th>Distance Kilometer</th>
                                    <th>Dimentional Weight</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sentemail as $sentemails)
                                    <tr>
                                        <td>{{ $sentemails->user->email }}</td>
                                        <td>{{ $sentemails->client_email }}</td>
                                        <td>{{ $sentemails->pickup_no }}</td>
                                        <td>{{ $sentemails->delivery_package }}</td>
                                        <td>{{ $sentemails->box_no }}</td>
                                        <td>{{ $sentemails->box_size }}</td>
                                        <td>{{ $sentemails->extrabox_no }}</td>
                                        <td>{{ $sentemails->extra_box }}</td>
                                        <td>{{ $sentemails->distance_km }}</td>
                                        <td>{{ $sentemails->dimensional_w }}</td>
                                        <td>{{ $sentemails->total_price }}</td>
                                        <td>
                                            @if ($sentemails->status == 1)
                                                <button class="btn btn-success">Paid</button>
                                            @else
                                                <button class="btn btn-danger">Not Paid</button>
                                            @endif

                                        </td>
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
