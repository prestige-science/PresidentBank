<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/accounts') }}">Accounts</a></li>
                <li><a href="{{ url('/transactions') }}">Transactions</a></li>
                <li><a href="{{ url('/funds_transfer') }}">Funds Transfer</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </li>
                @else
                <li><a href="{{ url('/register') }}">Register</a></li>
                <li><a href="{{ url('/login') }}">Login</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>