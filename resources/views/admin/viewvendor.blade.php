 @php
     if (Auth::user()->role_as == '5' || Auth::user()->role_as == '4') {
         return redirect('/')->with('status', 'Access Denied! as you are not as admin');
     }
 @endphp

 @extends('layouts.adminheader')

 @section('title', 'All Vendors')

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
                     <i class="fa fa-plus"></i> <a href="{{ route('vendor') }}" class="text-white text-decoration-none">Invite
                         Vendor</a>
                 </button>
             </div>
         </div>
     </div>

     <body>

         <div class="row">
             <div class="col-md-8">
                 <div class="card">
                     <div class="card-body">
                         <h3>All Vendors</h3>
                         <hr>
                         @if ($vendor->count() > 0)
                             <table class="table table-hover">
                                 <thead class="text-center">
                                     <tr class="my-4">
                                         <th scope="col">Name</th>
                                         <th scope="col">Email</th>
                                         <th scope="col">Phone</th>
                                         <th scope="col">Referral Link</th>
                                         <th scope="col">Status</th>
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>

                                 <tbody class="text-center">
                                     @foreach ($vendor as $vendors)
                                         <tr class="my-4 dash-card">
                                             <td scope="col">{{ $vendors->firstname . ' ' . $vendors->lastname }}</td>
                                             <td scope="col">{{ $vendors->email }}</td>
                                             <td scope="col">{{ $vendors->phone_number }}</td>
                                             <td scope="col">
                                                 {{ $vendors->referal_link == '' ? 'No Referral link' : $vendors->referal_link }}
                                             </td>
                                             <td scope="col">
                                                 @if ($vendors->status == 0)
                                                     <form action="{{ url('approve/' . $vendors->id) }}" method="POST">
                                                         @csrf
                                                         @method('PUT')
                                                         <button type="submit" class="btn btn-danger">Not Approve</button>

                                                     </form>
                                                 @else
                                                      <button type="submit" class="btn btn-success">Approved</button>
                                                 @endif

                                             </td>

                                              <td scope="col">
                                                 @if ($vendors->status == 1)
                                                     <form action="{{ url('disapprove/' . $vendors->id) }}" method="POST">
                                                         @csrf
                                                         @method('PUT')
                                                         <button type="submit" class="btn btn-danger">Disapprove</button>

                                                     </form>
                                                 @else
                                                      {{-- <button type="submit" class="btn btn-success">Approved</button> --}}
                                                 @endif

                                             </td>

                                         </tr>
                                     @endforeach


                                 </tbody>
                             </table>
                         @else
                             <p>You Dont have a vendor yet, you can invite a vendor if you want!</p>
                         @endif
                     </div>
                 </div>

             </div>

         </div>
     </body>

 @endsection
