@extends('auth.master')

@section('card-content')
        <h1 class="title">@lang('app.title')</h1>
        <img id="profile-img" class="profile-img-card" src="/images/profile-img-blank.png" alt="@lang('login.blankAvatarAlt')" />
        <form class="form-signin" role="form" method="POST" action="{{ authurl('login') }}">
            <div id="identity">
                <span id="reauth-username" class="reauth-username"></span>
                <input type="text" name="username" id="inputUsername" class="form-control"
                       value="{{ old('username') }}" placeholder="@lang('login.username')" required autofocus />
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="@lang('login.password')" required />
            </div>@if (count($errors) > 0)

            <p class="errors">
@foreach ($errors->all() as $error)
                {{ $error }}<br />
@endforeach
                <a href="{{ authurl('recover') }}" class="action-link">@lang('login.passwordRecovery')</a>
            </p>
            @endif

            <div id="remember" class="checkbox">
                <label><input type="checkbox" name="remember">@lang('login.remember')</label>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">@lang('login.loginButton')</button>
        </form>
        <!-- /form -->
@if (count($errors) == 0)
        <a href="{{ authurl('recover') }}" class="action-link">@lang('login.passwordRecovery')</a><br />
@endif
        <a href="{{ authurl('register') }}" class="action-link">@lang('login.registerAccount')</a>
@endsection
