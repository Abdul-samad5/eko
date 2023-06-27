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
                        <h4>My Orders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bodered">
                            <thead>
                                <tr>
                                    <th>Tracking No</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($order as $orders)
                                    <tr>
                                        <td>{{ $orders->tracking_no }}</td>
                                        <td>{{ $orders->total_price }}</td>
                                        <td>{{ $orders->status == '0' ? 'Pending' : 'Completed' }}</td>
                                        <td>
                                            <a href="{{ url('view_order/' . $orders->id) }}"
                                                class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
