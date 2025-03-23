<?php
session_start();
?>
<nav>
    <a href="index.php">Home</a> |
    <a href="sell_book.php">Sell a Book</a> |
    <?php if (isset($_SESSION["user_id"])): ?>
        <a href="profile.php">Profile</a> |
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>
<hr>
 
