@extends('auth.master')

@section('card-content')
        <h1 class="title">@lang('login.recoverAccess')</h1>
@if (session('status'))
        <p class="success">{{ session('status') }}</p>
        <p class="center"><img src="{{ url('/images/white-check.svg') }}" alt="Check mark" width="100px" /></p>
        <p class="nav"><a href="{{ url('/') }}">@lang('pagination.previous') Back to login screen</a></p>
@else
		<form class="form-signin form-recover" role="form" method="POST" action="@authurl('recover')">
            <div id="identity">
				<input type="email" name="email" id="inputEmail" class="form-control"
                       value="{{ old('email') }}" placeholder="@lang('login.email')" required autofocus />
            </div>@if (count($errors) > 0)

            <p class="errors">
@foreach ($errors->all() as $error)
                {{ $error }}<br />
@endforeach
            </p>
            @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">@lang('login.recoverButton')</button>

        </form>
@endif
@endsection
