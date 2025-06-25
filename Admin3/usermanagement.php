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
    <link rel="stylesheet" href="css/usermanagement.css">

    <title>Admin Portal - User Management</title> </head>

<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/logo.png" id="logo">
            <span class="text">Urbiztondo <br> Admin Portal</span>
        </a>
        <ul class="side-menu top">
            <li>
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
            <li class="active">
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
                <a href="settings.php" class="settings" data-target="settings"> <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="../logout.php" class="logout" data-target="logout"> <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="profile.html" class="profile">
                <img src="images/people.png">
            </a>
        </nav>
        <main>
            <div id="usermanagement-content">
                <div class="head-title">
                    <div class="left">
                        <h1>User Management</h1>
                    </div>
                </div>

<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>All Users</h3>
            <div class="search-container">
                <input type="search" placeholder="Search users...">
                <button class="search-btn"><i class='bx bx-search'></i></button>
            </div>
            <button class="show-all-btn">Show All</button>
            <i class='bx bx-filter'></i>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Birthdate</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Resident</th>
                        <th>Role</th>
                        <th>Change Role</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../db.php'; // Ensure this path is correct
                    $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $roles = [
                        'Resident',
                        'System Administrator',
                        'Public Information Officer',
                        'E-Service Coordinator',
                        'Municipal Treasurer / Finance Officer',
                        'Online Permit & Licensing Officer',
                        'Civil Registry Officer'
                    ];
                    foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                            <td><?= $user['gender'] ?></td>
                            <td><?= $user['birth_date'] ?></td>
                            <td><?= $user['address'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['mobile'] ?></td>
                            <td><?= $user['resident'] ? 'Yes' : 'No' ?></td>
                            <td><?= $user['user_type'] ?></td>
                            <td>
                                <form action="edit_user.php" method="POST" class="table-action-form">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <select name="user_type">
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role ?>"
                                                <?= $user['user_type'] === $role ? 'selected' : '' ?>>
                                                <?= $role ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="table-action-button btn-update">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="delete_user.php" method="POST" class="table-action-form"
                                    onsubmit="return confirm('Delete this user?');">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="table-action-button btn-delete">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
        </main>
    </section>
    <script src="js/dashboard.js"></script>
</body>
</html>