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
                        <h4>My Delivery Request</h4>
                    </div>
                    @if ($delivery->count() > 0)
                        <div class="card-body">
                            <table class="table table-bodered">
                                <thead>
                                    <tr>
                                        <th>Products Name</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Dealer Contact</th>
                                        <th>Product Receipt</th>
                                        <th>Products Cost</th>
                                        <th>Delivery Address</th>
                                        <th>Delivery Method</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($delivery as $deliverys)
                                        <tr>
                                            <td>{{ $deliverys->product_name }}</td>
                                            <td>{{ $deliverys->description }}</td>
                                            <td>{{ $deliverys->location }}</td>
                                            <td>{{ $deliverys->dealer_contact }}</td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/receipt/' . $deliverys->product_receipt) }}"
                                                    width="50" height="50" lt="No Product Receipt">

                                            </td>
                                            <td>{{ $deliverys->product_cost == ""? 'No product cost added' : $deliverys->product_cost }}</td>
                                            <td>{{ $deliverys->delivery_address }}</td>
                                            <td>{{ $deliverys->delivery_method }}</td>
                                            <td>

                                                @if ($deliverys->status == 0)
                                                    {{ 'pending' }}
                                                @elseif($deliverys->status == 1)
                                                    {{ 'In Progress' }}
                                                @elseif($deliverys->status == 2)
                                                    {{ 'completed' }}
                                                @elseif($deliverys->status == 3)
                                                    {{ 'declined' }}
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body text-center">
                            <h2>You have not submitted any Delivery Request</h2>
                            <a href="{{ route('getdelivery') }}" class="btn btn-outline-primary float-end">Submit a
                                Delivery Request</a>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection
