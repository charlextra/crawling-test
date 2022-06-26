<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Web Evolution Crawler</title>
        <link rel="stylesheet" href={{ asset('css/app.css') }}>
        <!-- font awesome  -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    </head>
    <body> 
        <x-toast-component />
        @yield('content')
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
