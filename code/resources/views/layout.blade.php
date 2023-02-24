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
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>

        @auth

        <li class="nav-item"><a class="nav-link" href="#">My Carpooling</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
        @else
        <li class="nav-item"><a class="navlink" href="/login">Login</a></li>
        <li class="nav-item"><a class="navlink" href="/signin">Sign in</a></li>
        @endauth
    </ul>
</nav>
@yield('content')
<footer>
    <p>a jamais dans nos coeur</p>
</footer>
</body>
</html>

