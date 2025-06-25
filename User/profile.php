<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile - Municipality of Urbiztondo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* General Reset and Body Styles */
        :root {
            /* Text colors from aboutus.css */
            --color-light-text-primary: #fff;
            --color-light-text-secondary: #eee;
            --color-dark-text-primary: #333;
            --color-section-heading: #2c5282;
            --color-content-heading: #2d3748;
            --color-content-paragraph: #4a5568;
            --color-link-hover: #63b3ed;
            --color-primary-blue: #3182ce;
            --color-light-border: #718096;
            --copyright-text: #a0a0a0; /* Retained from profile.html as it's specific */
            --navbar-text-hover: #63b3ed; /* Retained as it's specific to navbar */

            /* Background colors from aboutus.css */
            --background-modal-overlay: rgba(0, 0, 0, 0.7);
            --background-shadow-light: rgba(0, 0, 0, 0.05);
            --background-page: #e0f2f7;
            --background-light-section: #f5f5f5;
            --background-light-section2: #ffffff;
            --background-header: linear-gradient(135deg, #0a3d62 0%, #061c30 100%);
            --background-content-card: #fff;
            --background-modal-header: #edf2f7;
            --background-modal-content: #ffffff;
            --background-navbar: #1a202c;
            --background-navbar-hover: #2d3748;
            --background-footer: #2d3748;

            /* Font styles */
            --font-family-poppins: 'Poppins', sans-serif;
            --font-family-inter: "Inter", sans-serif;
            --font-family-franklin: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        html {
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-family-poppins); /* Use poppins from aboutus.css */
            color: var(--color-dark-text-primary); /* Use dark text from aboutus.css */
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: var(--background-page);
        }

        /* Keyframe Animations */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Navigation Bar - DO NOT TOUCH */
        .navbar {
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;

            top: 0;
            left: 0;
            padding: 10px 30px;
            width: 100%;
            height: 4.5rem;
            z-index: 3;

            color: var(--color-light-text-primary); /* Use light text from aboutus.css */
            font-family: var(--font-family-inter); /* Use inter from aboutus.css */
            background-color: var(--background-navbar); /* Use navbar background from aboutus.css */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            margin-right: 1.5rem;
        }

        .logo img {
            height: 50px;
            margin-right: 10px;
        }

        .logo span {
            font-size: 1.2em;
            letter-spacing: 0.5px;
            font-weight: bold;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .navbar ul li a {
            color: var(--color-light-text-primary); /* Use light text from aboutus.css */
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            color: var(--navbar-text-hover);
            background: var(--background-navbar-hover); /* Use navbar hover background from aboutus.css */
            transform: translateY(-2px);
        }
        /* End Navigation Bar */

        /* Footer - DO NOT TOUCH */
        .footer {
            background-color: var(--background-footer); /* Use footer background from aboutus.css */
            color: var(--color-light-text-secondary); /* Use light text from aboutus.css */
            text-align: center;
            padding: 40px 20px;
            font-size: 1em;
            margin-top: 50px;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
        }

        .footer-content img {
            height: 100px;
            width: auto;
        }

        .footer-text {
            text-align: center;
        }

        .footer-text h3 {
            margin: 0;
            font-size: 2rem;
            color: var(--color-light-text-primary); /* Use light text from aboutus.css */
        }

        .footer-text h3 {
            margin: 0;
            font-weight: bold;
            font-size: 2rem;
            color: var(--color-light-text-primary); /* Use light text from aboutus.css */
        }

        .footer-text p {
            margin: 8px 0;
            font-size: 1em;
        }

        .footer-text .contact-info {
            font-weight: bold;
            font-size: 1.2em;
            margin: 15px 0;
        }

        .footer-links a {
            color: var(--color-link-hover); /* Use link hover from aboutus.css for footer links */
            text-decoration: none;
            margin: 0 8px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--color-light-text-primary); /* Use light text from aboutus.css */
        }

        .copyright {
            margin-top: 30px;
            font-size: 0.9rem;
            color: var(--copyright-text);
        }
        /* End Footer */

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-header h1 { /* Changed from profile-hero h1 */
                font-size: 3.2em;
            }

            .page-header p { /* Changed from profile-hero p */
                font-size: 1.4em;
            }

            .footer-content {
                flex-direction: column;
                gap: 20px;
            }

            .footer .footer-logo {
                height: 80px;
            }

            .footer-info h3 { /* No longer used, but kept for general media query structure */
                font-size: 1.3rem;
            }

            .footer-info p { /* No longer used, but kept for general media query structure */
                font-size: 0.9em;
            }

            .footer-info p.contact-info { /* No longer used, but kept for general media query structure */
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .page-header h1 { /* Changed from profile-hero h1 */
                font-size: 2.5em;
            }

            .page-header p { /* Changed from profile-hero p */
                font-size: 1.1em;
            }

            .navbar ul {
                padding-right: 0;
            }

            .footer .footer-logo {
                height: 70px;
            }

            .footer-info h3 { /* No longer used, but kept for general media query structure */
                font-size: 1.1rem;
            }

            .footer-info p { /* No longer used, but kept for general media query structure */
                font-size: 0.8em;
            }

            .footer-info p.contact-info { /* No longer used, but kept for general media query structure */
                font-size: 0.9em;
            }
        }

        /* Page Header Styles - Adapted from aboutus.css */
        .page-header {
            text-align: center;
            padding: 10rem 1rem 4rem;
            background: var(--background-header);
            color: var(--color-light-text-primary);
            margin-top: 4.5rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .page-header h1 {
            font-size: 4em;
            font-weight: 800;
            color: var(--color-light-text-primary);
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.7);
            font-family: var(--font-family-franklin);
            margin-bottom: 1rem;
            letter-spacing: 3px;
        }

        @media (min-width: 640px) {
            .page-header h1 {
                font-size: 5em;
            }
        }

        .page-header p {
            font-size: 1.5rem;
            color: var(--color-light-text-secondary);
            font-family: var(--font-family-poppins);
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
            max-width: 900px;
            margin: 1rem auto 0;
            letter-spacing: 0.5px;
        }

        @media (min-width: 640px) {
            .page-header p {
                font-size: 1.8em;
            }
        }

        /* General Section Styling - Adapted from aboutus.css */
        .content-section {
            padding: 40px 25px;
            text-align: center;
            background-color: var(--background-light-section2);
            flex-grow: 1;
            margin-bottom: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 2rem;
            animation: fadeInUp 1s ease-out;
        }

        .content-section:last-of-type {
            margin-bottom: 0;
        }

        .content-section h2 {
            font-size: 2.8em;
            color: var(--color-section-heading);
            margin-bottom: 45px;
            position: relative;
            padding-bottom: 18px;
        }

        .content-section h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 90px;
            height: 5px;
            border: none;
            background-color: var(--color-primary-blue);
            border-radius: 3px;
        }

        .content-section p {
            color: var(--color-content-paragraph);
            margin: 0 auto 1.8rem auto;
            font-size: 1.15em;
            line-height: 1.7;
        }

        .content-section p:last-child {
            margin-bottom: 0;
        }

        .profile-details-section h2 {
            /* Inherits from .content-section h2 */
            color: #D10C18; /* Retained original color for distinction */
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (min-width: 600px) {
            .profile-info-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .profile-info-item {
            display: flex;
            align-items: center;
            background-color: #f7fafd;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid var(--color-primary-blue);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .profile-info-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info-item i {
            color: var(--color-primary-blue);
            font-size: 1.5em;
            margin-right: 15px;
            width: 30px;
            text-align: center;
        }

        .profile-info-item .label {
            font-weight: 600;
            color: var(--color-content-heading);
            margin-right: 10px;
        }

        .profile-info-item .value {
            color: var(--color-content-paragraph);
            flex-grow: 1;
        }

        .profile-actions {
            text-align: center;
            margin-top: 40px;
        }

        .profile-actions button {
            background-color: #002244;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 0 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .profile-actions button:hover {
            background-color: #001a33;
            transform: translateY(-2px);
        }

        /* Styling for the Log-Out button */
        #logoutButton {
            background-color: #D10C18;
        }

        #logoutButton:hover {
            background-color: #a00a12;
        }

        .hidden {
            display: none !important;
        }

        #loginSignupSection h2 {
            color: var(--color-section-heading);
        }

        #loginSignupSection p {
            color: var(--color-content-paragraph);
        }

        #loginSignupSection .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        #loginSignupSection .action-buttons a {
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: bold;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: inline-block;
            min-width: 150px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        #loginSignupSection .action-buttons a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #loginSignupSection .action-buttons a.login-btn {
            background-color: #D10C18;
            color: white;
            border: 2px solid #D10C18;
        }

        #loginSignupSection .action-buttons a.login-btn:hover {
            background-color: #a00a12;
            border-color: #a00a12;
        }

        #loginSignupSection .action-buttons a.signup-btn {
            background-color: var(--color-primary-blue);
            color: white;
            border: 2px solid var(--color-primary-blue);
        }

        #loginSignupSection .action-buttons a.signup-btn:hover {
            background-color: var(--color-link-hover);
            border-color: var(--color-link-hover);
        }

        /* Styles for the edit form - Adapted for consistent styling */
        .edit-profile-form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 600px) {
            .edit-profile-form {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--color-content-heading);
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="date"],
        .form-group select {
            padding: 12px 15px;
            border: 1px solid var(--color-light-border);
            border-radius: 8px;
            font-size: 1em;
            color: var(--color-content-paragraph);
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background-color: var(--background-content-card);
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--color-primary-blue);
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2);
            outline: none;
        }

        .form-group input[type="date"] {
            appearance: none;
        }

        .transaction-history-section h2 {
            color: var(--color-section-heading);
        }

        .transaction-history-section p {
            color: var(--color-content-paragraph);
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            background-color: var(--background-content-card);
            border-radius: 0.8rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .history-table th,
        .history-table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        .history-table th {
            background-color: var(--color-primary-blue);
            color: white;
            font-weight: 600;
            font-size: 1em;
            text-transform: uppercase;
        }

        .history-table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .history-table tbody tr:hover {
            background-color: #e6f7ff;
            cursor: pointer;
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
            text-align: center;
            display: inline-block;
        }

        .status-paid {
            background-color: #e6ffe6;
            color: #006600;
        }

        .status-pending {
            background-color: #fffacd;
            color: #cc9900;
        }

        .status-approved {
            background-color: #e0f2f7;
            color: #007bb6;
        }

        .status-rejected {
            background-color: #ffe6e6;
            color: #cc0000;
        }
    </style>
</head>

<body>
    <nav class="navbar" role="navigation">
        <div class="logo">
            <img src="images/logo.png" alt="Municipality of Urbiztondo Logo">
            <span>Municipality of Urbiztondo</span>
        </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="appointment.php">Appointment</a></li>
            <li><a href="health.php">Health</a></li>
            <li><a href="forms.php">Forms</a></li>
            <li><a href="paytrack.php">Tracker</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="#" class="active">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="content">
        <div class="page-header">
            <h1>Your Profile</h1>
            <p id="profileIntroText">Here you can view and manage your personal information.</p>
        </div>
        <div id="personalDetailsWrapper">
            <section class="content-section" id="viewProfileSection">
                <h2>Personal Information</h2>
                <div class="profile-info-grid">
                    <div class="profile-info-item">
                        <i class="fas fa-user"></i>
                        <span class="label">Full Name:</span>
                        <span class="value" id="fullName">Jana Louise Soriano</span>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-envelope"></i>
                        <span class="label">Email:</span>
                        <span class="value" id="email">luwiluwi@gmail.com</span>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-phone"></i>
                        <span class="label">Phone:</span>
                        <span class="value" id="phone">+63 949 885 1508</span>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="label">Address:</span>
                        <span class="value" id="address">Street Fighter</span>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="label">Date of Birth:</span>
                        <span class="value" id="dob">2004-06-01</span>
                    </div>
                    <div class="profile-info-item">
                        <i class="fas fa-venus-mars"></i>
                        <span class="label">Gender:</span>
                        <span class="value" id="gender">Female</span>
                    </div>
                </div>

                <div class="profile-actions">
                    <button id="editProfileBtn">Edit Profile</button>
                    <button id="logoutButton">Log-Out</button>
                </div>
            </section>

            <section class="content-section hidden" id="editProfileSection">
                <h2>Edit Personal Information</h2>
                <form action="#" method="POST" class="edit-profile-form">
                    <div class="form-group">
                        <label for="editFullName">Full Name:</label>
                        <input type="text" id="editFullName" name="name" value="Juan Dela Cruz" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" id="editEmail" name="email" value="juan.delacruz@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone:</label>
                        <input type="tel" id="editPhone" name="mobile" value="+63 917 123 4567">
                    </div>
                    <div class="form-group">
                        <label for="editAddress">Address:</label>
                        <input type="text" id="editAddress" name="address"
                            value="123 Urbiztondo Street, Brgy. Centro, Urbiztondo, Pangasinan">
                    </div>
                    <div class="form-group">
                        <label for="editDob">Date of Birth:</label>
                        <input type="date" id="editDob" name="birth_date" value="1990-05-15">
                    </div>
                    <div class="form-group">
                        <label for="editGender">Gender:</label>
                        <select id="editGender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male" selected>Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="profile-actions" style="grid-column: 1 / -1;">
                        <button type="submit">Save Changes</button>
                        <button type="button" id="cancelEditBtn">Cancel</button>
                    </div>
                </form>
            </section>
        </div>

        <section class="content-section hidden" id="loginSignupSection">
            <h2>Welcome!</h2>
            <p>Log in to view your profile or sign up to get started.</p>
            <div class="action-buttons">
                <a href="login.html" class="login-btn">Log-In</a>
                <a href="register.html" class="signup-btn">Sign Up</a>
            </div>
        </section>

        <section class="content-section" id="transactionHistorySection">
            <h2>Transaction History</h2>
            <p>Below is a record of your permit applications and their current status.</p>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date Applied</th>
                        <th>Permit Type</th>
                        <th>Reference No.</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-06-20</td>
                        <td>Business Permit</td>
                        <td>BP-2024-00123</td>
                        <td>₱ 1,500.00</td>
                        <td><span class="status-approved status-badge">Approved</span></td>
                    </tr>
                    <tr>
                        <td>2024-05-15</td>
                        <td>Building Permit</td>
                        <td>BP-2024-00056</td>
                        <td>₱ 5,000.00</td>
                        <td><span class="status-pending status-badge">Pending</span></td>
                    </tr>
                    <tr>
                        <td>2024-04-01</td>
                        <td>Sanitary Permit</td>
                        <td>SP-2024-00789</td>
                        <td>₱ 250.00</td>
                        <td><span class="status-paid status-badge">Paid</span></td>
                    </tr>
                    <tr>
                        <td>2024-03-22</td>
                        <td>Demolition Permit</td>
                        <td>DP-2024-00021</td>
                        <td>₱ 750.00</td>
                        <td><span class="status-rejected status-badge">Rejected</span></td>
                    </tr>
                    <tr>
                        <td>2024-03-10</td>
                        <td>Electrical Permit</td>
                        <td>EP-2024-00015</td>
                        <td>₱ 300.00</td>
                        <td><span class="status-approved status-badge">Approved</span></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <img src="images/logo.png" alt="Urbiztondo Logo">
            <div class="footer-text">
                <h3>Bayan ng Urbiztondo</h3>
                <p>Pangasinan, Philippines</p>
                <p class="contact-info">
                    📞 (075) 555-1234 | 📧 contact@urbiztondo.gov.ph
                </p>
                <p class="footer-links">
                    <a href="../terms-of-use.php">Terms of Use</a> |
                    <a href="../privacy-policy.php">Privacy Policy</a>
                </p>
            </div>
            <img src="images/seal_logo.png" alt="Pangasinan Logo">
        </div>
        <p class="copyright">
            © <span id="current-year">2025</span> Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navUl = document.querySelector('.navbar ul');
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    navUl.classList.toggle('active');
                });
            }

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.dataset.target;
                    const targetDropdown = document.getElementById(targetId);
                    if (targetDropdown) {
                        targetDropdown.style.display = targetDropdown.style.display === 'block' ? 'none' :
                            'block';
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                dropdownToggles.forEach(toggle => {
                    const targetId = toggle.dataset.target;
                    const targetDropdown = document.getElementById(targetId);
                    if (targetDropdown && !toggle.contains(e.target) && !targetDropdown.contains(e.target)) {
                        targetDropdown.style.display = 'none';
                    }
                });
            });

            // Profile edit functionality (for static HTML, we simulate a logged-in state)
            const viewProfileSection = document.getElementById('viewProfileSection');
            const editProfileSection = document.getElementById('editProfileSection');
            const editProfileBtn = document.getElementById('editProfileBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const profileIntroText = document.getElementById('profileIntroText');
            const personalDetailsWrapper = document.getElementById('personalDetailsWrapper');
            const loginSignupSection = document.getElementById('loginSignupSection');

            // Simulate logged-in state by default for this static HTML
            const isLoggedIn = true; // Change to false to see the login/signup section

            if (isLoggedIn) {
                personalDetailsWrapper.classList.remove('hidden');
                loginSignupSection.classList.add('hidden');
            } else {
                personalDetailsWrapper.classList.add('hidden');
                loginSignupSection.classList.remove('hidden');
            }


            if (editProfileBtn) {
                editProfileBtn.addEventListener('click', function() {
                    viewProfileSection.classList.add('hidden');
                    editProfileSection.classList.remove('hidden');
                    if (profileIntroText) {
                        profileIntroText.innerText = "Update your personal information below.";
                    }
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function() {
                    editProfileSection.classList.add('hidden');
                    viewProfileSection.classList.remove('hidden');
                    if (profileIntroText) {
                        profileIntroText.innerText = "Here you can view and manage your personal information.";
                    }
                });
            }

            // Set current year for the footer
            document.getElementById('current-year').textContent = new Date().getFullYear();
        });
    </script>
</body>

</html>