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
    <title></title>
</head>
<body>
<header>
<h2>Ecolopnv</h2>
</header>
<nav>
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>

        @auth
            <li class="nav-item"><h4>bienvenue {{auth()->user()->last_name}}</h4></li>
        <li class="nav-item"><a class="nav-link" href="#">My Carpooling</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
            <li class="nav-item"><form method="post" action="/logout">
                    @csrf
                    <button type="submit">Logout</button>
                </form></li>
        @else
        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="/signin">Sign in</a></li>
        @endauth
    </ul>
</nav>
@yield('content')
<footer>
    <p>Merci Ecolopnv</p>
</footer>
</body>
</html>

