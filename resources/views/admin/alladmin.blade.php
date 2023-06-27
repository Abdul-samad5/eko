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


     <div class="container-lg mt-7">
         <div class="row">
             <div class="col-12 w-100 d-flex justify-content-between">
                 {{-- <p class="page-title">Product</p> --}}
                 <button class="btn btn-primary p-2 mb-3 mt-3">
                     <i class="fa fa-plus"></i> <a href="{{ route('adminadd') }}" class="text-white text-decoration-none">Add
                         Admin</a>
                 </button>
             </div>
         </div>
     </div>

     <body>
         <div class="row">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-body">
                         <h3>All Admins</h3>
                         <hr>
                         @if ($admin->count() > 0)
                             <table class="table table-hover">
                                 <thead>
                                     <tr class="my-4">
                                         <th scope="col">Role As</th>
                                         <th scope="col">First Name</th>
                                         <th scope="col">Last Name</th>
                                         <th scope="col">Email</th>
                                         <th scope="col">Phone</th>
                                         {{-- <th scope="col">Total Amount (NGN)</th> --}}
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     @foreach ($admin as $admins)
                                         <tr class="my-4 dash-card">
                                             <td scope="col">{{ $admins->role_as == 2 ? 'Super Admin' : 'Admin' }}</td>
                                             <td scope="col">{{ $admins->firstname }}</td>
                                             <td scope="col">{{ $admins->lastname }}</td>
                                             <td scope="col">{{ $admins->email }}</td>
                                             <td scope="col">{{ $admins->phone_number }}</td>
                                             <td>
                                                 <form action="{{ url('deleteadmin/' . $admins->id) }}" method="POST">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit" class="btn btn-danger">Delete</button>

                                                 </form>

                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         @else
                             <p>You have not Added any Admin yet!</p>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </body>
 @endsection
