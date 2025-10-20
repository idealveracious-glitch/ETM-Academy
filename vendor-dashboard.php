<?php 
include 'config.php';
if (!isLoggedIn() || !isVendor()) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard - Escape The Matrix</title>
    <style>
    /* Similar styling as student dashboard but with vendor-specific features */
    .vendor-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .vendor-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Vendor Sidebar -->
        <div class="sidebar">
            <div style="padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h2 style="margin: 0; color: var(--primary-color);">Vendor Panel</h2>
            </div>

            <ul class="sidebar-menu">
                <li><a href="vendor-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="vendor-courses.php"><i class="fas fa-book"></i> My Courses</a></li>
                <li><a href="create-course.php"><i class="fas fa-plus"></i> Create Course</a></li>
                <li><a href="vendor-earnings.php"><i class="fas fa-money-bill"></i> Earnings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Vendor Dashboard</h1>

            <div class="vendor-stats">
                <div class="vendor-card">
                    <h3>Total Courses</h3>
                    <p style="font-size: 2em; color: var(--primary-color); font-weight: bold;">5</p>
                </div>
                <div class="vendor-card">
                    <h3>Total Students</h3>
                    <p style="font-size: 2em; color: var(--primary-color); font-weight: bold;">142</p>
                </div>
                <div class="vendor-card">
                    <h3>Total Earnings</h3>
                    <p style="font-size: 2em; color: var(--primary-color); font-weight: bold;">$2,450</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="content-section">
                <h2>Quick Actions</h2>
                <div style="display: flex; gap: 15px; margin-top: 20px;">
                    <a href="create-course.php" class="cta-button">Create New Course</a>
                    <a href="vendor-courses.php" class="cta-button" style="background: #28a745;">Manage Courses</a>
                    <a href="vendor-earnings.php" class="cta-button" style="background: #17a2b8;">View Earnings</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>