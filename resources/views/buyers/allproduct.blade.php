@extends('layouts.nav')
@section('content')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     @if (session('status'))
         <script>
             swal("{{ session('status') }}");
         </script>
     @endif
     
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            {{-- <h4>
                <a href="{{ url('category') }}" class="text-black text-decoration-none">
                    collections
                </a>/

                <a href="{{ url('view-category/' . $category->slug) }}" class="text-black text-decoration-none">
                    {{ $category->name }}
                </a>

            </h4> --}}
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <strong>
                    {{-- <h2 class="mb-3">{{ $allprod->category->cate_name }}</h2> --}}
                </strong>
                @foreach ($allprod as $allprods)
                    {{-- <div class="col-md-3 mb-3"> --}}
                        {{-- <div class="card" style="padding-left: 100px;"> --}}
                           <a href="{{ url('view_prod/' . $allprods->id) }}"
                            class="text-decoration-none">
                            <div class="row">
                             <div class="col-md-6 mb-3">
                                <div class="card">
                                    <img src="{{ asset('uploads/products/' . $allprods->prod_picture) }}" alt="Product Image"
                                        style="height: 500px;">
                                    <div class="card-body">
                                        <h5>{{ $allprods->prod_name }}</h5>
                                        <span class="float-start">{{ $allprods->amount }}</span>
                                        <span class="float-end">Quantity Available: {{ " " . $allprods->quantity }} </span>
                                        <span class="mt-5 float-start">Category Name: {{ $allprods->category->cate_name }}</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                           
                        </a>
                        {{-- </div> --}}

                    {{-- </div> --}}
                @endforeach

            </div>
        </div>
    </div>
@endsection
