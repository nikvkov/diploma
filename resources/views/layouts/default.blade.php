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
    <link href="/css/my-account.css" rel="stylesheet">
    <link href="/css/loader.css" rel="stylesheet">
    <link href="/css/statistic.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{--<link rel="stylesheet" href="http://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />--}}
    {{--<link type="text/css" rel="StyleSheet" href="http://bootstraptema.ru/plugins/2016/shieldui/style.css" />--}}
    {{--<script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>--}}


    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
    {{--<link href="/css/menu.css" rel="stylesheet">--}}
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">

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
    <script src="/js/my-account.js"></script>

</body>
</html>
