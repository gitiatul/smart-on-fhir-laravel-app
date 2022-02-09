<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />

    <!-- Custom Style -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    @if (auth()->user()->is_admin == 1)
                        <a href="{{ url('/admin/home') }}" class="text-gray-700 dark:text-gray-500 underline">
                            <i class="fa fa-home fa-fw"></i> Home
                        </a>
                    @endif
                    @if (auth()->user()->is_admin != 1)
                        <a href="{{ url('/home') }}" class="text-gray-700 dark:text-gray-500 underline">
                            <i class="fa fa-home fa-fw"></i> Home
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-500 underline">
                        <i class="fa fa-sign-in fa-fw"></i> {{ __('Login') }}
                    </a>
                @endauth
            </div>
        @endif
    </div>
    <div class="container">
        <img src="{{ asset('img/MedEx1.png') }}" class="center-block " style="width:30%"
            alt="{{ config('app.name', 'Laravel') }}" />
        <div>
</body>

</html>
