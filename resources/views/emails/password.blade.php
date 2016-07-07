@extends('emails.master')

@section('mail-content')
@lang('emails.reset-password-intro')


@lang('emails.reset-password-login')

{{ $user->username }}

@lang('emails.reset-password-callforaction')

{{ authurl("reset/$token") }}

@lang('emails.reset-password-origin')

{{ \Keruald\get_remote_addr() }}
@endsection
