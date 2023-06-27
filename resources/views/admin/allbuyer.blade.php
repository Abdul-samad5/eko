 @php
    if (Auth::user()->role_as == '5') {
        return redirect('/')->with('status', 'Access Denied! as you are not as admin');
    }
@endphp

@extends('layouts.adminheader')

@section('title', 'Buyers')

@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

 <div class="container-lg">

     <!-- Recent orders-->
     <div class="row">
         <div class="col-md-8">
             <div class="card mt-5">
                 <div class="card-body">
                     <h3>All Buyers</h3>
                     <hr>
                     @if ( $buyer->count() > 0)
                         <table class="table table-hover">
                             <thead class="text-center">
                                 <tr class="my-4">
                                     <th scope="col">Name</th>
                                     <th scope="col">Email</th>
                                     <th scope="col">Phone</th>
                                 </tr>
                             </thead>

                             <tbody class="text-center">
                                 {{-- @if ($prods->count > 0) --}}
                                 @foreach ($buyer as $buyers)
                                     <tr class="my-4 dash-card">
                                         <td scope="col">{{ $buyers->firstname . " " . $buyers->lastname }}</td>
                                         <td scope="col">{{ $buyers->email }}</td>
                                         <td scope="col">{{ $buyers->phone_number }}</td>
                                     </tr>
                                 @endforeach

                             </tbody>
                         </table>
                     @else
                         <p>No buyer has registered yet</p>
                     @endif

                 </div>

             </div>
         </div>

     </div>
     <!-- Recent orders End-->

 </div>
 @endsection
