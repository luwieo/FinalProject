<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback - Municipality of Urbiztondo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Text colors */
            --color-light-text-primary: #fff;
            --color-light-text-secondary: #eee;
            --color-dark-text-primary: #333;
            --color-section-heading: #2c5282;
            --color-content-heading: #2d3748;
            --color-content-paragraph: #4a5568;
            --color-link-hover: #63b3ed;
            --color-primary-blue: #3182ce;
            --color-light-border: #718096;
            --color-copyright-text: #a0a0a0;
            --color-navbar-text-hover: #63b3ed;
            --color-form-heading: #002244;
            --color-form-label: #333;
            --color-form-input-text: #555;
            --color-form-small-text: #777;
            --color-submit-button: #002244;
            --color-submit-button-hover: #001a33;
            --color-form-border: #ddd;
            --color-form-focus-border: #002244;


            /* Background colors */
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
            --background-feedback-form: rgba(255, 255, 255, 0.95);

            /* Fonts */
            --font-family-poppins: 'Poppins', sans-serif;
            --font-family-inter: "Inter", sans-serif;
            --font-family-franklin: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        /* General Reset and Body Styles */
        * {
            box-sizing: border-box;
        }

        html {
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-family-poppins);
            color: var(--color-dark-text-primary);
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: var(--background-page);
        }

        /* Animations */
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

        /* Navbar Styles */
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
            color: var(--color-light-text-primary);
            font-family: var(--font-family-inter);
            background-color: var(--background-navbar);
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
            color: var(--color-light-text-primary);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            color: var(--color-navbar-text-hover);
            background: var(--background-navbar-hover);
            transform: translateY(-2px);
        }

        /* Page Header Styles */
        .page-header {
            text-align: center;
            padding: 10rem 1rem 4rem;
            background: var(--background-header);
            color: var(--color-light-text-primary);
            margin-top: 4.5rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .page-header h1 {
            font-size: 5.5em;
            font-weight: 800;
            color: var(--color-light-text-primary);
            text-shadow: 4px 4px 10px rgba(0, 0, 0, 0.7);
            font-family: var(--font-family-franklin);
            margin-bottom: 1rem;
            letter-spacing: 3px;
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

        /* Feedback Form Section */
        .feedback-form-section {
            background-color: var(--background-feedback-form);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin: 30px auto 50px auto;
            max-width: 700px;
            width: 90%;
            text-align: left;
            animation: fadeInUp 1s ease-out;
        }

        .feedback-form-section h1 {
            text-align: center;
            color: var(--color-form-heading);
            margin-bottom: 30px;
            font-size: 2.5em;
        }

        .feedback-form-section p {
            text-align: center;
            margin-bottom: 30px;
            color: var(--color-content-paragraph);
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--color-form-label);
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--color-form-border);
            border-radius: 8px;
            font-size: 1em;
            color: var(--color-form-input-text);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="tel"]:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--color-form-focus-border);
            box-shadow: 0 0 0 3px rgba(25, 12, 209, 0.2);
            outline: none;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group input[type="file"] {
            padding: 10px 0;
        }

        .form-group small {
            color: var(--color-form-small-text);
        }

        .submit-btn {
            display: block;
            width: 100%;
            background-color: var(--color-submit-button);
            color: var(--color-light-text-primary);
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: var(--color-submit-button-hover);
            transform: translateY(-2px);
        }

        /* Footer Styles */
        .footer {
            background-color: var(--background-footer);
            color: var(--color-light-text-secondary);
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
            color: var(--color-light-text-primary);
            font-weight: bold;
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
            color: var(--color-link-hover);
            text-decoration: none;
            margin: 0 8px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--color-light-text-primary);
        }

        .copyright {
            margin-top: 30px;
            font-size: 0.9rem;
            color: var(--color-copyright-text);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                gap: 20px;
            }

            .footer .footer-logo {
                height: 80px;
            }

            .footer-info h3 {
                font-size: 1.3rem;
            }

            .footer-info p {
                font-size: 0.9em;
            }

            .footer-info p.contact-info {
                font-size: 1rem;
            }

            .page-header {
                padding: 80px 20px 40px;
            }

            .page-header h1 {
                font-size: 2.5em;
            }

            .page-header p {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .navbar ul {
                padding-right: 0;
            }

            .footer .footer-logo {
                height: 70px;
            }

            .footer-info h3 {
                font-size: 1.1rem;
            }

            .footer-info p {
                font-size: 0.8em;
            }

            .footer-info p.contact-info {
                font-size: 0.9em;
            }

            .page-header {
                padding: 70px 15px 30px;
            }

            .page-header h1 {
                font-size: 2em;
            }

            .page-header p {
                font-size: 0.9em;
            }
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
            <li><a href="service/services.php">Services</a></li>
            <li><a href="appointment.php">Appointment</a></li>
            <li><a href="health.php">Health</a></li>
            <li><a href="forms.php">Forms</a></li>
            <li><a href="paytrack.php">Tracker</a></li>
            <li><a href="#" class="active">Feedback</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="page-header">
        <h1>Feedback</h1>
        <p>Your input helps us improve our services for the community.</p>
    </div>

    <main class="feedback-form-section">
        <h1>Feedback Form</h1>
        <p>
            Please fill out the form below to submit your feedback. We aim to address all concerns promptly.
        </p>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Feedback Category:</label>
                <select id="category" name="category" required>
                    <option value="">-- Select a Category --</option>
                    <option value="Concerns">Concerns</option>
                    <option value="Suggestions">Suggestions</option>
                    <option value="Complaints">Complaints</option>
                    <option value="Incident Report">Incident Report</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" placeholder="Your Full Name" required>
            </div>

            <div class="form-group">
                <label for="contactEmail">Email Address:</label>
                <input type="email" id="contactEmail" name="contactEmail" placeholder="your.email@example.com" required>
            </div>

            <div class="form-group">
                <label for="contactPhone">Phone Number (Optional):</label>
                <input type="tel" id="contactPhone" name="contactPhone" placeholder="e.g., 09XX-XXX-XXXX">
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" placeholder="Brief subject of your feedback" required>
            </div>

            <div class="form-group">
                <label for="description">Detailed Description of Feedback:</label>
                <textarea id="description" name="description"
                    placeholder="Provide a detailed description of your feedback, including any relevant details."
                    rows="6" required></textarea>
            </div>

            <div class="form-group">
                <label for="attachment">Attach Supporting Documents (Optional):</label>
                <input type="file" id="attachment" name="attachment" accept=".jpg, .jpeg, .png, .pdf">
                <small>Accepted formats: JPG, PNG, PDF</small>
            </div>

            <button type="submit" class="submit-btn">Submit Feedback</button>
        </form>
    </main>

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
            © <span id="current-year"></span> Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set current year for the footer
            document.getElementById('current-year').textContent = new Date().getFullYear();
        });
    </script>
</body>

</html>