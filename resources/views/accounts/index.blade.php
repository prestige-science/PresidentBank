@include('layouts.header')
@include('layouts.navigation')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="text-center"><b>My Accounts</b></h3>
            <hr>

            <p class="text-right"><a href="{{ url('/accounts/create') }}" class="btn btn-primary">Create Account</a></p>

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
                        <th>Name</th>
                        <th>Balance</th>
                        <th>Log</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $key=>$value)
                    <tr>
                        <td class="text-center">{{ ++$key }}</td>
                        <td>{{ $value->name }}</td>
                        <td>KES {{ number_format($value->balance) }}</td>
                        <td>
                            @if ($value->created_at == $value->updated_at)
                            Created on {{ date('jS F Y @ g:i a', strtotime($value->created_at)) }}
                            @else
                            Updated on {{ date('jS F Y @ g:i a', strtotime($value->updated_at)) }}
                            @endif
                        </td>
                        <td class="text-center"><a href="{{ url('/accounts/' . $value->uuid . '/edit') }}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer')