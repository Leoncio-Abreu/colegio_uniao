@extends('layouts.dialog')

@section('content')
    <p class="login-box-msg">{{ trans('auth/dialog.text.register') }}</p>
        <form class="form-signin" method="POST" action="{!! route('registerPost') !!}" >
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.first-name') }}" value="{{ old('first_name') }}" required autofocus/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.last-name') }}" value="{{ old('last_name') }}" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.user-name') }}" value="{{ old('username') }}" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="email" name="email" class="form-control" placeholder="{{ trans('auth/dialog.placeholder.email') }}" value="{{ old('email') }}" required/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="remember" name="remember">{{ trans('auth/dialog.text.termstext') }}<a href="{{URL::to('faust')}}">{{ trans('auth/dialog.text.terms') }}</a>
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth/dialog.button.register') }}</button>
                </div><!-- /.col -->
            </div>
        </form>

        {!! link_to_route('login', trans('auth/dialog.button.sign-in'), [], ['class' => "text-center"]) !!}<br>
        {!! link_to_route('recover_password', trans('auth/dialog.button.forgot-password'), [], ['class' => "text-center"]) !!}
@endsection
