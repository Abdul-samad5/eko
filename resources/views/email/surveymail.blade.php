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
            <div class="col-md-6">
                <h4><strong>Survey Request Response Details</strong></h4>
                <hr>
                <label for="">Product Number</label>
                <div class="border p-2"> {{ $surveyMail['product no'] }}</div>
                <label for="">Product Name</label>
                <div class="border p-2"> {{ $surveyMail['product name'] }}</div>
                <label for="">Market name</label>
                <div class="border p-2"> {{ $surveyMail['market name'] }}</div>
                <label for="">Description</label>
                <div class="border p-2"> {{ $surveyMail['description'] }}</div>
            </div>
        </div>

    </div>

</body>

</html>
