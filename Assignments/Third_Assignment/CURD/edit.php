<?php
include 'connection.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM booklist WHERE id=$id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $title  = $_POST['title'];
    $author = $_POST['author'];
    $genre  = $_POST['genre'];
    $desc   = $_POST['description'];
    $best   = isset($_POST['bestseller']) ? 1 : 0;

    $conn->query("UPDATE booklist SET 
                    title='$title',
                    author='$author',
                    genre='$genre',
                    description='$desc',
                    bestseller='$best'
                  WHERE id=$id");

    header("Location: view.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?= $row['title'] ?>"><br><br>

        <label>Author:</label>
        <input type="text" name="author" value="<?= $row['author'] ?>"><br><br>

        <label>Genre:</label>
        <input type="text" name="genre" value="<?= $row['genre'] ?>"><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= $row['description'] ?></textarea><br><br>

        <label>Best Selling:</label>
        <input type="radio" name="bestseller" value="1" <?= ($row['bestseller'] ? 'checked' : '') ?>> Yes
        <input type="radio" name="bestseller" value="0" <?= (!$row['bestseller'] ? 'checked' : '') ?>> No <br><br>

        <input type="submit" name="update" value="Update Book">
    </form>
</body>
</html>
