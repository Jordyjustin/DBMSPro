<?php
include("db_connect.php");
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

echo "<h1>Welcome, " . $user["name"] . "</h1>";
echo "<a href='logout.php'>Logout</a>";
?>
 
