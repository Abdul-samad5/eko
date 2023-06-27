<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div class="card">
        <div class="card-body">
            @if ($deliveryMail['delivery package'] == 'Companys Packaging')
                <div class="col-md-6">
                    <h4><strong>Delivery Request Response Details</strong></h4>
                    <hr>
                    <label for="">Number of pickup points</label>
                    <div class="border p-2"> {{ $deliveryMail['pickup points no'] }}</div>
                    <label for="">Delivery Package:</label><br>
                    <div class="border p-2"> {{ $deliveryMail['delivery package'] }}</div>
                    <label for="">Number of Box:</label><br>
                    <div class="border p-2">{{ $deliveryMail['no of box'] }}</div>
                    <label for="">Box Size:</label><br>
                    <div class="border p-2">
                        @if ($deliveryMail['box size'] == 1950)
                           Small Box <p><strong>Price of each box is: 1950</strong></p>
                        @elseif($deliveryMail['box size'] == 2900)
                            Big Box<p><strong>Price of each box is: 2900</strong></p>
                        @elseif($deliveryMail['box size'] == 4300)
                            Large Box<p><strong>Price of each box is: 4300</strong></p>
                        @endif
                    </div>
                    <label for="">Number of Extra Box:</label><br>
                    <div class="border p-2">{{ $deliveryMail['no of extrabox'] }}</div>
                    <label for="">Extra Box is:</label>
                    <div class="border p-2">
                        @if ($deliveryMail['extra box'] == 1000)
                            Small Box<p><strong>Price of each extra Box: 1000</strong></p>
                        @elseif($deliveryMail['extra box'] == 1500)
                            Big Box <p><strong>Price of each extra Box: 1500</strong></p>
                        @elseif($deliveryMail['extra box'] == 2000)
                            Large Box <p><strong>Price of each extra Box: 2000</strong></p>
                        @endif
                    </div>
                    <label for="">Distance Kilometer</label>
                    <div class="border p-2"> {{ $deliveryMail['distance kilometer'] }}</div>
                    <label for="">Dimentional weight</label>
                    <div class="border p-2"> {{ $deliveryMail['dimentional wieght'] }}</div>
                    <label for="">Total</label>
                    <div class="border p-2"> {{ $deliveryMail['total'] }}</div>

                    {{-- <label for="">Total</label> --}}
                    <div class="border p-2"> {{ $deliveryMail['content'] }}</div>

                </div>
            @endif


            @if ($deliveryMail['delivery package'] == 'Customers Packaging')
                <div class="col-md-6">
                    <h4><strong>Delivery Request Response Details</strong></h4>
                    <hr>
                    <label for="">Number of pickup points</label>
                    <div class="border p-2"> {{ $deliveryMail['pickup points no'] }}</div>
                    <label for="">Delivery Package</label>
                    <div class="border p-2"> {{ $deliveryMail['delivery package'] }}</div>
                    <label for="">Distance Kilometer</label>
                    <div class="border p-2"> {{ $deliveryMail['distance kilometer'] }}</div>
                    <label for="">Dimentional weight</label>
                    <div class="border p-2"> {{ $deliveryMail['dimentional wieght'] }}</div>
                    <label for="">Total</label>
                    <div class="border p-2"> {{ $deliveryMail['total'] }}</div>

                     <div class="border p-2"> {{ $deliveryMail['content'] }}</div>

                </div>
            @endif
        </div>

    </div>

</body>

</html>
