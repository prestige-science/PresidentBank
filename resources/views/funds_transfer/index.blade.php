@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3 class="text-center"><b>Funds Transfers</b></h3>
            <hr>

            <p class="text-right"><a href="{{ url('/funds_transfer/create') }}" class="btn btn-primary">New Transfer</a></p>

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
                        <th>From</th>
                        <th>Account</th>
                        <th>To</th>
                        <th>Account</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $key=>$value)
                    <tr>
                        <td class="text-center">{{ ++$key }}</td>
                        <td>{{ $value->from_name }}</td>
                        <td>{{ $value->from_account }}</td>
                        <td>{{ $value->to_name }}</td>
                        <td>{{ $value->to_account }}</td>
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