<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to index.php if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Used Books Marketplace</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f8f9fa; }
        header { background: #007bff; color: white; padding: 20px; font-size: 24px; }
        .container { margin-top: 50px; }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            text-align: center;
            background: #0056b3;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
        }
        .btn:hover { background: #003d80; }
    </style>
</head>
<body>
    <header>Used Books Marketplace</header>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!</h2>
        <p>Choose an option:</p>
        <a href="sell_book.php" class="btn">Buy Book</a>
        <a href="add_book.php" class="btn">Add Book for Sale</a>
        <a href="logout.php" class="btn" style="background: red;">Logout</a>
    </div>
</body>
</html>
