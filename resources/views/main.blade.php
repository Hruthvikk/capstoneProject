<!DOCTYPE html>
<html>
    <head>
        <title>Neon Approns</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="app.css">
        
    </head>
    <body>
    <nav nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" id="ahov" href="{{url('/')}}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="ahov" href="{{url('/aboutus')}}">About Us</a>    
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="ahov" href="{{url('/signin')}}">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ahov" href="{{url('/signup')}}">Sign Up</a>
                </li>
            </ul>
        </div>    
        </nav>
        @yield('content')
        <br>
        <footer class="bg-dark text-center text-white position-sticky top-100">
            <div class="stickFoot">
                
                <div class="col">©</div>
                <div class="col">Hruthvik</div>
                <div class="col">Chokshi</div>
            </div>
        </footer>
    </body>
</html>