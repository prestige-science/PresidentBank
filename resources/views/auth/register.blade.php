@include('layouts.header')

<div class="container">
    <div class="row less-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>Register</b></h3>
            <hr>
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="control-label">First Name</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" autofocus>
                    @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                    @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email Address</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
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

                <div class="form-group">
                    <label for="password-confirm" class="control-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <hr>
                    <p class="text-center">
                        <a href="{{ url('/login') }}">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')