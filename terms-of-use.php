<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Terms of Use - Municipality of Urbiztondo E-Services</title>
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
        <h1>Terms of Use for Urbiztondo E-Services</h1>
        <p><em>Last Updated: June 7, 2025</em></p>

        <p>Welcome to the official E-Services website of the Municipality of Urbiztondo. By accessing or using this
            website, you agree to be bound by these Terms of Use and all applicable laws and regulations. If you do not
            agree with any of these terms, you are prohibited from using or accessing this site.</p>

        <h2>1. Acceptance of Terms</h2>
        <p>These Terms of Use govern your access and use of all content and functionalities available at [Your Website
            URL, e.g., urbiztondo.gov.ph/eservices] (the "Website"). The Municipality of Urbiztondo reserves the right
            to update or modify these Terms at any time without prior notice. Your continued use of the Website after
            any such changes constitutes your acceptance of the new Terms.</p>

        <h2>2. Use of the Website</h2>
        <ul>
            <li>You agree to use the Website only for lawful purposes and in a manner that does not infringe the rights
                of, or restrict or inhibit the use and enjoyment of this Website by any third party.</li>
            <li>You are responsible for ensuring that any information you provide on this Website is accurate, complete,
                and up-to-date.</li>
            <li>Unauthorized use of this Website may give rise to a claim for damages and/or be a criminal offense.</li>
        </ul>

        <h2>3. Intellectual Property Rights</h2>
        <p>All content on this Website, including text, graphics, logos, images, and software, is the property of the
            Municipality of Urbiztondo or its content suppliers and is protected by intellectual property laws. You may
            not reproduce, distribute, modify, display, or create derivative works from any part of this Website without
            prior written permission from the Municipality of Urbiztondo.</p>

        <h2>4. Disclaimer of Warranties</h2>
        <p>This Website and its content are provided "as is" without any warranties, express or implied, including, but
            not limited to, implied warranties of merchantability, fitness for a particular purpose, or non-infringement
            of intellectual property or other violation of rights. The Municipality of Urbiztondo does not warrant that
            the Website will be uninterrupted, error-free, or free from viruses or other harmful components.</p>

        <h2>5. Limitation of Liability</h2>
        <p>In no event shall the Municipality of Urbiztondo or its officials, employees, or agents be liable for any
            damages (including, without limitation, damages for loss of data or profit, or due to business interruption)
            arising out of the use or inability to use the materials on the Municipality of Urbiztondo's Website, even
            if the Municipality of Urbiztondo or an authorized representative has been notified orally or in writing of
            the possibility of such damage. This limitation of liability applies to the fullest extent permitted by law.
        </p>

        <h2>6. Links to Third-Party Websites</h2>
        <p>This Website may contain links to third-party websites that are not owned or controlled by the Municipality
            of Urbiztondo. The Municipality of Urbiztondo has no control over, and assumes no responsibility for, the
            content, privacy policies, or practices of any third-party websites. You acknowledge and agree that the
            Municipality of Urbiztondo shall not be responsible or liable, directly or indirectly, for any damage or
            loss caused or alleged to be caused by or in connection with the use of or reliance on any such content,
            goods, or services available on or through any such websites.</p>

        <h2>7. Governing Law</h2>
        <p>These Terms of Use shall be governed by and construed in accordance with the laws of the Republic of the
            Philippines, without regard to its conflict of law provisions.</p>

        <h2>8. Contact Information</h2>
        <p>If you have any questions about these Terms of Use, please contact us at:</p>
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
                    <a href="#">Terms of Use</a> |
                    <a href="privacy-policy.php">Privacy Policy</a>
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