@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">{{ trans('auth/dialog.text.email-password') }}</p>


    <form method="POST" action="{!! route('reset_passwordPost') !!}">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group has-feedback">
            <input type="email" id="email" name="email" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.email') }}" required autofocus/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <input type="password" id="password" name="password" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.password') }}" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.password') }}" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth/dialog.button.reset-password') }}</button>
            </div><!-- /.col -->
        </div>

    </form>

    {!! link_to_route('login', trans('auth/dialog.button.sign-in'), [], ['class' => "text-center"]) !!}<br>
    @if (Setting::get('app.allow_registration'))
        {!! link_to_route('register', trans('auth/dialog.button.register-membership'), [], ['class' => "text-center"]) !!}
    @endif

@endsection