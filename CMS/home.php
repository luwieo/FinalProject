<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Municipality of Urbiztondo</title>
    <link rel="stylesheet" href="index.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@700&display=swap"
        rel="stylesheet" />
</head>

<body>
    <header class="hero">
        <div class="overlay"></div>
        <nav class="navbar" role="navigation">
            <div class="logo">
                <img src="images/logo.png" alt="Municipality of Urbiztondo Logo" />
                <span>Municipality of Urbiztondo</span>
            </div>
            <button class="menu-toggle" aria-label="Toggle menu">☰</button>
            <ul>
                <li><a href="#">Home</a></li>
                <li class="dropdown-container">
                    <a href="#" class="dropdown-toggle" data-target="forms-dropdown">Forms ▼</a>
                    <div class="dropdown" id="forms-dropdown">
                        <a href="building-permit.php">Building Permit</a>
                        <a href="business-permit.php">Business Permit</a>
                        <a href="sanitary-permit.php">Sanitary Permit</a>
                        <a href="demolition-permit.php">Demolition Permit</a>
                        <a href="electrical-permit.php">Electrical Permit</a>
                        <a href="complaints.php">Complaints</a>
                    </div>
                </li>
                <li><a href="tracker.php">Status Tracker</a></li>
                <li><a href="hotlines.php">Hotlines</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Log out</a></li>
                <?php else: ?>
                <li><a href="login.php">Log-in/Register</a></li>
                <?php endif; ?>
            </ul>

        </nav>
        <div class="content">
            <h1>Municipality of Urbiztondo</h1>
            <p>
                Discover local news, city services, and initiatives that bring our
                community together.
            </p>
            <a href="dashboard.html" class="btn">Dashboard</a>
        </div>
    </header>

    <section class="info-section" id="about">
        <div class="about-container">
            <div class="about-box">
                <div class="about-image">
                    <img src="images/about.jpg" alt="Overview of Urbiztondo Municipality" />
                </div>
                <div class="about-text">
                    <h2>About Us</h2>
                    <p>
                        Welcome to <strong>Urbiztondo</strong>, a vibrant municipality in
                        Pangasinan, known for its strong community, agricultural roots,
                        and steady progress.
                    </p>
                    <p>
                        With 21 barangays, our town embraces unity, resilience, and
                        tradition, while supporting sustainable development and public
                        service excellence.
                    </p>
                    <p>
                        Our Kanen Festival is a joyful celebration of culture, delicacies,
                        and togetherness.
                    </p>
                    <p>
                        <strong>Experience Urbiztondo—where tradition meets progress, and
                            everyone feels at home.</strong>
                    </p>
                    <div class="about-links">
                        <a href="https://www.philatlas.com/luzon/r01/pangasinan/urbiztondo.html">➤ Background</a>
                        <a
                            href="https://www.google.com/maps/place/Urbiztondo,+Pangasinan/@15.818796,120.2594627,12z/data=!3m1!4b1!4m6!3m5!1s0x339151dadf4e07f3:0xf4512834b64d1907!8m2!3d15.8201173!4d120.3550808!16zL20vMDZqenNo?entry=ttu&g_ep=EgoyMDI1MDYwNC4wIKXMDSoASAFQAw%3D%3D">➤
                            Direction</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
require_once 'db.php'; // make sure this points to your PDO connection
$stmt = $pdo->query("SELECT * FROM news ORDER BY publish_date DESC LIMIT 3");
$newsItems = $stmt->fetchAll();
?>

    <section class="news-section" id="news">
        <h2>News and Events</h2>
        <div class="news-grid">
            <?php foreach ($newsItems as $news): ?>
            <div class="news-card">
                <?php if (!empty($news['image'])): ?>
                <img src="PIO/<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>">
                <?php endif; ?>
                <h3><?= htmlspecialchars($news['title']) ?></h3>
                <p class="news-date"><?= date("F j, Y", strtotime($news['publish_date'])) ?></p>
                <p><?= mb_strimwidth(strip_tags($news['content']), 0, 160, '...') ?></p>
                <a href="news_view.php?id=<?= $news['id'] ?>" class="read-more">Read More</a>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="news_archive.php" class="read-more" style="font-size: 1.1rem;">View All News & Events</a>
        </div>

    </section>

    <footer class="footer">
        <div class="footer-content">
            <img src="images/logo.png" alt="Urbiztondo Logo" />
            <div class="footer-text">
                <h3>Bayan ng Urbiztondo</h3>
                <p>Pangasinan, Philippines</p>
                <p class="contact-info">
                    📞 (075) 555-1234 | 📧 contact@urbiztondo.gov.ph
                </p>
                <p class="footer-links">
                    <a href="terms-of-use.php">Terms of Use</a> |
                    <a href="privacy-policy.php">Privacy Policy</a>
                </p>
            </div>
            <img src="images/seal_logo.png" alt="Pangasinan Logo" />
        </div>
        <p class="copyright">
            © 2025 Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggles = document.querySelectorAll(".dropdown-toggle");

        toggles.forEach((toggle) => {
            toggle.addEventListener("click", function(e) {
                e.preventDefault();
                const dropdownId = this.getAttribute("data-target");
                const dropdown = document.getElementById(dropdownId);

                document.querySelectorAll(".dropdown").forEach((d) => {
                    if (d !== dropdown) d.style.display = "none";
                });

                dropdown.style.display =
                    dropdown.style.display === "block" ? "none" : "block";
            });
        });
        document.addEventListener("click", function(e) {
            if (!e.target.closest(".dropdown-container")) {
                document.querySelectorAll(".dropdown").forEach((d) => {
                    d.style.display = "none";
                });
            }
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.querySelector(".menu-toggle");
        const navList = document.querySelector(".navbar ul");
        menuToggle.addEventListener("click", function() {
            navList.classList.toggle("active");
        });
    });
    </script>
</body>

</html>