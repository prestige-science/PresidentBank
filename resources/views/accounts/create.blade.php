@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row default-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>Create Account</b></h3>
            <hr>
            <form role="form" method="POST" action="{{ url('accounts') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
