@extends('auth.master')

@section('card-content')
        <h1 class="title">@lang('app.title')</h1>
        <p>@lang('auth.fatal-error')</p>
        <p class="errors">
@foreach ($errors->all() as $error)
            {{ $error }}<br />
@endforeach
        </p>
        <a href="{{ authurl('login') }}" class="action-link">@lang('login.goto-login')</a>
@endsection
