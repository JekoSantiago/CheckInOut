<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{$title}}</title>
    <link rel="icon" href="{{ URL::asset('template/favicon.ico')}}" type="image/x-icon">
    @include('layouts.components.css')
</head>
<body class="theme-white">
    <input type="hidden" name="_token" id="globalToken" value="{{csrf_token()}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="wrapper">
        @include('layouts.components.loading')
        @include('layouts.components.left-sidebar')
        <div id="content">
            <header>
                @include('layouts.components.header')
            </header>
            <main role="main">

                 @yield('content')
            </main>
            <footer class="fixed-bottom bg-dark foot">
                @include('layouts.components.footer')
            </footer>
        </div>
    </div>
    <div class="overlay"></div>
    @include('layouts.components.js')
</body>
</html>
