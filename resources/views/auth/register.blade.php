@extends('auth.master')

@section('card-content')
        <h1 class="title">@lang('login.registerAccount')</h1>
		<form class="form-signin form-register" role="form" method="POST" action="@authurl('register')">
            <div id="identity">
                <span id="reauth-username" class="reauth-username"></span>
                <label for="inputUsername">@lang('login.username')</label>
                <input type="text" name="username" id="inputUsername" class="form-control"
                       value="{{ old('username') }}" placeholder="@lang('login.usernamePlaceholder')" required autofocus />
                <label for="inputFullname">@lang('login.fullname')</label>
                <input type="text" name="fullname" id="inputFullname" class="form-control"
                       value="{{ old('fullname') }}" placeholder="@lang('login.fullnamePlaceholder')" autofocus />
                <label for="inputEmail">@lang('login.email')</label>
                <input type="email" name="email" id="inputEmail" class="form-control"
                       value="{{ old('email') }}" placeholder="@lang('login.emailPlaceholder')" required autofocus />
                <label for="inputPassword">@lang('login.passwordBoth')</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="@lang('login.passwordPlaceholder')" required />
                <input type="password" name="password_confirmation" id="inputPasswordConfirm" class="form-control" placeholder="@lang('login.passwordConfirmPlaceholder')" required />
            </div>@if (count($errors) > 0)

            <p class="errors">
@foreach ($errors->all() as $error)
                {{ $error }}<br />
@endforeach
            </p>
            @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">@lang('login.registerButton')</button>
        </form>
        <!-- /form -->
@endsection
