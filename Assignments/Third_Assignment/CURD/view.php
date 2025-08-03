<?php
include 'connection.php';

// Delete book
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM booklist WHERE id=$id");
    header("Location: view.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <h2>Book List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Best Seller</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM booklist");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['title']."</td>
                    <td>".$row['author']."</td>
                    <td>".$row['genre']."</td>
                    <td>".($row['bestseller'] ? 'Yes' : 'No')."</td>
                    <td>".$row['description']."</td>
                    <td>
                        <a href='edit.php?id=".$row['id']."'>Edit</a> | 
                        <a href='view.php?delete=".$row['id']."'>Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
    <br>
    <a href="basic.php">Add New Book</a>
</body>
</html>
