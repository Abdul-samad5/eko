@extends('layouts.nav')
@section('content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     @if (session('status'))
         <script>
             swal("{{ session('status') }}");
         </script>
     @endif

    {{-- <div>
        @if (session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}

            </div>
        @endif
    </div> --}}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h4>
                {{-- <a href="{{ url('category') }}" class="text-black text-decoration-none">
                    collections
                </a>/ --}}

                <span class="text-black text-decoration-none">
                    {{ $showprod->category->cate_name }}
                </span>/

                <span class="text-black text-decoration-none">
                    {{ $showprod->prod_name }}
                </span>
            </h4>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('uploads/products/' . $showprod->prod_picture) }}" alt="" class="w-100">

                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $showprod->prod_name }}
                            {{-- <label style="font-size:16px;"
                                class="float-end badge bg-danger trending_tag">{{ $prods->trending == '1' ? 'Trending' : '' }}</label> --}}
                        </h2>
                        <hr>
                        <label class="me-3">Amount: {{ $showprod->amount }} </label>
                        <label class="fw-bold">Quantity Available: {{ $showprod->quantity }} </label>

                        <p class="mt-3">
                            {{ $showprod->descriptions }}
                        </p>
                        <hr>

                        @if ($showprod->quantity > 0)
                            <label class="badge bg-success">In Stock</label>
                        @else
                            <label class="badge bg-danger">Out of Stock</label>
                        @endif

                        <div class="row nt-3">
                            <form action="{{ url('addcart/' . $showprod->id) }}" method="POST">
                                @csrf
                                <div class="col-md-2">
                                    <input type="hidden" value="{{ $showprod->id }}" name="prod_id" class="prod_id">
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        {{-- <span class="input-group-text decrement-btn">-</span> --}}
                                        <input type="number" name="quantity" value="1" min="1"
                                            class="form-control qty-input" style="width: 100px;">
                                        {{-- <span class="input-group-text increment-btn">+</span> --}}
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <br />
                                    @if ($showprod->quantity > 0)
                                        <input type="submit" class="btn btn-primary float-start me-3" value="Add cart">
                                    @else
                                        <span class="py-3 mb-4 shadow-sm bg-warning border-top">This product is currently
                                            out of stock</span>
                                    @endif

                                </div>

                            </form>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h3>Description</h3>
                            <p class="mt-3">
                                {{ $showprod->descriptions }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
@endsection
