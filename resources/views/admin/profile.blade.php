
@extends(((Auth::user()->role_as == 5) ? 'layouts.nav' : 'layouts.adminheader'))
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4><strong>User Details</strong></h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border p-2"> {{  $user->firstname }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2"> {{ $user->lastname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2"> {{ $user->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2"> {{ $user->phone_number }}</div>

                                <button type="submit" class="btn btn-primary mt-3 form-control"><a class="text-decoration-none text-light" href="{{ url('edituser/'. $user->id) }}">Edit User Details</a></button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
