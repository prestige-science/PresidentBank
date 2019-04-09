@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row less-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>New Transfer</b></h3>
            <hr>
            <form role="form" method="POST" action="{{ url('/funds_transfer') }}">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('from_account') ? ' has-error' : '' }}">
                    <label for="from_account" class="control-label">From</label>
                    <select name="from_account" id="from_account" class="form-control">
                        <option value="">Select</option>
                        @if (!empty($from_accounts))
                        @foreach ($from_accounts as $account)
                        <option value="{{ $account->id }}" {{ (old('from_account') && old('from_account') === $account->id) ? 'selected' : '' }}>{{ $account->name }} (KES {{ number_format($account->balance) }})</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('from_account'))
                    <span class="help-block">
                        <strong>{{ $errors->first('from_account') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('to_account') ? ' has-error' : '' }}">
                    <label for="to_account" class="control-label">To</label>
                    <select name="to_account" id="to_account" class="form-control">
                        <option value="">Select</option>
                        @if (!empty($to_accounts))
                        @foreach ($to_accounts as $account)
                        <option value="{{ $account->id }}" {{ (old('to_account') && old('to_account') === $account->id) ? 'selected' : '' }}>{{ $account->user->first_name . ' ' . $account->user->last_name }} - {{ $account->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('to_account'))
                    <span class="help-block">
                        <strong>{{ $errors->first('to_account') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="amount" class="control-label">Amount</label>
                    <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>
                    @if ($errors->has('amount'))
                    <span class="help-block">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                    @endif
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Make Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
