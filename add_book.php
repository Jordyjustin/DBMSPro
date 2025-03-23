<?php
include "includes/db_connect.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    die("Please <a href='login.php'>login</a> to add books.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $seller_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO books (title, author, price, seller_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $title, $author, $price, $seller_id);
    
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Book added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error adding book.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Book</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Header */
        header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
        }

        /* Container */
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 80px; /* To account for the fixed header */
        }

        h2 {
            font-size: 24px;
            margin-bottom: 1.5rem;
            color: #007bff;
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            width: 100%; /* Make buttons the same width */
            padding: 0.75rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
            margin-bottom: 10px; /* Add space between buttons */
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #007bff;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <header>Add a Book</header>
    <div class="container">
        <h2>Enter Book Details</h2>
        <form method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit" class="btn">Add Book for Sale</button>
        </form>
        <a href="home.php" class="btn btn-secondary">Back to Home</a>
    </div>
</body>
</html>