<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PRF|404</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ URL::asset('template/plugins/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="{{ URL::asset('https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('https://fonts.googleapis.com/icon?family=Material+Icons')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ URL::asset('template/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ URL::asset('template/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ URL::asset('template/css/style.css')}}" rel="stylesheet">
</head>

    <body class="four-zero-four">
        <div class="four-zero-four-container">
            <div class="error-code">404</div>
            <div class="error-message">This page doesn't exist</div>
            <div class="button-place">
                <a href="{{env('MYHUB_URL')}}" class="btn btn-default btn-lg waves-effect">GO TO MYHUB</a>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="{{ URL::asset('template/plugins/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core Js -->
        <script src="{{ URL::asset('template/plugins/bootstrap/js/bootstrap.js')}}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ URL::asset('template/plugins/node-waves/waves.js')}}"></script>
    </body>

</html>