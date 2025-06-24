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
    <link rel="stylesheet" href="css/admin_dashboard.css">

    <title>Admin Portal - Dashboard</title>
</head>

<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="/urbiztondo-auth/images/logo.png" id="logo">
            <span class="text">Urbiztondo <br> Admin Portal</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#dashboard-content" data-target="dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#analytics-content" data-target="analytics">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <?php if ($_SESSION['user']['user_type'] === 'System Administrator'): ?>
            <li>
                <a href="#user-management-content" data-target="user-management">
                    <i class='bx bx-user'></i>
                    <span class="text">User Management</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <ul class="side-menu bottom">
            <li>
                <a href="settings" class="settings" data-target="settings">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="../logout.php" class="logout" data-target="logout">
                    <i class='bx bxs-log-out-circle'></i>
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

            <div id="analytics-content" style="display: none;">
            </div>

            <div id="user-management-content" style="display: none;">
                <div class="head-title">
                    <div class="left">
                        <h1>User Management</h1>
                    </div>
                </div>

                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>All Users</h3>
                        </div>

                        <div class="table-container" style="overflow-x:auto;">
                            <table style="width:100%; border-collapse:collapse; text-align:center;">
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
                        require_once '../db.php';
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
                                    <tr style="border-bottom: 1px solid var(--border-color);">
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
                                            <form action="edit_user.php" method="POST" style="display:flex; gap:5px;">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <select name="user_type">
                                                    <?php foreach ($roles as $role): ?>
                                                    <option value="<?= $role ?>"
                                                        <?= $user['user_type'] === $role ? 'selected' : '' ?>>
                                                        <?= $role ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit"
                                                    style="background:var(--accent-blue); color:white; border:none; padding:4px 8px; border-radius:5px;">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="delete_user.php" method="POST"
                                                onsubmit="return confirm('Delete this user?');">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <button type="submit"
                                                    style="background:var(--accent-red); color:white; border:none; padding:4px 8px; border-radius:5px;">
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
            </div>
            <div id="messages-content" style="display: none;">
            </div>
        </main>
    </section>
    <script src="dashboard.js"></script>
</body>

</html>