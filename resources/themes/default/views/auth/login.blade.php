@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">{{ trans('auth/dialog.text.login') }}</p>
        <form class="form-signin" method="POST" action="{!! route('loginPost') !!}" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.user-name') }}" value="{{ old('username') }}" required autofocus/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="password" name="password" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.password') }}" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                @if ( Setting::get('auth.enable_remember_token') )
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember" name="remember"> {{ trans('auth/dialog.text.remember-me') }}
                        </label>
                    </div>
                </div><!-- /.col -->
                @endif
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth/dialog.button.sign-in') }}</button>
                </div><!-- /.col -->
            </div>
        </form>

        {!! link_to_route('recover_password', trans('auth/dialog.button.forgot-password'), [], ['class' => "text-center"]) !!}<br>
        @if (Setting::get('app.allow_registration'))
            {!! link_to_route('register', trans('auth/dialog.button.register-membership'), [], ['class' => "text-center"]) !!}
        @endif

@endsection