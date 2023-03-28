<?php
/**
 * @file layout.blade.php
 * @brief file description
 * @author Created by Blooooo
 * @version 23.02.2023
 */

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>{{$title}}</title>
</head>
<body>
<header>


<h1 class="display-1" style=" text-align: center">Ecolopnv</h1>

    @auth
        <div class="right-align" style="text-align:right; margin-right: 5px;color:#386641"><h5>Bienvenue
                @if(auth()->user()->username =='PHI')
                    à vous M.
                @endif
               {{auth()->user()->last_name}}
            @if(auth()->user()->username =='PHI')
                Grand Magnitou supreme
            @endif

            </h5></div>
    @endauth
</header>
<nav>
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>

        @auth
        <li class="nav-item"><a class="nav-link" href="/carpooling" style="color:#386641">My Carpooling</a></li>
        <li class="nav-item"><a class="nav-link" href="/schedule" style="color:#386641">My Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="/profile" style="color:#386641">My Profile</a></li>
            <li class="nav-item" ><form method="post" action="/logout" style="border-color: white;background-color: white; box-shadow:0 0">
                    @csrf
                    <button class="nav-link" type="submit"  style="color:#386641;border-color: white;background-color: white; box-shadow:0 0" >Logout</button>
                </form></li>
        @else
        <li class="nav-item"><a class="nav-link" href="/login" style="color:#386641">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="/signin" style="color:#386641">Sign in</a></li>
        @endauth
    </ul>
</nav>
@yield('content')
<footer>
    <p>Merci Ecolopnv</p>
</footer>
</body>
</html>

