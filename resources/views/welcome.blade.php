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
        <img id="profile-img" class="profile-img-card" src="/images/profile-img-blank.png" alt="@lang('login.blankAvatarAlt')" />
        <form class="form-signin" method="post">
            <div id="identity">
                <span id="reauth-username" class="reauth-username"></span>
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="@lang('login.username')" required autofocus>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="@lang('login.password')" required>
            </div>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> @lang('login.remember')
                </label>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">@lang('login.loginButton')</button>
        </form>
        <!-- /form -->
        <a href="{{ url('/auth/recover') }}" class="forgot-password">@lang('login.passwordRecovery')</a>
    </div>
    <!-- /card-container -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
    <script src="/js/login.js"></script>
</body>

</html>
