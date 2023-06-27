@php
    if (Auth::user()->role_as == '5') {
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
                    <div class="card-header bg-primary">
                        <h4>New Orders
                            <a href="{{ route('orderhistory') }}" class="btn btn-warning float-end">Order History</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- @if ($allorders->count > 0) --}}
                            <table class="table table-bodered">
                                <thead>
                                    <tr>
                                        <th>Order Date</th>
                                        <th>Tracking No</th>
                                        <th>Total Price</th>
                                        <th>Payment mode</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($allorders as $orders)
                                        <tr>
                                            <td>{{ date('d-m-y', strtotime($orders->create_at)) }}</td>
                                            <td>{{ $orders->tracking_no }}</td>
                                            <td>{{ $orders->total_price }}</td>
                                            <td>{{ $orders->payment_mode }}</td>
                                            <td>{{ $orders->status == '0' ? 'Pending' : 'Completed' }}</td>
                                            <td>
                                                <a href="{{ url('vieworder/' . $orders->id) }}"
                                                    class="btn btn-primary">View</a>
                                            </td>
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
