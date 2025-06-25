<?php
session_start();

// Check if user is logged in AND if they are an admin
if (!isset($_SESSION['user_id']) || ($_SESSION['user']['user_type'] ?? 'Resident') !== 'System Administrator') {
    // Not logged in or not an admin, redirect to login page (in User folder)
    header('Location: ../User/login.html?error=access_denied');
    exit;
}

// If they are an admin, display the admin content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard.css">

    <title>Admin Portal - Dashboard</title>
</head>

<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/logo.png" id="logo">
            <span class="text">Urbiztondo <br> Admin Portal</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="dashboard.php" data-target="dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="analytics.php" data-target="analytics">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Application Management</span>
                </a>
            </li>
            <li>
                <a href="usermanagement.php" data-target="user-management">
                    <i class='bx bx-user'></i>
                    <span class="text">User Management</span>
                </a>
            </li>
            <li>
                <a href="appointments.php" data-target="appointment">
                    <i class='bx bx-calendar'></i>
                    <span class="text">Appointment</span>
                </a>
            </li>
            <li>
                <a href="finance_dashboard.php" data-target="finance">
                    <i class='bx bxs-bank'></i>
                    <span class="text">Finance</span>
                </a>
            </li>
            <li>
                <a href="CMS.php" class="admin-cms-link">
                    <i class='bx bxs-edit'></i>
                    <span class="text">Admin CMS</span>
                </a>
            </li>
            <li>
                <a href="com&notiffinal.php" class="admin-cms-link">
                    <i class='bx bxs-bell'></i>
                    <span class="text">Comm & Notif</span>
                </a>
            </li>
            <li>
                <a href="feedbackfinal.php" class="admin-cms-link">
                    <i class='bx bxs-comment-detail'></i>
                    <span class="text">Feedback</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu bottom">
            <li>
                <a href="settings" class="settings" data-target="settings">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="log-out" class="logout" data-target="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu' ></i>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="profile.html" class="profile">
                <img src="images/people.png">
            </a>
        </nav>

        <main>
            <div id="dashboard-content">
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                    </div>
                </div>

                <div class="box-info">
                    <a href="service.html" class="box-link">
                        <li>
                            <i class='bx bx-briefcase'></i>
                            <span class="text">
                                <h4>Services</h4>
                                <p style="font-size: 14px;">View all Services Request</p>
                            </span>
                        </li>
                    </a>
                    <a href="complaints.html" class="box-link">
                        <li>
                            <i class='bx bxs-message-error' style="color: #FD7238; background-color: #FFE0D3;"></i>
                            <span class="text">
                                <h4>Complaints</h4>
                                <p style="font-size: 14px;">View all Complaints</p>
                            </span>
                        </li>
                    </a>
                </div>
            </div>
        </main>
    </section>
    <script src="js/dashboard.js"></script>
</body>
</html>