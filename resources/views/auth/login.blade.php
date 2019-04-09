@include('layouts.header')

<div class="container">
    <div class="row default-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>Login</b></h3>
            <hr>
            <form role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email Address</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" autofocus>
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
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <hr>
                    <p class="text-center">
                        <a href="{{ url('/register') }}">Create Account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
