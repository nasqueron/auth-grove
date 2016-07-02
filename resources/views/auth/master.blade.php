<!DOCTYPE html>
<html>

<head>
    <title>@lang('app.title')</title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel='stylesheet' type="text/css"  integrity="sha384-604wwakM23pEysLJAhja8Lm42IIwYrJ0dEAqzFsj9pJ/P5buiujjywArgPCi8eoz" crossorigin="anonymous" />
    <link href="/css/login.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body class="sviatiHory">
    <div class="card card-container">
@yield('card-content')
    </div>
    <!-- /card-container -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js" integrity="sha384-kXQJFW5wmejHyRQjVd52J5p4vDtv3+/Q6QHO6zRPNLwY2ExsTw4zKyQHv07R+R7U" crossorigin="anonymous"></script>
    <script src="/js/login.js"></script>
</body>

</html>
