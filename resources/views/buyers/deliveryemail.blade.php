@extends('layouts.nav')
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
                        {{-- @if ($listdeliveryemail->count > 0) --}}
                        <table class="table table-bodered">
                            <thead>
                                <tr>
                                    <th>Number of pick up points</th>
                                    <th>Delivery package</th>
                                    <th>Number of Box</th>
                                    <th>Box Size</th>
                                    <th>Number of Extra Box</th>
                                    <th>Extra Box</th>
                                    <th>Distance Kilometer</th>
                                    <th>Dimentional Weight</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($listdeliveryemail as $listdeliveryemails)
                                    <tr>
                                        <td>{{ $listdeliveryemails->pickup_no }}</td>
                                        <td>{{ $listdeliveryemails->delivery_package }}</td>
                                        <td>{{ $listdeliveryemails->box_no }}</td>
                                        <td>{{ $listdeliveryemails->box_size }}</td>
                                        <td>{{ $listdeliveryemails->extrabox_no }}</td>
                                        <td>{{ $listdeliveryemails->extra_box }}</td>
                                        <td>{{ $listdeliveryemails->distance_km }}</td>
                                        <td>{{ $listdeliveryemails->dimensional_w }}</td>
                                        <td>{{ $listdeliveryemails->total_price }}</td>
                                        <td>{{ date('d-m-y', strtotime($listdeliveryemails->create_at)) }}</td>
                                        <td>
                                            @if ($listdeliveryemails->status == 1)
                                                <button class="btn btn-success">Paid</button>
                                            @else
                                                <a href="{{ url('viewreceivedmail/' . $listdeliveryemails->id) }}"
                                                    class="btn btn-primary">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- @else
                            <p>Admin is yet to reply your delivery Request</p>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
