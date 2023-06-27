 @php
     if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

 @extends('layouts.adminheader')

 @section('title', 'All Categories')

 @section('content')
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     @if (session('status'))
         <script>
             swal("{{ session('status') }}");
         </script>
     @endif


     <div class="container-lg mt-7">
         <div class="row">
             <div class="col-12 w-100 d-flex justify-content-between">
                 {{-- <p class="page-title">Product</p> --}}
                 <button class="btn btn-primary p-2 mb-3 mt-3">
                     <i class="fa fa-plus"></i> <a href="{{ route('category') }}" class="text-white text-decoration-none">Add
                         Category</a>
                 </button>
             </div>
         </div>
     </div>

     <body>

         <div class="row">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-body">
                         <h3>All Categories</h3>
                         <hr>
                         @if ($view->count() > 0)
                             <table class="table table-hover">
                                 <thead class="text-center">
                                     <tr class="my-4">
                                         <th scope="col">Category Name</th>
                                         <th scope="col">Date</th>
                                     </tr>
                                 </thead>

                                 <tbody class="text-center">
                                     @foreach ($view as $views)
                                         <tr class="my-4 dash-card">
                                             <td scope="col">{{ $views->cate_name }}</td>
                                             <td scope="col">{{ date('d-m-y', strtotime($views->create_at)) }}</td>

                                         </tr>
                                     @endforeach


                                 </tbody>
                             </table>
                         @else
                             <p>No Category Yet!</p>
                         @endif
                     </div>
                 </div>

             </div>

         </div>
     </body>

 @endsection
