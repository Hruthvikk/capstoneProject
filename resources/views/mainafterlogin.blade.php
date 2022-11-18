<!DOCTYPE html>
<html>
    <head>
        <title>Neon Approns</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/app.css">
        
    </head>
    <body>
    <nav nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <ul class="ultwo">
                        <li class="litwo">
                        <a class="nav-link" href="{{url('/homeafterlogin')}}">Home</a>
                        </li>
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/searchrecipe')}}">Search Recipe</a>
                        </li>
                        
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/tant')}}">Tips / Tricks</a>
                        </li>
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/addrecipe')}}">Add Recipe</a>
                        </li>
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/editProfile')}}">Account</a>
                        </li>
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/message')}}">Messages</a>
                        </li>
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/aboutusal')}}">About Us</a>    
                        </li>
                        <li class="litwo">
                            <a class="nav-link" href="{{url('/logout')}}">Logout</a>
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