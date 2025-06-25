<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['user']['user_type'] ?? '') !== 'System Administrator') {
    header('Location: ../User/login.html?error=access_denied');
    exit;
}

require_once '../db.php';

$stmt = $pdo->prepare("SELECT * FROM payments ORDER BY payment_date DESC");
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Officer Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/usermanagement.css">
</head>

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
            <li class="active">
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
            <i class='bx bx-menu'></i>
            <a href="#" class="profile">
                <img src="images/people.png">
            </a>
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Payment Records</h1>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Transactions</h3>
                    </div>
                    <div class="table-container" style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse; text-align:center;">
                            <thead>
                                <tr>
                                    <th>Transaction No.</th>
                                    <th>Reference No.</th>
                                    <th>Applicant Name</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payments as $payment): ?>
                                <tr style="border-bottom: 1px solid var(--border-color);">
                                    <td><?= htmlspecialchars($payment['transaction_number']) ?></td>
                                    <td><?= htmlspecialchars($payment['reference_number']) ?></td>
                                    <td><?= htmlspecialchars($payment['applicant_name']) ?></td>
                                    <td>₱<?= number_format($payment['amount'], 2) ?></td>
                                    <td><?= htmlspecialchars($payment['payment_method']) ?></td>
                                    <td><?= htmlspecialchars($payment['status']) ?></td>
                                    <td><?= htmlspecialchars($payment['payment_date']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="dashboard.js"></script>
</body>

</html>