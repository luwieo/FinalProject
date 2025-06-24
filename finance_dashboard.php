<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['user']['user_type'] ?? '') !== 'Municipal Treasurer / Finance Officer') {
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
    <link rel="stylesheet" href="/urbiztondo-auth/admin/admin_dashboard.css">
</head>

<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="/urbiztondo-auth/images/logo.png" id="logo">
            <span class="text">Urbiztondo<br>Finance Portal</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#">
                    <i class='bx bxs-bank'></i>
                    <span class="text">Payments</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu bottom">
            <li>
                <a href="../logout.php">
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