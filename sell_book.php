<?php
include "includes/db_connect.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    die("Please <a href='login.php'>login</a> to view books.");
}

// Handle buying a book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book_id"])) {
    $book_id = $_POST["book_id"];

    // Delete the book from the database (simulate purchase)
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    
    if ($stmt->execute()) {
        echo "<p style='color:green;'>Book purchased successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error purchasing book.</p>";
    }
}

// Fetch available books
$result = $conn->query("SELECT id, title, author, price FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
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
            min-height: 100vh;
            flex-direction: column;
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
            width: 100%;
            position: fixed;
            top: 0;
        }

        /* Container */
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-top: 80px; /* To account for the fixed header */
        }

        h2 {
            font-size: 24px;
            margin-bottom: 1.5rem;
            color: #007bff;
            text-align: center;
        }

        /* Book List */
        .book-list {
            width: 100%;
            margin: auto;
        }

        .book {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .book:hover {
            background-color: #f1f1f1;
        }

        .book strong {
            font-size: 1.2rem;
            color: #333;
        }

        .book p {
            margin: 0.5rem 0;
            color: #555;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
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
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }

            .book-list {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>Available Books</header>
    <div class="container">
        <h2>Books for Sale</h2>
        <div class="book-list">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="book">
                    <strong><?php echo htmlspecialchars($book["title"]); ?></strong>
                    <p>Author: <?php echo htmlspecialchars($book["author"]); ?></p>
                    <p>Price: $<?php echo number_format($book["price"], 2); ?></p>
                    <form method="post">
                        <input type="hidden" name="book_id" value="<?php echo $book["id"]; ?>">
                        <button type="submit" class="btn">Buy</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
        <a href="home.php" class="btn btn-secondary" style="margin-top: 20px;">Back to Home</a>
    </div>
</body>
</html>