@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row default-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>Update Account</b></h3>
            <hr>

            <form method="post" action="{{ url('/accounts/' . $account->uuid) }}" class="form-horizontal">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ (old('name')) ? old('name') : $account->name }}" autofocus>
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Update Account</button>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layouts.footer')