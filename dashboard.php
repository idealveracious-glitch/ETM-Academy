<?php 
include 'config.php';
if (!isLoggedIn()) {
    redirect('login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Escape The Matrix</title>
    <style>
    /* Add dashboard-specific styles here */
    .dashboard-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        min-height: 100vh;
    }

    /* ... rest of dashboard styles ... */
    </style>
</head>

<body>
    <!-- Dashboard content would go here -->
    <div class="dashboard-container">
        <!-- Sidebar navigation -->
        <!-- Main content with stats, courses, etc. -->
    </div>
</body>

</html>