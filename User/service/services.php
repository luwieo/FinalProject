<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Urbiztondo, Pangasinan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-base">

    <nav class="navbar" role="navigation">
        <div class="logo">
            <img src="../images/logo.png" alt="Municipality of Urbiztondo Logo">
            <span>Municipality of Urbiztondo</span>
        </div>
        <ul>
            <li><a href="../home.php">Home</a></li>
            <li><a href="../aboutus.php">About Us</a></li>
            <li><a href="#" class="active">Services</a></li>
            <li><a href="../appointment.php">Appointment</a></li>
            <li><a href="../health.php">Health</a></li>
            <li><a href="../forms.php">Forms</a></li>
            <li><a href="../paytrack.php">Tracker</a></li>
            <li><a href="../feedback.php">Feedback</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="../profile.php">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div id="portal-container" class="portal-container">
        <div id="service-selection-view" class="service-selection-view">
            <div class="main-card">
                <h2 class="main-heading">What Service Are You Looking For?</h2>
                <div class="service-grid service-grid-spacing">
                    <button data-service="permits" class="service-btn hover-blue">
                        <span class="service-btn-title blue">Permits</span>
                        <p class="service-btn-description">Building, Business, etc.</p>
                    </button>
                    <button data-service="certificates" class="service-btn hover-green">
                        <span class="service-btn-title green">Certificates</span>
                        <p class="service-btn-description">Birth, Marriage, etc.</p>
                    </button>
                    <button data-service="clearances" class="service-btn hover-yellow">
                        <span class="service-btn-title yellow">Clearances</span>
                        <p class="service-btn-description">Police, Fire Safety, Environment, etc.</p>
                    </button>
                    <button data-service="licenses" class="service-btn hover-purple">
                        <span class="service-btn-title purple">Licenses</span>
                        <p class="service-btn-description">Marriage, etc.</p>
                    </button>
                </div>
                </div>
        </div>

        <div id="service-detail-view" class="hidden-content service-detail-view-container">
            <div class="detail-header">
                <h2 id="service-detail-title" class="detail-title"></h2>
                <button id="back-to-selection-btn" class="back-btn hover-gray">
                    &larr; Back
                </button>
            </div>
            
            <div class="tab-nav-container">
                <nav class="tab-nav" aria-label="Tabs">
                    <button data-tab="guide" class="detail-tab">Step-by-Step Guide</button>
                    <button data-tab="requirements" class="detail-tab">Requirements</button>
                    <button data-tab="application" class="detail-tab">Online Application</button>
                    <button data-tab="upload" class="detail-tab">Upload Supporting Document/s</button>
                    <button data-tab="process" class="detail-tab">Document Process</button>
                    <button data-tab="department" class="detail-tab">Department Info</button>
                </nav>
            </div>

            <div id="service-detail-content-area">
                <div id="guide-content" class="tab-pane-content"></div>
                <div id="requirements-content" class="tab-pane-content"></div>
                <div id="application-content" class="tab-pane-content"></div>
                <div id="upload-content" class="tab-pane-content"></div>
                <div id="process-content" class="tab-pane-content"></div>
                <div id="department-content" class="tab-pane-content"></div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <img src="../images/logo.png" alt="Urbiztondo Logo" onerror="this.src='https://placehold.co/100x100/CCCCCC/666666?text=Logo+Error';">
            <div class="footer-text">
                <h3>Bayan ng Urbiztondo</h3>
                <p>Pangasinan, Philippines</p>
                <p class="contact-info">
                    📞 (075) 555-1234 | 📧 contact@urbiztondo.gov.ph
                </p>
                <p class="footer-links">
                    <a href="../../terms-of-use.php">Terms of Use</a> |
                    <a href="../../privacy-policy.php">Privacy Policy</a>
                </p>
            </div>
            <img src="../images/seal_logo.png" alt="Pangasinan Logo" onerror="this.src='https://placehold.co/100x100/CCCCCC/666666?text=Seal+Error';">
        </div>
        <p class="copyright">
            © 2025 Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>

<script src="service.js"></script> 
</body>
</html>
