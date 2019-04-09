@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="text-center"><b>My Transactions</b></h3>
            <hr>

            <p class="text-right"><a href="{{ url('/transactions/create') }}" class="btn btn-primary">New Transaction</a></p>

            <hr>

            @if ($message = session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ $message }}
            </div>
            <hr>
            @elseif ($message = session('warning'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ $message }}
            </div>
            <hr>
            @elseif ($message = session('danger'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ $message }}
            </div>
            <hr>
            @endif

            <table id="datatable" class="table table-responsive table-condensed table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Type</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key=>$value)
                    <?php
                    if ($value->type_id === 2) {
                        continue;
                    }
                    ?>
                    <tr>
                        <td class="text-center">{{ ++$key }}</td>
                        <td>{{ $value->type->name }}</td>
                        <td>{{ $value->account->name }}</td>
                        <td>KES {{ number_format($value->amount) }}</td>
                        <td>{{ date('jS F Y @ g:i a', strtotime($value->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer')