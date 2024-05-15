<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Managment</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5">
                <img src="{{ Vite::asset('resources/sidebar/images/login.png') }}" alt="auth" width="100%">
            </div>
            <div class="col-md-6 ">
                @yield('content')
            </div>
        </div>
    </div>

</body>

</html>
