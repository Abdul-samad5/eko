@extends('layouts.nav')
@section('content')
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/shopping1.png') }}" class="d-block w-100" style="height: 600px;"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/shopping3.jpg') }}" class="d-block w-100" style="height: 600px;"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/shopping2.jpg') }}" class="d-block w-100" style="height: 600px;"
                    alt="...">
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    <div class="py-5">
        <div class="container">
            <div class="row">
                <strong>
                    <h2 class="mb-3">Trending Products</h2>
                </strong>
                <div class="owl-carousel owl-theme">
                    @foreach ($products as $product)
                        <a href="{{ url('view_prod/' . $product->id) }}"
                            class="text-decoration-none">
                            <div class="item">
                                <div class="card">
                                    <img src="{{ asset('uploads/products/' . $product->prod_picture) }}" alt="Product Image"
                                        style="height: 500px;">
                                    <div class="card-body">
                                        <h5>{{ $product->prod_name }}</h5>
                                        <span class="float-start">{{ $product->amount }}</span>
                                        <span class="float-end">Quantity Available: {{ " " . $product->quantity }} </span>
                                        <span class="mt-5 float-start">Category Name: {{ $product->category->cate_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="py-5">
        <div class="container">
            <div class="row">
                <strong>
                    <h2 class="mb-3">Trending Categories</h2>
                </strong>
                <div class="owl-carousel owl-theme">
                    @foreach ($catrend as $catrends)
                        <a href="{{ url('view-category/' . $catrends->slug) }}" class="text-decoration-none">
                            <div class="item">
                                <div class="card">
                                    <img src="{{ asset('img/category/' . $catrends->image) }}" alt="Product Image"
                                        style="height: 500px;">
                                    <div class="card-body">
                                        <h5>{{ $catrends->name }}</h5>
                                        <p class="float-start">{{ $catrends->description }}</p>
                                        <span class="float-end"> <s>{{ $trends->original_price }} </s></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach


                </div>
            </div>
        </div>
    </div> --}}
@endsection


@section('script')
    {{-- <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script> --}}
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        });
    </script>

     
@endsection
