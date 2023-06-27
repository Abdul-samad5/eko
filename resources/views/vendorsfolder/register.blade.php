@extends('layouts.head')

@section('title', 'Vendor Register')

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
        <div class="col-md-12">
            <div class="card w-50">
                <form method="post" action="{{ route('vendreg') }}">
                    @csrf
                    <div class="row">
                        <div class="card-body w-75">
                            <div class="col-md-6 mb-3">
                                <label for="firstname"
                                    class="form-label">{{ __('First Name') }}</label>

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
                                <label for="lastname"
                                    class="form-label">{{ __('Last Name') }}</label>
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
                                <label for="email"
                                    class=" col-form-label">{{ __('Email') }}</label>
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
                                <label for="password" class="form-label">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}" required autocomplete="password" autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="confirm_password" type="password"
                                    class="form-control @error('confirm_password') is-invalid @enderror"
                                    name="confirm_password" value="{{ old('confirm_password') }}" required
                                    autocomplete="confirm_password" autofocus>

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary form-control mb-3">Register</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </body>

@endsection
