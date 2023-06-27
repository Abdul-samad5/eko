 @php
     if (Auth::user()->role_as == '5') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     } elseif (Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

 @extends('layouts.adminheader')

 @section('title', 'Add Category')

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

                 <form method="post" action="{{ route('addcategory') }}">
                     @csrf
                     <div class="row">
                         <div class="card-body">
                         <h3>Add Category</h3>
                         <hr>
                             <div class="col-md-6 mb-3">
                                 <label for="cate_name" class="form-label">{{ __('Category Name') }}</label>
                                 <input id="cate_name" type="text"
                                     class="form-control @error('cate_name') is-invalid @enderror" name="cate_name"
                                     value="{{ old('cate_name') }}" required autocomplete="cate_name" autofocus>

                                 @error('cate_name')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror

                             </div>
                         </div>
                     </div>

                     <button type="submit" class="continue btn btn-primary mb-3 ms-3">Add Category</button>
                 </form>
             </div>
         </div>
     </body>
 @endsection
 
