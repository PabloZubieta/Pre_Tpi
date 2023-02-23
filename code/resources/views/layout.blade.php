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
<h2>les fou du volant</h2>
</header>
<nav>
    <ul class="nav">

        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>

        <?php
        if (isset($_SESSION['connected'])) {
            ?>
        <li class="nav-item"><a class="nav-link" href="#">My Carpooling</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
            <?php
        } else {
            ?>
        <li class="nav-item"><a class="navlink" href="#">Login</a></li>
        <li class="nav-item"><a class="navlink" href="#">Sign in</a></li>
            <?php
        }

        ?>
    </ul>
</nav>
@yield('content')
<footer>
    <p>a jamais dans nos coeur</p>
</footer>
</body>
</html>

