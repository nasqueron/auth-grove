<html>

<head>
    <title>Authentication grove</title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
    <link href="/css/login.css" rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="sviatiHory">
    <div class="card card-container">
        <h1 class="title">Auth Grove</h1>
        <img id="profile-img" class="profile-img-card" src="/images/profile-img-blank.png" alt="A door, as a blank avatar" />
        <form class="form-signin" method="post">
            <div id="identity">
                <span id="reauth-username" class="reauth-username"></span>
                <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form>
        <!-- /form -->
        <a href="#" class="forgot-password">
	                Password recovery options
	            </a>
    </div>
    <!-- /card-container -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
    <script src="/js/login.js"></script>
</body>

</html>