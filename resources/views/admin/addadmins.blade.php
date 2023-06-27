@php
    if (Auth::user()->role_as == '5') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')

@section('title', 'Add Admin')

@section('content')
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
   <div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     @if (session('status'))
         <script>
             swal("{{ session('status') }}");
         </script>
     @endif
    </div>

    <body>
        <div class="col-md-8">
            <div class="card mt-5">
                <form method="post" action="{{ route('addadmin') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="firstname" class="form-label">{{ __('First Name') }}</label>
                                <input id="firstname" type="text"
                                    class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                    value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="form-label">{{ __('Last Name') }}</label>


                                <input id="lastname" type="text"
                                    class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                    value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>

                                <input id="phone_number" type="number"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">{{ __('Assign Role') }}</label>
                                <select name="role" id="" class="form-control">
                                    @foreach ($role as $roles)
                                        <option value="{{ $roles->role_id }}">{{ $roles->name }}</option>
                                    @endforeach

                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="continue btn btn-primary mb-3 ms-3">Add Admin</button>
                </form>
            </div>
        </div>

    </body>

@endsection
