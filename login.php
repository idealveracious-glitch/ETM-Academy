<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Escape The Matrix</title>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #111, #333);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 400px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #ff4c00;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background: #ff7700;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 style="text-align: center; margin-bottom: 30px;">Login to Your Account</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['subscription'] = $user['subscription'];
                
                // Redirect based on role
                if ($user['role'] == 'admin') {
                    header("Location: admin-dashboard.php");
                } elseif ($user['role'] == 'vendor') {
                    header("Location: vendor-dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                echo '<div style="color: red; margin-bottom: 20px;">Invalid email or password</div>';
            }
        }
        ?>

        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>
</body>

</html>