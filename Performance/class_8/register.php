<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email     = trim($_POST['email']);
    $name      = trim($_POST['name']);
    $birthdate = $_POST['birthdate'];
    $password  = $_POST['password'];

    // Validation
    if (!preg_match('/^[\w.+-]+@diu\.edu\.bd$/', $email)) {
        $error = "Email must be from @diu.edu.bd domain.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@_#?!$%^&*])[A-Za-z\d@_#?!$%^&*]{8,}$/', $password)) {
        $error = "Password must have uppercase, lowercase, number & special char.";
    } else {
        try {
            // Check duplicate
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $error = "Email already registered.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $year = date('y', strtotime($birthdate));
                $stmt = $pdo->prepare("SELECT COUNT(*) + 1 AS num FROM users WHERE YEAR(birthdate) = ?");
                $stmt->execute([date('Y', strtotime($birthdate))]);
                $row = $stmt->fetch();
                $user_id_code = $year . '-' . str_pad($row['num'], 3, '0', STR_PAD_LEFT);

                $stmt = $pdo->prepare("INSERT INTO users (email, name, birthdate, password, user_id_code) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$email, $name, $birthdate, $hashed_password, $user_id_code]);

                $success = "✅ Registration successful! <a href='login.php'>Login</a>";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register | Coffee Cloud</title>
    <style>
        body {
            background: linear-gradient(to right, #ffecd2, #fcb69f);
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
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

        .msg.success {
            background-color: #ddffdd;
            color: #0a0;
        }

        a {
            color: #a0522d;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create an Account</h2>

        <?php if (isset($error)): ?>
            <div class="msg error"><?= $error ?></div>
        <?php elseif (isset($success)): ?>
            <div class="msg success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="email" name="email" placeholder="Email (e.g., name@diu.edu.bd)" required>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="date" name="birthdate" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
