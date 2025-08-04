<?php
session_start();
require 'database.php';

$menu_items = [
  "Mixed Salad" => "https://images.unsplash.com/photo-1546069901-ba9599a7e63c",
  "Cappuccino" => "https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600",
  "Club Sandwich" => "https://images.unsplash.com/photo-1509722747041-616f39b57569?w=600",
  "Latte" => "https://images.unsplash.com/photo-1666196389175-630e3b80ad91?w=600",
  "Croissant" => "https://images.unsplash.com/photo-1681218079567-35aef7c8e7e4?w=600"
];

// Handle Order Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item'])) {
  if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, item_name) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['item']]);
    $order_message = "✅ Order placed for " . htmlspecialchars($_POST['item']) . "!";
  } else {
    $order_message = "⚠️ Please log in to place an order.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Coffee Cloud | Home</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <h1>Coffee Cloud</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
      <p>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
      <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
    <?php endif; ?>
  </header>

  <?php if (isset($order_message)): ?>
    <p style="text-align:center; color: green; font-weight:bold;"><?= $order_message ?></p>
  <?php endif; ?>

  <section class="menu">
    <?php foreach ($menu_items as $name => $img): ?>
      <div class="card">
        <img src="<?= $img ?>" alt="<?= $name ?>" />
        <h2><?= $name ?></h2>
        <?php if (isset($_SESSION['user_id'])): ?>
          <form method="post">
            <input type="hidden" name="item" value="<?= $name ?>">
            <button type="submit">Order Now</button>
          </form>
        <?php else: ?>
          <p style="font-size: 0.9em;">Login to order</p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </section>

  <footer>
    <p>&copy; 2025 Coffee Cloud. All rights reserved.</p>
  </footer>
</body>
</html>

