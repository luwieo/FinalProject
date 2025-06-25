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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/analytics.css">
    <title>Admin Portal - Analytics</title>
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
            <li class="active">
                <a href="analytics.php" data-target="application-management">
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
            <form action="#">
                <div></div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="profile.html" class="profile">
                <img src="images/people.png">
            </a>
        </nav>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Application Management</h1>
            </div>
        </div>

        <div class="top-widgets-container">
            <div class="box-info">
                <a href="#" class="box-link" id="applications-link">
                    <i class='bx bx-file'></i>
                    <span class="text">
                        <h4>Overall Data</h4>
                        <p style="font-size: 14px;">View Overall Data</p>
                    </span>
                </a>
                <a href="#" class="box-link" id="services-link">
                    <i class='bx bx-briefcase'></i>
                    <span class="text">
                        <h4>Services</h4>
                        <p style="font-size: 14px;">View all Services Request</p>
                    </span>
                </a>
                <a href="#" class="box-link" id="complaints-link">
                    <i class='bx bxs-message-error' style="color: #FD7238; background-color: #FFE0D3;"></i>
                    <span class="text">
                        <h4>Complaints</h4>
                        <p style="font-size: 12px;">View all Complaints</p> </span>
                </a>
            </div>
            <div class="chart-container">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Citizen Applications</h3>
                    <div class="search-container">
                        <input type="search" id="search-input" placeholder="Search...">
                        <button type="submit" class="search-btn" id="search-button"><i class='bx bx-search'></i></button>
                    </div>
                    <button class="show-all-btn" id="show-all-button">All Data</button> <i class='bx bx-filter' id="filter-button"></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Citizen Name</th>
                            <th>Address</th>
                            <th>Application Type</th>
                            <th>Application Number</th>
                            <th>Date Submitted</th>
                            <th>Duration</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mylene Equilona</td>
                            <td>Blk 1 Lot 1</td>
                            <td>Business Permit</td>
                            <td>URB-BP-2025-0001</td>
                            <td>05-18-2025</td>
                            <td class="application-duration"></td>
                            <td class="last-updated-date">05-28-2025</td>
                            <td>
                                <span class="status completed">
                                    <select name="status" title="Status" class="status-select">
                                        <option value="complete" class="status completed" selected>Completed</option>
                                        <option value="process" class="status process">On Process</option>
                                        <option value="pending" class="status pending">Pending</option>
                                        <option value="denied" class="status denied">Denied</option>
                                    </select>
                                </span>
                            </td>
                            <td>
                                <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                    <option value="approved">Approved</option>
                                    <option value="under-approval">Under Approval</option>
                                    <option value="declined">Declined</option>             
                                </select>
                            </td>
                            <td><a href="Permits/BusinessPermit-Application.pdf" class="button"><span>View</span></a></td>
                        </tr>
                        <tr>
                            <td>Angelo Famador</td>
                            <td>Blk 5 Lot 11</td>
                            <td>Business Permit</td>
                            <td>URB-BP-2025-0002</td>
                            <td>05-22-2025</td>
                            <td class="application-duration"></td>
                            <td class="last-updated-date">05-23-2025</td>
                            <td>
                                        <span class="status pending">
                                        <select name="status" title="Status" class="status-select">
                                            <option value="complete" class="status completed">Completed</option>
                                            <option value="process" class="status process">On Process</option>
                                            <option value="pending" class="status pending" selected>Pending</option>
                                            <option value="denied" class="status denied">Denied</option>
                                        </select>
                                        </span>
                                    </td>
                                    <td>
                                        <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                            <option value="approved">Approved</option>
                                            <option value="under-approval">Under Approval</option>
                                            <option value="declined">Declined</option>             
                                        </select>
                                    </td>
                            <td><a href="Permits/BusinessPermit-Application.pdf" class="button"><span>View</span></a></td>
                        </tr>
                        <tr>
                            <td>Kim Napatutan</td>
                            <td>Blk 2 Lot 3</td>
                            <td>Building Permit</td>
                            <td>URB-BG-2025-0001</td>
                            <td>05-20-2025</td>
                            <td class="application-duration">21 days ago</td>
                            <td class="last-updated-date">05-26-2025</td>
                            <td>
                                        <span class="status process">
                                        <select name="status" title="Status" class="status-select">
                                            <option value="complete" class="status completed">Completed</option>
                                            <option value="process" class="status process" selected>On Process</option>
                                            <option value="pending" class="status pending">Pending</option>
                                            <option value="denied" class="status denied">Denied</option>
                                        </select>
                                        </span>
                                    </td>
                                    <td>
                                        <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                            <option value="approved">Approved</option>
                                            <option value="under-approval">Under Approval</option>
                                            <option value="declined">Declined</option>             
                                        </select>
                                    </td>
                            <td><a href="Permits/BuildingPermit-Application.pdf" class="button"><span>View</span></a></td>
                        </tr>
                        <tr>
                            <td>Erik Poyaoan</td>
                            <td>Blk 3 Lot 16</td>
                            <td>Demolition Permit</td>
                            <td>URB-DP-2025-0001</td>
                            <td>05-27-2025</td>
                            <td class="application-duration">14 days ago</td>
                            <td class="last-updated-date">05-28-2025</td>
                            <td>
                                        <span class="status denied">
                                        <select name="status" title="Status" class="status-select">
                                            <option value="complete" class="status completed">Completed</option>
                                            <option value="process" class="status process">On Process</option>
                                            <option value="pending" class="status pending">Pending</option>
                                            <option value="denied" class="status denied" selected>Denied</option>
                                        </select>
                                        </span>
                                    </td>
                                    <td>
                                        <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                            <option value="approved">Approved</option>
                                            <option value="under-approval">Under Approval</option>
                                            <option value="declined">Declined</option>             
                                        </select>
                                    </td>
                            <td><a href="Permits/DemolitionPermit-Application.pdf" class="button"><span>View</span></a></td>
                        </tr>
                        <tr>
                            <td>Jana Soriano</td>
                            <td>Blk 4 Lot 5</td>
                            <td>Electrical Permit</td>
                            <td>URB-EP-2025-0001</td>
                            <td>05-17-2025</td>
                            <td class="application-duration">24 days ago</td>
                            <td class="last-updated-date">05-25-2025</td>
                            <td>
                                        <span class="status completed">
                                        <select name="status" title="Status" class="status-select">
                                            <option value="complete" class="status completed" selected>Completed</option>
                                            <option value="process" class="status process">On Process</option>
                                            <option value="pending" class="status pending">Pending</option>
                                            <option value="denied" class="status denied">Denied</option>
                                        </select>
                                        </span>
                                    </td>
                                    <td>
                                        <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                            <option value="approved">Approved</option>
                                            <option value="under-approval">Under Approval</option>
                                            <option value="declined">Declined</option>             
                                        </select>
                                    </td>
                            <td><a href="supportingfile.html" class="button"><span>View</span></a></td>
                        </tr>
                        <tr>
                            <td>Justine Ibale</td>
                            <td>Blk 2 Lot 7</td>
                            <td>Waste Management</td>
                            <td>URB-WM-2025-0001</td>
                            <td>05-18-2025</td>
                            <td class="application-duration">23 days ago</td>
                            <td class="last-updated-date">05-28-2025</td>
                            <td>
                                        <span class="status completed">
                                        <select name="status" title="Status" class="status-select">
                                            <option value="complete" class="status completed" selected>Completed</option>
                                            <option value="process" class="status process">On Process</option>
                                            <option value="pending" class="status pending">Pending</option>
                                            <option value="denied" class="status denied">Denied</option>
                                        </select>
                                        </span>
                                    </td>
                                    <td>
                                        <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                            <option value="approved">Approved</option>
                                            <option value="under-approval">Under Approval</option>
                                            <option value="declined">Declined</option>             
                                        </select>
                                    </td>
                            <td><a href="supportingfile.html" class="button"><span>View</span></a></td>
                        </tr>
                        <tr>
                            <td>Rodge Funtalba</td>
                            <td>Blk 1 Lot 13</td>
                            <td>Public Safety</td>
                            <td>URB-PS-2025-0001</td>
                            <td>05-18-2025</td>
                            <td class="application-duration">23 days ago</td>
                            <td class="last-updated-date">05-28-2025</td>
                            <td>
                                        <span class="status process">
                                        <select name="status" title="Status" class="status-select">
                                            <option value="complete" class="status completed">Completed</option>
                                            <option value="process" class="status process" selected>On Process</option>
                                            <option value="pending" class="status pending">Pending</option>
                                            <option value="denied" class="status denied">Denied</option>
                                        </select>
                                        </span>
                                    </td>
                                    <td>
                                        <select name="remarks" title="Remarks" class="remarks-select" disabled>
                                            <option value="approved">Approved</option>
                                            <option value="under-approval">Under Approval</option>
                                            <option value="declined">Declined</option>             
                                        </select>
                                    </td>
                            <td><a href="Permits/BuildingPermit-Application.pdf" class="button"><span>View</span></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    </section>

    <script src="js/analytics.js"></script>
</body>
</html>
