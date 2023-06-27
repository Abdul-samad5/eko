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
                        <h4>My Surveys</h4>
                    </div>
                    @if ($survey->count() > 0)
                        <div class="card-body">
                            <table class="table table-bodered">
                                <thead>
                                    <tr>
                                        <th>No of Product surveyed</th>
                                        <th>Products Name</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Payment Mode</th>
                                        <th>Total Price</th>
                                        <th>Products Image</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($survey as $surveys)
                                        <tr>
                                            <td>{{ $surveys->product_no }}</td>
                                            <td>{{ $surveys->product_name }}</td>
                                            <td>{{ $surveys->description }}</td>
                                            <td>{{ $surveys->location }}</td>
                                            <td>{{ $surveys->payment_mode }}</td>
                                            <td>{{ $surveys->total_price }}</td>
                                            <td scope="col" class="d-flex justify-content-center"><img
                                                    src="{{ asset('/uploads/receipt/' . $surveys->survey->product_image) }}"
                                                    width="50" height="50" alt="No product image added">

                                            </td>
                                            <td>

                                                @if ($surveys->status == 0)
                                                    {{ 'pending' }}
                                                @elseif($surveys->status == 1)
                                                    {{ 'In Progress' }}
                                                @elseif($surveys->status == 2)
                                                    {{ 'completed' }}
                                                @elseif($surveys->status == 3)
                                                    {{ 'declined' }}
                                                @endif

                                            </td>
                                            
                                            {{-- <td>
                                                <a href="{{ url('view_surveyresp/' . $surveys->id) }}"
                                                    class="btn btn-primary">View</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body text-center">
                            <h2>You have not submitted any survey or You have not paid for any survey yet</h2>
                            <a href="{{ route('getlogistics') }}" class="btn btn-outline-primary float-end">Submit a
                                survey</a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
