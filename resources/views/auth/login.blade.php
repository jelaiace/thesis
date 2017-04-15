<!DOCTYPE html>
<html>
<head>
    <title>Login - Classroom Scheduler</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesheet.css') }}">
</head>

<body class="login-page">
    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="text-center u-spacer-large">
                <img class="logo" src="{{ asset('logo.png') }}" style="width: 125px">
            </div>

            <div class="panel panel-default">
                <div class="panel-heading text-center">Classroom Scheduler Login</div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email (e.g. hello@gmail.com)" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>