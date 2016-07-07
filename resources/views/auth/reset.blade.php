@extends('auth.master')

@section('card-content')
<div class="container-fluid">
	<h1 class="title">@lang('login.resetPassword')</h1>
	<form class="form-signin form-reset" role="form" method="POST" action="{{ authurl('reset') }}">
		<div id="identity">
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

        <input type="hidden" name="token" value="{{ $token }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">@lang('login.resetButton')</button>
    </form>
</div>
@endsection
