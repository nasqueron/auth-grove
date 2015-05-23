<html>

<head>
    <title>@lang('app.title')</title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
    <link href="/css/login.css" rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="sviatiHory">
    <div class="card card-container">
        <h1 class="title">@lang('app.title')</h1>
        @yield('card-content')
    </div>
    <!-- /card-container -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
    <script src="/js/login.js"></script>
</body>

</html>
