<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    <link href="/css/services.css" rel="stylesheet">
    {{--<link href="/css/menu.css" rel="stylesheet">--}}

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('components.nav')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('components.footer')
            </div>
        </div>



    </div>



<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/events.js"></script>
</body>
</html>
