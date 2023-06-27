@extends(((Auth::user()->role_as == 5) ? 'layouts.nav' : 'layouts.adminheader'))
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                    @if (session('status'))
                        <script>
                            swal("{{ session('status') }}");
                        </script>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mt-4 ms-4">Update User</h3>
                                <hr>
                                <form action="{{ url('updateuser/' . $edit->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">First
                                                    Name</label><br><br>
                                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                                    name="firstname" value="{{ $edit->firstname }}"><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1" class="form-label">Last
                                                    Name</label><br><br>
                                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                                    name="lastname" value="{{ $edit->lastname }}"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Email</label><br><br>
                                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                                    name="email" value="{{ $edit->email }}"><br><br>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">Phone</label><br><br>
                                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                                    name="phone_number" value="{{ $edit->phone_number }}"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4><strong>Change Password</strong></h4>
                                <hr>
                                <form action="{{ url('updatepassword/' . $edit->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="exampleFormControlInput1" class="form-label">Old
                                                    Password</label><br><br>
                                                <input type="password" class="form-control" id="exampleFormControlInput1"
                                                    name="old_password"><br><br>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1" class="form-label">New
                                                    Password</label><br><br>
                                                <input type="password" class="form-control" id="exampleFormControlInput1"
                                                    name="new_password"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="exampleFormControlTextarea1" class="form-label">Confirm
                                                    New Password</label><br><br>
                                                <input type="password" class="form-control" id="exampleFormControlInput1"
                                                    name="confirm_password"><br><br>
                                            </div>

                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Change
                                                    Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
