<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $title  = $_POST['title'];
    $author = $_POST['author'];
    $genre  = $_POST['genre'];
    $desc   = $_POST['description'];
    $best   = isset($_POST['bestseller']) ? 1 : 0;

    $sql = "INSERT INTO booklist (title, author, genre, description, bestseller) 
            VALUES ('$title', '$author', '$genre', '$desc', '$best')";

    if ($conn->query($sql) === TRUE) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add Book</h2>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required><br><br>

        <label>Author:</label>
        <input type="text" name="author" required><br><br>

        <label>Genre:</label>
        <input type="text" name="genre"><br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Best Selling:</label>
        <input type="radio" name="bestseller" value="1"> Yes
        <input type="radio" name="bestseller" value="0"> No <br><br>

        <input type="submit" name="submit" value="Add Book">
    </form>

    <br>
    <a href="view.php">View Book List</a>
</body>
</html>
