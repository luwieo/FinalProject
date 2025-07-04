<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urbiztondo - Downloadable Forms</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-light-text-primary: #fff;
            --color-light-text-secondary: #eee;
            --color-dark-text-primary: #333;
            --color-section-heading: #2c5282;
            --color-content-heading: #2d3748;
            --color-content-paragraph: #4a5568;
            --color-link-hover: #63b3ed;
            --color-primary-blue: #3182ce;
            --color-light-border: #718096; 
            
            --background-modal-overlay: rgba(0, 0, 0, 0.7);
            --background-shadow-light: rgba(0, 0, 0, 0.05);
            --background-page: #f5f5f5;
            --background-light-section: #e0f2f7;
            --background-header: linear-gradient(135deg, #0a3d62 0%, #061c30 100%); 
            --background-content-card: #fff;
            --background-modal-header: #edf2f7;
            --background-modal-content: #ffffff;
            --background-navbar: #1a202c;
            --background-navbar-hover: #2d3748;
            --background-footer: #2d3748;

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
            font-family: var(--font-family-inter); 
            color: var(--color-dark-text-primary);
            line-height: 1.6;
            margin: 0; 
            padding: 0; 
            background-color: var(--background-page); 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }

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
            color: var(--color-link-hover);
            background: var(--background-navbar-hover);
            transform: translateY(-2px);
        }

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

        .forms-section { 
            padding: 30px 20px; 
            text-align: center;
            background-color: var(--background-light-section); 
            flex-grow: 1; 
        }

        .forms-section h2 {
            font-size: 2.5em;
            color: var(--color-section-heading); 
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }

        .forms-section h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            border: none;
            background-color: var(--color-primary-blue); 
            border-radius: 2px;
        }

        .container {
            max-width: 1280px; 
            margin: 0 auto;
            padding: 1rem;
        }
        @media (min-width: 640px) { 
            .container {
                padding: 1.5rem; 
            }
        }
        @media (min-width: 1024px) { 
            .container {
                padding: 2rem;
            }
        }

        .form-categories-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem; 
            max-width: 1000px; 
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .form-categories-grid {
                grid-template-columns: repeat(2, 1fr); 
            }
        }

        .form-category {
            background-color: var(--background-content-card); 
            border-radius: 10px; 
            box-shadow: 0 8px 20px var(--background-shadow-light); 
            padding: 2rem; 
            text-align: left; 
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
        }

        .form-category:hover {
            transform: translateY(-5px); 
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1); 
        }

        .form-category h3 {
            font-size: 1.75rem; 
            font-weight: 700; 
            color: var(--color-content-heading); 
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--color-primary-blue); 
            display: inline-block; 
        }

        .form-category > p { 
            font-size: 1em;
            color: var(--color-content-paragraph); 
            margin-top: 1rem;
            margin-bottom: 1.5rem; 
            flex-grow: 1; 
        }

        .form-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .form-list li {
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px dashed var(--color-light-border); 
        }
        .form-list li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-list a {
            display: flex;
            align-items: center;
            color: var(--color-primary-blue); 
            text-decoration: none;
            font-weight: 500;
            font-size: 1.05rem;
            transition: color 0.2s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .form-list a:hover {
            color: var(--color-link-hover); 
            transform: translateX(5px); 
        }

        .form-list a::before {
            content: "📄"; 
            margin-right: 0.75rem;
            font-size: 1.2em;
        }
        
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: var(--background-modal-overlay); 
            justify-content: center;
            align-items: center;
            opacity: 0; 
            transition: opacity 0.3s ease-out; 
        }

        .modal.is-visible {
            opacity: 1;
            display: flex; 
        }

        .modal-content {
            background-color: var(--background-modal-content); 
            border-radius: 8px;
            width: 90%; 
            max-width: 900px; 
            height: 90%; 
            max-height: 90vh; 
            display: flex;
            flex-direction: column;
            position: relative; 
            transform: scale(0.9); 
            transition: transform 0.3s ease-out; 
            overflow: hidden; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.2); 
        }

        .modal.is-visible .modal-content {
            transform: scale(1);
        }

        .modal-content.fullscreen {
            width: 100%;
            height: 100%;
            max-width: 100vw;
            max-height: 100vh;
            border-radius: 0;
            top: 0;
            left: 0;
            transform: scale(1) !important; 
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--background-modal-header); 
            border-bottom: 1px solid #ddd;
        }

        .modal-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--color-content-heading); 
            margin: 0;
            flex-grow: 1; 
        }

        .modal-controls {
            display: flex;
            gap: 10px; 
        }

        .modal-controls button {
            background: none;
            border: 1px solid var(--color-light-border); 
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s, color 0.2s;
            color: var(--color-content-paragraph);
        }

        .modal-controls button:hover {
            background-color: var(--background-shadow-light); 
            border-color: var(--color-primary-blue);
            color: var(--color-primary-blue);
        }

        .close-button, .maximize-button {
            font-weight: bold;
            line-height: 1; 
            padding: 8px 15px; 
            margin: 0; 
            font-size: 1.2em; 
            color: var(--color-content-paragraph); 
            border: 2px solid var(--color-light-border); 
            border-radius: 5px;
        }
        
        .close-button:hover,
        .close-button:focus,
        .maximize-button:hover,
        .maximize-button:focus {
            color: var(--color-primary-blue); 
            border-color: var(--color-primary-blue);
            background-color: var(--background-shadow-light); 
        }

        .pdf-iframe {
            width: 100%;
            flex-grow: 1; 
            border: none;
            overflow: auto; 
            background-color: var(--background-page); 
        }

        .footer {
            background-color: var(--background-footer);
            color: var(--color-light-text-secondary);
            text-align: center;
            padding: 40px 20px;
            font-size: 1em;
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
            color: var(--color-light-text-primary);
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
            color: var(--color-light-text-secondary);
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
            <li><a href="#" class="active">Forms</a></li>
            <li><a href="paytrack.php">Tracker</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="page-header">
        <h1>Downloadable Forms</h1>
        <p>Access official municipal forms for various permits, licenses, and certifications.</p>
    </header>

    <section class="forms-section"> 
        <div class="container">
            <h2>Available Forms</h2>
            <p style="color: var(--color-content-paragraph); max-width: 800px; margin: 0 auto 3rem auto; font-size: 1.1em;">
                Click on a form to view it directly on this page in a pop-up window. Ensure your browser supports PDF viewing.
            </p>

            <div class="form-categories-grid">
                <div class="form-category">
                    <div>
                        <h3>Permit Forms</h3>
                        <p>Forms required for various municipal permits related to construction, business, and more.</p>
                    </div>
                    <ul class="form-list">
                        <li><a href="images/permits/Building-Permit.pdf" class="pdf-link">Building Permit Application Form</a></li>
                        <li><a href="images/permits/Business-Permit2.pdf" class="pdf-link">Business Permit Application Form</a></li>
                        <li><a href="images/permits/Demolition-Permit.pdf" class="pdf-link">Demolition Permit Application Form</a></li>
                        <li><a href="images/permits/ELECTRICAL PERMIT.pdf" class="pdf-link">Electrical Permit Application Form</a></li>
                        <li><a href="images/permits/Sanitary-Permit.pdf" class="pdf-link">Sanitary Permit Application Form</a></li>
                        <li><a href="images/permits/ECC.pdf" class="pdf-link">Environmental Clearance Certificate (ECC) Application Form</a></li>
                        <li><a href="images/permits/FSIC.pdf" class="pdf-link">Fire Safety Inspection Certificate (FSIC) Application Form</a></li>
                    </ul>
                </div>

                <div class="form-category">
                    <div>
                        <h3>Certificate & Application Forms</h3>
                        <p>Forms for civil registry documents, various certifications, and other general applications.</p>
                    </div>
                    <ul class="form-list">
                        <li><a href="images/permits/Birth.pdf" class="pdf-link">Certificate of Live Birth (Application/Form)</a></li>
                        <li><a href="images/permits/CENOMAR Application Form.pdf" class="pdf-link">CENOMAR Application Form</a></li>
                        <li><a href="images/permits/death_cert.pdf" class="pdf-link">Death Certificate (Application/Form)</a></li>
                        <li><a href="images/permits/Marriage.pdf" class="pdf-link">Application for Marriage License</a></li>
                        <li><a href="images/permits/Medical Certificate.pdf" class="pdf-link">Medical Certificate Form</a></li>
                        <li><a href="images/permits/Certificate of Indigency.pdf" class="pdf-link">Certificate of Indigency Form</a></li>
                        <li><a href="images/permits/Police Clearance.pdf" class="pdf-link">Police Clearance Certificate Application Form</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div id="pdfModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pdfModalTitle">Viewing Document</h3>
                <div class="modal-controls">
                    <button class="maximize-button" id="maximizeButton">🗖</button> 
                    <button class="close-button" id="closeButton">&times;</button>
                </div>
            </div>
            <iframe id="pdfViewer" class="pdf-iframe" src="" frameborder="0"></iframe>
        </div>
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
            © 2025 Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>

    <script>
        const pdfModal = document.getElementById("pdfModal");
        const closeButton = document.getElementById("closeButton");
        const maximizeButton = document.getElementById("maximizeButton");
        const pdfViewer = document.getElementById("pdfViewer");
        const pdfModalTitle = document.getElementById("pdfModalTitle");
        const pdfLinks = document.querySelectorAll(".pdf-link");
        const modalContent = document.querySelector(".modal-content");

        let isFullscreen = false; 

        function openPdfModal(pdfPath, title) {
            pdfViewer.src = pdfPath;
            pdfModalTitle.textContent = title; 
            pdfModal.style.display = "flex"; 
            pdfModal.offsetWidth; 
            pdfModal.classList.add("is-visible"); 
            document.body.style.overflow = 'hidden'; 
        }

        function closePdfModal() {
            pdfModal.classList.remove("is-visible"); 
            modalContent.classList.remove("fullscreen"); 
            maximizeButton.textContent = '🗖'; 
            setTimeout(() => {
                pdfModal.style.display = "none"; 
                pdfViewer.src = ""; 
                pdfModalTitle.textContent = "Viewing Document"; 
                document.body.style.overflow = ''; 
                isFullscreen = false;
            }, 300); 
        }

        pdfLinks.forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault(); 
                const pdfPath = this.getAttribute("href");
                const linkTitle = this.textContent; 
                openPdfModal(pdfPath, linkTitle);
            });
        });

        closeButton.addEventListener("click", closePdfModal);

        maximizeButton.addEventListener("click", function() {
            if (isFullscreen) {
                modalContent.classList.remove("fullscreen");
                maximizeButton.textContent = '🗖'; 
            } else {
                modalContent.classList.add("fullscreen");
                maximizeButton.textContent = '🗗'; 
            }
            isFullscreen = !isFullscreen; 
        });

        window.addEventListener("click", function(event) {
            if (event.target == pdfModal) {
                closePdfModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && pdfModal.classList.contains('is-visible')) {
                closePdfModal();
            }
        });
    </script>
</body>
</html>