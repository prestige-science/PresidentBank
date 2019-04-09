@include('layouts.header')

<div class="container">
    <div class="row default-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>Reset Password</b></h3>
            <hr>

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    <hr>
                    <p class="text-center">
                        <a href="{{ url('/login') }}">Login</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="{{ url('/register') }}">Create Account</a>
                    </p>                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')