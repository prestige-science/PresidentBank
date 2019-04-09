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

            <form role="form" method="POST" action="{{ route('password.email') }}">
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

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
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