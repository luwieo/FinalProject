<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Municipality of Urbiztondo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/aboutus.css">
</head>
<body>
    <nav class="navbar" role="navigation">
        <div class="logo">
            <img src="images/logo.png" alt="Municipality of Urbiztondo Logo">
            <span>Municipality of Urbiztondo</span>
        </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="#" class="active">About Us</a></li>
            <li><a href="service/services.php">Services</a></li>
            <li><a href="appointment.php">Appointment</a></li>
            <li><a href="health.php">Health</a></li>
            <li><a href="forms.php">Forms</a></li>
            <li><a href="paytrack.php">Tracker</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="page-header">
        <h1>About Us</h1>
        <p>Learn more about the Municipality of Urbiztondo, its leadership, and key departments.</p>
    </header>

    <section class="headfoot-content-section">
        <h2>Welcome to Urbiztondo!</h2>
        <p>
            Welcome to the official website of the Municipality of Urbiztondo! We are a vibrant and progressive municipality in Pangasinan, committed to serving our constituents and fostering a thriving community. Our local government is dedicated to upholding transparency, promoting sustainable development, and ensuring the well-being of every Urbiztondonian.
        </p>
        <p>
            We strive to create a better quality of life for our residents through effective governance, community engagement, and innovative programs.
        </p>
    </section>

    <section class="content-section">
        <h2>Mission and Vision</h2>
        <div class="mission-vision-grid">
            <div class="content-card">
                <h3>Our Mission</h3>
                <p>
                    To deliver transparent, effective, and sustainable governance that fosters inclusive growth, protects the environment, and enhances the quality of life for all Urbiztondonians. We are committed to empowering our communities through responsive public service, robust infrastructure development, and programs that promote economic prosperity and social equity.
                </p>
            </div>
            <div class="content-card">
                <h3>Our Vision</h3>
                <p>
                    Urbiztondo envisions itself as a resilient, progressive, and peaceful municipality where empowered citizens live in harmony, benefit from equitable opportunities, and contribute to a vibrant economy supported by sustainable practices and strong cultural heritage.
                </p>
            </div>
        </div>
    </section>

    <section class="content-section">
        <h2>Our Location</h2>
        <p>Urbiztondo is strategically located in the province of Pangasinan, serving as a key center for trade and community. Explore our location on the map below:</p>
        <div class="map-container">
            <img src="images/extra_pics/map1.png" alt="Map of Urbiztondo, Pangasinan" onerror="this.src='https://placehold.co/800x450/CCCCCC/666666?text=Map+Image+Error';">
            <br>
            <a href="https://www.google.com/maps?sca_esv=6daefeacbc4166e8&rlz=1C1CHBF_enPH1074PH1074&biw=1920&bih=911&output=search&q=map+of+urbiztondo+pangasinan&source=lnms&fbs=AIIjpHwdlVWI4oi2g38E8_BbusNm3pTf6ItdW8-u0JVVBgXow2SS4XfWu_GDEb99WFnlrQR2m15IAqVMVwfCX7mqefs94fBPp-6TmUtly-FzjmA0TWPs8_xhOAEkcCWpO3zALedl08X7zxknfZ3lf2_Y7F7q7RCPbNafmugINCL1vZAa0GllZZWLPtIkumRlNMYReCXJ8lYZzMFx1jMrsUUwE2qxtpmXk5Dsz6P9NJ6d90pUJjZ1T_s&entry=mc&ved=1t:200715&ictx=111" target="_blank" class="map-button">View on Google Maps</a>
        </div>
    </section>

    <section class="content-section tourism-section">
        <h2>Discover Urbiztondo</h2>
        <p>Urbiztondo offers a rich tapestry of cultural heritage, vibrant festivals, and charming attractions. Dive into the heart of our municipality and explore what makes it unique.</p>

        <div class="content-card">
            <h3>Festivals</h3>
            <p>Experience the lively spirit of Urbiztondo through its colorful festivals, celebrating our culture, traditions, and bountiful harvests. The Kanen Festival, in particular, showcases our local delicacies.</p>
            <div class="image-grid">
                <img src="images/extra_pics/festival.jpg" alt="Urbiztondo Festival Celebration" onerror="this.src='https://placehold.co/400x200/CCCCCC/666666?text=Festival+Image+Error';">
                <img src="images/extra_pics/festival1.jpg" alt="Kanen Festival Food Bazaar" onerror="this.src='https://placehold.co/400x200/CCCCCC/666666?text=Festival+Image+Error';">
            </div>
        </div>

        <div class="content-card">
            <h3>Traditions</h3>
            <p>Our municipality cherishes long-standing traditions that reflect the values and history of our people. These customs are passed down through generations, preserving the unique identity of Urbiztondo.</p>
            <p>Further details on specific traditions will be added soon.</p>
        </div>

        <div class="content-card">
            <h3>Tourist Attractions</h3>
            <p>Urbiztondo is home to serene and significant landmarks. Visit the historic St. Pius V Parish Church, a testament to our enduring faith and architectural heritage, and other local gems.</p>
            <div class="image-grid2">
                <img src="images/extra_pics/tourist.jpg" alt="St. Pius V Parish Church in Urbiztondo">
            </div>
        </div>
    </section>

<section class="content-section leadership-section">
    <h2>Our Leadership</h2>
    <p>
        The Municipality of Urbiztondo is proudly led by a team of dedicated public servants who are committed to steering our town towards greater progress and prosperity.
    </p>

    <div class="leadership-top-row">
        <div class="mayor-card-pyramid">
            <img src="images/officials/mayor_pic.png" alt="Mayor Modesto M. Operania" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
            <h3>Hon. MODESTO M. OPERANIA</h3>
            <p>Municipal Mayor</p>
        </div>

        <div class="vice-mayor-card-pyramid">
            <img src="images/officials/vice_pic.png" alt="Vice Mayor Atty. Alexis G. Dela Vega" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
            <h3>Hon. ATTY. ALEXIS G. DELA VEGA</h3>
            <p>Municipal Vice Mayor</p>
        </div>
    </div>
    <div class="councilors-pyramid-container">
        <h3>Sangguniang Bayan Members</h3>
        <p>
            Our legislative body, plays a crucial role in crafting ordinances and policies that benefit our community.
        </p>
        <div class="councilors-grid">
            <div class="councilor-card">
                <img src="images/officials/councilor1.png" alt="Councilor Martin Raul S. Sison" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. MARTIN RAUL S. SISON</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="images/officials/councilor2.png" alt="Councilor Earick Frias" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. EARICK FRIAS</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="images/officials/councilor3.png" alt="Councilor Zenaida P. Espinoza" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. ZENAIDA P. ESPINOZA</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="images/officials/councilor4.png" alt="Councilor Rosalina B. Belen" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. ROSALINA B. BELEN</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="images/officials/councilor5.png" alt="Councilor Rodolfo Licuanan Jr" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. RODOLFO LICUANAN JR.</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="images/officials/councilor6.png" alt="Councilor Mirla D. Balolong" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. MIRLA D. BALOLONG</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="images/officials/councilor7.png" alt="Councilor Joel Frias" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. JOEL FRIAS</h4>
                <p>Municipal Councilor</p>
            </div>

            <div class="councilor-card">
                <img src="https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE" alt="Councilor Rafael P. Sison" onerror="this.src='https://placehold.co/150x150/CCCCCC/666666?text=NO+IMAGE';">
                <h4>Hon. RAFAEL P. SISON</h4>
                <p>Municipal Councilor</p>
            </div>
        </div>
    </div>
</section>

    <section class="content-section">
        <h2>Municipal Departments</h2>
        <p>
            Our municipal government operates through various departments, each dedicated to providing essential services and support to the citizens of Urbiztondo.
        </p>
        <div class="department-list-section">
            <div class="department-card">
                <h3>OFFICE OF THE MAYOR</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Overall administration, policy implementation, strategic planning.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Executive directives, community relations, special projects.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, 2nd Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>OFFICE OF THE SANGGUNIAN BAYAN</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Legislation, ordinance drafting, oversight functions.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM (Session days may vary)</span></li>
                    <li><strong>Services:</strong> <span>Policy-making, resolution of local issues, public hearings.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, 3rd Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL LOCAL GOVERNMENT OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>General administrative support to the Mayor, records management.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Issuance of permits and licenses, administrative support.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, Ground Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL BUDGET OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Budget preparation, execution, and accountability.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Budgetary consultations, financial planning assistance.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, 2nd Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL ACCOUNTING OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Financial record-keeping, auditing, disbursement.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Financial reports, payroll processing, accounts management.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, 2nd Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL TREASURER OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Revenue collection, treasury management.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Tax payments, fee collection, financial certifications.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, Ground Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL SOCIAL WELFARE AND DEVELOPMENT OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Social welfare programs, community development.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Aid for vulnerable sectors, livelihood programs, disaster relief.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall Annex, Ground Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>LOCAL REGISTRAR OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Registration of births, marriages, and deaths.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Issuance of civil registry documents, solemnization of marriages.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, Ground Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL AGRICULTURE OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Agricultural development, farmer support.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Agricultural extension, technical assistance, seed distribution.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Agricultural Building</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL ASSESSOR OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Real property assessment and valuation.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Property tax assessment, tax declarations.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, 2nd Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL ENVIRONMENTAL OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Environmental protection, waste management.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Environmental permits, clean-up drives, advocacy.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall Annex</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL ENGINEERING OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Infrastructure projects, public works maintenance.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Building permits, construction supervision, road maintenance.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Engineering Building</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>PESO OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Employment facilitation, livelihood training.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Job fair coordination, skills training, career guidance.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Hall, Ground Floor</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>MUNICIPAL LOCAL RISK REDUCTION OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Disaster preparedness, response, and risk reduction.</span></li>
                    <li><strong>Operating Hours:</strong> <span>24/7 (Emergency Response), M-F 8:00 AM - 5:00 PM (Admin)</span></li>
                    <li><strong>Services:</strong> <span>Disaster awareness campaigns, emergency response, relief operations.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Municipal Disaster Operations Center</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>RURAL HEALTH OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Public health services, community health programs.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Medical consultations, vaccinations, health education.</span></li>
                    <li><strong>Location of Offices:</strong> <span>Urbiztondo Rural Health Unit</span></li>
                </ul>
            </div>

            <div class="department-card">
                <h3>BIR OFFICE</h3>
                <ul>
                    <li><strong>Responsibilities:</strong> <span>Tax collection, taxpayer assistance.</span></li>
                    <li><strong>Operating Hours:</strong> <span>Monday - Friday, 8:00 AM - 5:00 PM</span></li>
                    <li><strong>Services:</strong> <span>Tax registration, filing assistance, tax advisory.</span></li>
                    <li><strong>Location of Offices:</strong> <span>BIR Urbiztondo Branch Office</span></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="content-section ordinance-section">
        <h2>Municipal Ordinances and Resolutions</h2>
        <p>
            The Sangguniang Bayan of Urbiztondo is committed to enacting and implementing ordinances and resolutions that promote welfare, order, and progress within the municipality.
        </p>

        <div class="content-card">
            <h3>Ordinances</h3>
            <p>
                Ordinances are local laws passed by the Sangguniang Bayan. They cover a wide range of subjects, from public safety and health to business regulations and environmental protection.
            </p>
            <ul>
                <li>
                    <strong>Municipal Ordinance No. 2024-001:</strong> <span>"An Ordinance Prohibiting the Use of Single-Use Plastics and Regulating the Use of Plastic Bags within the Municipality of Urbiztondo, Providing Penalties Therefor, and For Other Purposes."</span>
                </li>
                <li>
                    <strong>Municipal Ordinance No. 2024-002:</strong> <span>"An Ordinance Mandating the Implementation of a Curfew for Minors from 10:00 PM to 4:00 AM in All Public Places within Urbiztondo, Except Under Certain Conditions, and Prescribing Penalties for Violations Thereof."</span>
                </li>
                <li>
                    <strong>Municipal Ordinance No. 2024-003:</strong> <span>"An Ordinance Establishing a Green Code for Urbiztondo, Promoting Urban Greening and Sustainable Landscaping Practices, and Providing Incentives for Compliance."</span>
                </li>
            </ul>
        </div>

        <div class="content-card">
            <h3>Regulations</h3>
            <p>
                Regulations provide the specific rules and procedures for implementing ordinances and other local government policies. They ensure the smooth and effective operation of municipal services.
            </p>
            <ul>
                <li>
                    <strong>Regulation on Business Permit Application:</strong> <span>"Detailed procedures for the submission, processing, and approval of new business permits and renewals, including required documents and fees."</span>
                </li>
                <li>
                    <strong>Regulation on Public Market Sanitation:</strong> <span>"Guidelines for maintaining cleanliness, proper waste disposal, and hygiene standards within the municipal public market, applicable to all vendors and patrons."</span>
                </li>
                <li>
                    <strong>Regulation on Noise Pollution Control:</strong> <span>"Rules and permissible decibel levels for various activities in residential and commercial areas, along with procedures for reporting and addressing noise complaints."</span>
                </li>
            </ul>
        </div>

        <div class="content-card">
            <h3>Resolutions</h3>
            <p>
                Resolutions are formal expressions of opinion, intent, or policy by the Sangguniang Bayan, often used for administrative matters, acknowledgements, or expressing a stance on a particular issue.
            </p>
            <ul>
                <li>
                    <strong>Resolution No. 2024-010:</strong> <span>"A Resolution Expressing Profound Gratitude and Commendation to the Urbiztondo Rural Health Unit for its Exemplary Service During the Recent Health Outreach Program."</span>
                </li>
                <li>
                    <strong>Resolution No. 2024-011:</strong> <span>"A Resolution Approving the Annual Investment Plan for Calendar Year 2024, Highlighting Priority Projects for Infrastructure Development and Social Services."</span>
                </li>
                <li>
                    <strong>Resolution No. 2024-012:</strong> <span>"A Resolution Urging the Department of Public Works and Highways (DPWH) to Expedite the Repair and Rehabilitation of National Road Sections within Urbiztondo."</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="content-section">
        <h2>Transparency Seal</h2>
        <div class="content-transparency-card">
            <img src="images/Transparency-Seal.jpg" alt="Urbiztondo Transparency Seal">
            <div class="content-transparency-details">
                <h3>Symbolism</h3>
                <p>A pearl buried inside a tightly-shut shell is practically worthless. Government information is a pearl, meant to be shared with the public in order to maximize its inherent value.</p>
                <p>The Transparency Seal, depicted by a pearl shining out of an open shell, is a symbol of a policy shift towards openness in access to government information. On the one hand, it hopes to inspire Filipinos in the civil service to be more open to citizen engagement; on the other, to invite the Filipino citizenry to exercise their right to participate in governance. This initiative is envisioned as a step in the right direction towards solidifying the position of the Philippines as the Pearl of the Orient – a shining example for democratic virtue in the region.</p>
            </div>
        </div>
    </section>

    <section class="headfoot-content-section">
        <p>
            Together, our elected officials work hand-in-hand with our community to address challenges, implement impactful programs, and build a brighter future for Urbiztondo. We encourage you to explore our website to learn more about our services, projects, and initiatives.
        </p>
    </section>

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
        // Fallback for image loading errors
        document.querySelectorAll('img').forEach(img => {
            img.onerror = function() {
                this.src = 'https://placehold.co/150x150/CCCCCC/666666?text=Image+Error';
            };
        });
    </script>
</body>
</html>