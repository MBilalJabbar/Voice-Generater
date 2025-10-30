<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    {{-- <a href="" class="header-logo">
        <img class="mb-2 mt-3" src="{{ asset('assets/images/Group 1000007299@3x.png') }}" alt="Task Image"
                 style="width: 120px; height: 80px; object-fit: contain;">
    </a> --}}
    <h1>👋 Hello !</h1>
    <h3>{{ $user->user_name }}</h3>
    <p> ({{ $user->email }})</p>
    <p> just logged in on {{ now()->format('M d, Y H:i:s') }}.</p>
    <p>If this wasn't you, please take appropriate action to secure your account.</p>
    <p>Best regards,<br>Your Application Team</p>
</body>

</html>
