@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">{{ trans('auth/dialog.text.reset') }}</p>
        <form class="form-signin" method="POST" action="{{ route('recover_passwordPost') }}" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="email" id="email" name="email" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.email') }}" required autofocus/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth/dialog.button.reset') }}</button>
                </div><!-- /.col -->
            </div>
        </form>

        {!! link_to_route('login', trans('auth/dialog.button.sign-in'), [], ['class' => "text-center"]) !!}<br>
        @if (Setting::get('app.allow_registration'))
            {!! link_to_route('register', trans('auth/dialog.button.register-membership'), [], ['class' => "text-center"]) !!}
        @endif

@endsection