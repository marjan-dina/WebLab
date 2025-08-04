<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'connection.php';  // Include the connection file

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];

    // Check if all fields are filled
    if ($title && $author && $description) {
        // Prepare and execute SQL query to insert data into the database
        $sql = "INSERT INTO Book (title, author, description) VALUES ('$title', '$author', '$description')";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            echo "<p style='color: green;'>Book submitted successfully!</p>";
        } else {
            die("Error: " . mysqli_error($conn));  // Display error if query fails
        }
    } else {
        echo "<p style='color: red;'>Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit a Book</title>
</head>
<body>
    <h2>Submit a Book</h2>
    
    <!-- Form for submitting book data -->
    <form method="POST">
        <label>Book Title:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Author:</label><br>
        <input type="text" name="author" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>

        <input type="submit" name="submit" value="Submit Book">
    </form>
</body>
</html>
