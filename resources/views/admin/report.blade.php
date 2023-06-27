 @php
     if (Auth::user()->role_as == '5') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     } elseif (Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

 @extends('layouts.adminheader')

 @section('title', 'Generate Reports')

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

                 <form method="post" action="{{ route('generatereports') }}">
                     @csrf
                     <div class="row">
                         <div class="card-body">
                         <h3>Generate Reports</h3>
                         <hr>

                         <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">{{ __('Select Category') }}</label>
                           <select name="category" id="" class="form-control">
                            <option value="orders">Orders History</option>
                            <option value="delivery">Delivery Request History</option>
                            <option value="survey">Survey Request History</option>
                            <option value="product">Products History</option>
                           </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                             <div class="col-md-6 mb-3">
                                 <label for="date" class="form-label">{{ __('Add Date') }}</label>
                                 <input id="date" type="date"
                                     class="form-control @error('date') is-invalid @enderror" name="date"
                                     value="{{ old('date') }}" required autocomplete="date" autofocus>

                                 @error('date')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror

                             </div>
                         </div>
                     </div>

                     <button type="submit" class="continue btn btn-primary mb-3 ms-3">Generates Report</button>
                 </form>
             </div>
            {{-- <button type="submit" class="continue btn btn-primary mb-3 ms-3"><a href="{{ url('generatereports') }}">Generates Excel File</a></button> --}}


         </div>
     </body>
 @endsection
 
