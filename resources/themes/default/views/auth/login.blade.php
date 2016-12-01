@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">{{ trans('auth/dialog.login-box-msg') }}</p>
        <form class="form-signin" method="POST" action="{!! route('loginPost') !!}" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="{{ trans('auth/dialog.user-name') }}" value="{{ old('username') }}" required autofocus/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="password" name="password" class="form-control" placeholder=" {{ trans('auth/dialog.password') }}" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember" name="remember"> {{ trans('auth/dialog.remember-me') }}
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth/dialog.sign-in') }}</button>
                </div><!-- /.col -->
            </div>
        </form>

        {!! link_to_route('recover_password', trans('auth/dialog.forgot-password'), [], ['class' => "text-center"]) !!}<br>
        @if (Setting::get('app.allow_registration'))
            {!! link_to_route('register', trans('auth/dialog.register-membership'), [], ['class' => "text-center"]) !!}
        @endif

@endsection
