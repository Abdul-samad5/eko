 @php
     if (Auth::user()->role_as == '5') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     } elseif (Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

 @extends('layouts.adminheader')

 @section('title', 'Invite Vendors')

 @section('content')
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     @if (session('status'))
         <script>
             swal("{{ session('status') }}");
         </script>
     @endif

     <body>
         <div class="col-md-8">
             <div class="card mt-3">

                 <form method="post" action="{{ route('addvendor') }}">
                     @csrf
                     <div class="row">
                         <div class="card-body">
                         <h3>Invite Vendors via email</h3>
                         <hr>
                             <div class="col-md-6 mb-3">
                                 <label for="email" class="form-label">{{ __('Email') }}</label>
                                 <input id="email" type="email"
                                     class="form-control @error('email') is-invalid @enderror" name="email"
                                     value="{{ old('email') }}" required autocomplete="email" autofocus>

                                 @error('email')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror

                             </div>
                         </div>
                     </div>

                     <button type="submit" class="continue btn btn-primary mb-3 ms-3">Invite Vendor</button>
                 </form>
             </div>
         </div>
     </body>
 @endsection
 
