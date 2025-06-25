<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Privacy Policy - Municipality of Urbiztondo E-Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* text colors */
            --text: #fff;
            --light-text: #eee;
            --dark-text: #333;
            --copyright-text: #a0a0a0;
            --navbar-text-hover: #63b3ed;
            --footer-link: #87cefa;

            /* background colors */
            --navbar: #1a202c;
            --navbar-hover: #2d3748;
            --footer: #2d3748;
            --section2: #e0f2f7; 

            /* font styles */
            --poppins: 'Poppins', sans-serif;
            --inter: "Inter", sans-serif;
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
            font-family: var(--poppins);
            color: var(--dark-text);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: var(--section2);
        }

        /* Navigation Bar */
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
            
            color: var(--text);
            font-family: var(--inter);
            background-color: var(--navbar);
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
            color: var(--text);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            color: var(--navbar-text-hover);
            background: var(--navbar-hover);
            transform: translateY(-2px);
        }
        /* End Navigation Bar */

        /* Footer */
        .footer {
            background-color: var(--footer);
            color: var(--light-text);
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
            flex-wrap: wrap;
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
            font-weight: bold;
            font-size: 2rem;
            color: var(--text);
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
            color: var(--footer-link);
            text-decoration: none;
            margin: 0 8px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--text);
        }

        .copyright {
            margin-top: 30px;
            font-size: 0.9rem;
            color: var(--copyright-text);
        }

        /* End Footer */

    /* Content specific styles */
    .content-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1s ease-in;
        margin-top: 100px;
    }

    .content-container h1 {
        text-align: center;
        color: #0044cc;
        margin-bottom: 30px;
        font-size: 2.5em;
    }

    .content-container h2 {
        color: #0044cc;
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 1.8em;
    }

    .content-container p {
        line-height: 1.6;
        margin-bottom: 15px;
        color: #555;
    }

    .content-container ul {
        list-style: disc;
        margin-left: 20px;
        margin-bottom: 15px;
        color: #555;
    }

    .content-container ol {
        list-style: decimal;
        margin-left: 20px;
        margin-bottom: 15px;
        color: #555;
    }

    .content-container li {
        margin-bottom: 8px;
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
            <li><a href="User/home.php">Home</a></li>
            <li><a href="User/aboutus.php">About Us</a></li>
            <li><a href="User/service/services.php">Services</a></li>
            <li><a href="User/appointment.php">Appointment</a></li>
            <li><a href="User/health.php">Health</a></li>
            <li><a href="User/forms.php">Forms</a></li>
            <li><a href="User/paytrack.php">Tracker</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="User/profile.php">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="content-container">
        <h1>Privacy Policy for Urbiztondo E-Services</h1>
        <p><em>Last Updated: June 7, 2025</em></p>

        <p>The Municipality of Urbiztondo is committed to protecting your privacy. This Privacy Policy explains how we
            collect, use, disclose, and protect your personal information when you use our E-Services website.</p>

        <h2>1. Information We Collect</h2>
        <p>We may collect various types of information from and about users of our Website, including:</p>
        <ul>
            <li><strong>Personal Information:</strong> Information that can identify you personally, such as your name,
                email address, phone number, physical address, and any other information you provide when filling out
                forms (e.g., complaint forms, permit applications).</li>
            <li><strong>Technical Data:</strong> Information about your device and internet connection, such as your IP
                address, browser type, operating system, and usage patterns on our Website. This is collected
                automatically as you navigate through the site.</li>
            <li><strong>Attachments:</strong> Any documents or images you upload as part of your submissions.</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <p>We use the information we collect for various purposes, including:</p>
        <ul>
            <li>To process your applications, complaints, and requests for services.</li>
            <li>To communicate with you regarding your submissions and to provide updates on their status.</li>
            <li>To improve the functionality and user experience of our Website and E-Services.</li>
            <li>To comply with legal obligations and government regulations.</li>
            <li>For internal record keeping and administrative purposes.</li>
            <li>To ensure the security of our Website and prevent fraud.</li>
        </ul>

        <h2>3. Disclosure of Your Information</h2>
        <p>We may disclose your personal information to:</p>
        <ul>
            <li>Relevant departments within the Municipality of Urbiztondo to fulfill your requests or address your
                concerns.</li>
            <li>Third-party service providers who assist us in operating our Website or providing our services (e.g., IT
                support, data hosting), strictly under confidentiality agreements.</li>
            <li>Government agencies or other entities as required by law, subpoena, or legal process.</li>
            <li>In case of a complaint, information may be shared with the party against whom the complaint is filed, as
                necessary to resolve the issue.</li>
        </ul>
        <p>We will not sell, rent, or lease your personal information to third parties for marketing purposes.</p>

        <h2>4. Data Security</h2>
        <p>We implement reasonable security measures to protect your personal information from unauthorized access, use,
            alteration, or disclosure. However, no data transmission over the internet or electronic storage method can
            be guaranteed to be 100% secure. Therefore, while we strive to protect your personal information, we cannot
            guarantee its absolute security.</p>

        <h2>5. Your Rights</h2>
        <p>Depending on applicable laws and regulations, you may have the right to:</p>
        <ul>
            <li>Access the personal information we hold about you.</li>
            <li>Request correction of inaccurate or incomplete personal information.</li>
            <li>Object to the processing of your personal information under certain circumstances.</li>
            <li>Request deletion of your personal information under certain circumstances.</li>
        </ul>
        <p>To exercise any of these rights, please contact us using the contact information provided below.</p>

        <h2>6. Changes to Our Privacy Policy</h2>
        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal
            requirements. We will post any changes on this page and update the "Last Updated" date. We encourage you to
            review this Privacy Policy periodically.</p>

        <h2>7. Contact Information</h2>
        <p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:
        </p>
        <p>Municipality of Urbiztondo<br>
            Email: contact@urbiztondo.gov.ph<br>
            Phone: (075) 555-1234</p>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <img src="images/logo.png" alt="Urbiztondo Logo" onerror="this.src='https://placehold.co/100x100/CCCCCC/666666?text=Logo+Error';">
            <div class="footer-text">
                <h3>Bayan ng Urbiztondo</h3>
                <p>Pangasinan, Philippines</p>
                <p class="contact-info">
                    📞 (075) 555-1234 | 📧 contact@urbiztondo.gov.ph
                </p>
                <p class="footer-links">
                    <a href="terms-of-use.php">Terms of Use</a> |
                    <a href="#">Privacy Policy</a>
                </p>
            </div>
            <img src="images/seal_logo.png" alt="Pangasinan Logo" onerror="this.src='https://placehold.co/100x100/CCCCCC/666666?text=Seal+Error';">
        </div>
        <p class="copyright">
            © 2025 Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dropdown menu logic
        const toggles = document.querySelectorAll(".dropdown-toggle");
        toggles.forEach(toggle => {
            toggle.addEventListener("click", function(e) {
                e.preventDefault();
                const dropdownId = this.getAttribute("data-target");
                const dropdown = document.getElementById(dropdownId);

                document.querySelectorAll(".dropdown").forEach(d => {
                    if (d !== dropdown) d.style.display = "none";
                });

                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });
        });
        document.addEventListener("click", function(e) {
            if (!e.target.closest(".dropdown-container")) {
                document.querySelectorAll(".dropdown").forEach(d => {
                    d.style.display = "none";
                });
            }
        });

        // Mobile menu toggle logic
        const menuToggle = document.querySelector(".menu-toggle");
        const navList = document.querySelector(".navbar ul");
        menuToggle.addEventListener("click", function() {
            navList.classList.toggle("active");
        });
    });
    </script>
</body>

</html>