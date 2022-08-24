<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/dashboards/it.css') }}" rel="stylesheet">
   
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if (Request::segment(2)=='users')
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.create') }}">Ajouter Utilisateur</a>
                    </li>
                @endIf  
                @if (Request::segment(2)=='events')
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.create') }}">Ajouter Evenement</a>
                    </li>
                @endIf  
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Evenements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
            </ul>
  
        </div>
    </div>
</nav>
  
@yield('content')
     
</body>
</html>