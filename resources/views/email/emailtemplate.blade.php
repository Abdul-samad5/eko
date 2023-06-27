<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>All Admin</title> --}}
</head>

<body>
    <div class="col-12">
    <h1>YOU ARE INVITED TO JOIN EKO-MARKET AS A VENDOR, KINDLY FIND YOUR LOGIN DETAILS BELOW</h1>
        <p>{{ $mailContent['content'] }}</p>
        <p>Email: {{ $mailContent['email'] }}</p>
        <p>Password:  {{ $mailContent['password'] }}</p>
    </div>

</body>

</html>
