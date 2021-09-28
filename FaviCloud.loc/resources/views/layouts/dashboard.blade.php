<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
    <div class="container">

        <img class="navbar-brand mr-auto" src="{{asset('/img/favicode.png')}}" alt="Favicode logo" width="90px"
             height="90px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <form action="{{ route('homepage') }}" method="GET" class="form-horizontal">
                        <button type="submit" class="btn btn-primary btn-block m-2">My files</button>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="{{ route('file.form') }}" method="GET" class="form-horizontal">
                        <button type="submit" class="btn btn-primary btn-block m-2">Add new file</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary btn-block m-2" href="{{ route('signout') }}">Logout</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
@yield('content')

</body>

</html>
