<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'login') {
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
            $_SESSION['full_name'] = $user['full_name'];
            
            jsonResponse(true, 'Login successful', [
                'role' => $user['role'],
                'redirect' => getRedirectUrl($user['role'])
            ]);
        } else {
            jsonResponse(false, 'Invalid email or password');
        }
    }
    
    if ($_POST['action'] == 'register') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $full_name = $_POST['full_name'];
        $role = $_POST['role'];
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $email, $password, $full_name, $role]);
            
            $userId = $pdo->lastInsertId();
            
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['subscription'] = 'basic';
            $_SESSION['full_name'] = $full_name;
            
            jsonResponse(true, 'Registration successful', [
                'role' => $role,
                'redirect' => getRedirectUrl($role)
            ]);
        } catch(PDOException $e) {
            jsonResponse(false, 'Registration failed: ' . $e->getMessage());
        }
    }
    
    if ($_POST['action'] == 'logout') {
        session_destroy();
        jsonResponse(true, 'Logged out successfully');
    }
}

function getRedirectUrl($role) {
    switch($role) {
        case 'admin':
            return 'admin-dashboard.php';
        case 'vendor':
            return 'vendor-dashboard.php';
        default:
            return 'dashboard.php';
    }
}
?>