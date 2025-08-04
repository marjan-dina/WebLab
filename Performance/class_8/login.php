<?php
require 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: index.php");
        exit;
    } else {
        $error = "❌ Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | Coffee Cloud</title>
    <style>
        body {
            background: linear-gradient(to right, #ffdde1, #ee9ca7);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #a0522d;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        button {
            padding: 10px 20px;
            background-color: #a0522d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #7e3e20;
        }

        .msg {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .msg.error {
            background-color: #ffdddd;
            color: #a00;
        }

        a {
            color: #a0522d;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Login</h2>

        <?php if (isset($error)): ?>
            <div class="msg error"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="email" name="email" placeholder="Your DIU Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
