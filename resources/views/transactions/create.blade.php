@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row less-padding">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>New Transaction</b></h3>
            <hr>
            <form role="form" method="POST" action="{{ url('/transactions') }}">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('account') ? ' has-error' : '' }}">
                    <label for="account" class="control-label">Account</label>
                    <select name="account" id="account" class="form-control">
                        <option value="">Select</option>
                        @if (!empty($accounts))
                        @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" {{ (old('account') && old('account') === $account->id) ? 'selected' : '' }}>{{ $account->name }} (KES {{ number_format($account->balance) }})</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('account'))
                    <span class="help-block">
                        <strong>{{ $errors->first('account') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('transaction_type') ? ' has-error' : '' }}">
                    <label for="transaction_type" class="control-label">Transaction Type</label>
                    <select name="transaction_type" id="transaction_type" class="form-control">
                        <option value="">Select</option>
                        @if (!empty($transaction_types))
                        @foreach ($transaction_types as $transaction_type)
                        <?php
                        if ($transaction_type->id === 2) {
                            continue;
                        }
                        ?>
                        <option value="{{ $transaction_type->id }}" {{ (old('transaction_type') && old('transaction_type') === $transaction_type->id) ? 'selected' : '' }}>{{ $transaction_type->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('transaction_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('transaction_type') }}</strong>
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
                    <button type="submit" class="btn btn-primary btn-block">Make Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
