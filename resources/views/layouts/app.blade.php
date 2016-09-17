<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Training Log</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <ul class="nav navbar-nav">
			        <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ URL::to('/') }}">Home</a>
                    </li>
			        <li class="{{ Request::is('dateFilter*') ? 'active' : '' }}">
                        <a href="{{ URL::to('/dateFilter') }}">Date</a>
                    </li>
			        <li class="{{ Request::is('exercises*') ? 'active' : '' }}">
                        <a href="{{ URL::to('/exercises') }}">Exercises</a>
                    </li>
			    </ul>
            </nav>
        </div>
        @yield('content')
    </body>
</html>