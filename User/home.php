<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipality of Urbiztondo</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <nav class="navbar" role="navigation">
        <div class="logo">
            <img src="images/logo.png" alt="Municipality of Urbiztondo Logo">
            <span>Municipality of Urbiztondo</span>
        </div>
        <ul>
            <li><a href="#" class="active">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="service/services.php">Services</a></li>
            <li><a href="appointment.php">Appointment</a></li>
            <li><a href="health.php">Health</a></li>
            <li><a href="forms.php">Forms</a></li>
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

    <div class="content">
        <div class="hero-carousel-inner">
            <div class="hero-slide" style="background-image: url('images/homebg3.jpg');">
                <div class="overlay" role="background"></div>
            </div>
            <div class="hero-slide" style="background-image: url('images/homebg1.png');">
                <div class="overlay" role="background"></div>
            </div>
            <div class="hero-slide" style="background-image: url('images/homebg2.png');">
                <div class="overlay" role="background"></div>
            </div>
            <div class="hero-slide" style="background-image: url('images/homebg3.jpg');">
                <div class="overlay" role="background"></div>
            </div>
            <div class="hero-slide" style="background-image: url('images/homebg1.png');">
                <div class="overlay" role="background"></div>
            </div>
        </div>
        <div class="text-content">
            <h2>Mabuhay!</h2>
            <h1>Pasimbalo Urbiztondo</h1>
            <p>Makabago, Malaya, Organisadong Bayan ng Urbiztondo</p>
        </div>
        <button class="open-prev" onclick="heroPrevSlide()">&#10094;</button>
        <button class="open-next" onclick="heroNextSlide()">&#10095;</button>
    </div>

    <section class="announcements-section" id="announcement">
        <h2>Announcements</h2>
        <div class="announcement-content-wrapper">
            <div class="announcement-carousel-area">
                <div class="announcement-container">
                    <div class="carousel-inner">
                        <div class="mySlides">
                            <div class="announcement-box">
                                <img src="images/municipalprogram.jpg" alt="Municipal Program">
                            </div>
                        </div>
                        <div class="mySlides">
                            <div class="announcement-box">
                                <img src="images/alerts.jpg" alt="Emergency Alerts">
                            </div>
                        </div>
                        <div class="mySlides">
                            <div class="announcement-box">
                                <img src="images/advisory.jpeg" alt="Public Advisory">
                            </div>
                        </div>
                        <div class="mySlides">
                            <div class="announcement-box">
                                <img src="images/municipalprogram.jpg" alt="Municipal Program">
                            </div>
                        </div>
                        <div class="mySlides">
                            <div class="announcement-box">
                                <img src="images/alerts.jpg" alt="Emergency Alerts">
                            </div>
                        </div>
                    </div>

                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
            <div class="announcement-details-area">
                <h3 id="announcement-title"></h3>
                <h6 id="announcement-date"></h6>
                <p id="announcement-description"></p>
            </div>
        </div>
    </section>

    <section class="news-section" id="news">
        <h2>News and Events</h2>
        <div class="news-grid">
            <div class="news-card">
                <img src="images/ceremony.jpg" alt="Transition Ceremony">
                <h3>Municipality of Urbiztondo Local Governance Transition Ceremony</h3>
                <p class="news-date">June 17, 2025</p>
                <p>Alinsunod sa DILG Memorandum Circular No. 2025-016, pinagasiwaan ni MLGOO Bienvenido L. Tamondong ang isinagawang Local Governance Transition Ceremony ngayong araw ng Martes, Hunyo 17 na ginanap sa MDRRMC Tactical and Operations Center.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
            <div class="news-card">
                <img src="images/drill.jpg" alt="LDRRMO News">
                <h3>2025 2nd Quarter Nationwide Simultaneous Earthquake Drill (NSED)</h3>
                <p class="news-date">June 19, 2025</p>
                <p>Conduct of CY 2025 Second Quarter Nationwide Simultaneous Earthquake Drill led by MDRRMC Chairperson Mayor Modesto M. Operania in relation to RDRRMC Memorandum No. 76, s.2025.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
            <div class="news-card">
                <img src="images/trainers.jpg" alt="Training News">
                <h3>DA-BFAR National Freshwater Technology Center Training of Trainers' Visit to Urbiztondo</h3>
                <p class="news-date">June 20, 2025</p>
                <p>Malugod na tinanggap ng butihing MAYOR Modesto M. Operania ang ngayong araw na mga bisita mula sa Department of Agriculture - Bureau of Fisheries and Aquatic Resources National Fresh Water Technology Center kasama ang mga participants mula sa iba’t ibang probinsya ng Luzon.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
    </section>

    <section class="hotlines-section" id="hotlines">
        <h2>Important Hotlines</h2>
        <div class="hotlines-grid">
            <div class="hotline-card">
                <h3>Emergency Hotline</h3>
                <p class="phone-number">📞 911</p>
                <p class="description">For immediate emergencies: Police, Fire, Medical</p>
            </div>
            <div class="hotline-card">
                <h3>Urbiztondo Local Disaster Risk Reduction and Management Office (LDRRMO)</h3>
                <p class="phone-number">📞 0915-395-2551</p>
                <p class="description">For disaster preparedness and response</p>
            </div>
            <div class="hotline-card">
                <h3>Rural Health Unit</h3>
                <p class="phone-number">📞 (075) 633-3091</p>
                <p class="description">For health-related concerns and inquiries</p>
            </div>
            <div class="hotline-card">
                <h3>Bureau of Fire and Protection</h3>
                <p class="phone-number">📞 0917-189-1611</p>
                <p class="description">For fire emergencies, fire prevention, and rescue operations.</p>
            </div>
            <div class="hotline-card">
                <h3>Philippine National Police Urbiztondo (PNP)</h3>
                <p class="phone-number">📞 0998-598-5112</p>
                <p class="description">For police assistance, crime reporting, and general emergencies.</p>
            </div>
            <div class="hotline-card">
                <h3>Urbiztondo Water District</h3>
                <p class="phone-number">📞 0916-525-1738</p>
                <p class="description">For water supply and billing inquiries</p>
            </div>
        </div>
    </section>

    <section class="social-media-section" id="social-media">
        <h2>More to Urbiztondo Online</h2>
        <div class="social-links">
            <a href="https://www.facebook.com/municipalityofurbiztondo.pangasinan" target="_blank" class="social-link-card">
                <img src="images/fb_logo.png" alt="Facebook Icon">
                <h3>Urbiztondo Facebook Page</h3>
                <p>Stay updated on the latest news and events.</p>
            </a>
            <a href="https://urbiztondo.gov.ph/home/" target="_blank" class="social-link-card">
                <img src="images/urbiztondo.png" alt="Website Icon">
                <h3>Urbiztondo Official Website</h3>
                <p>Explore official government services and information.</p>
            </a>
            <a href="https://www.pangasinan.gov.ph/city-municipalities/urbiztondo/" target="_blank" class="social-link-card">
                <img src="images/pangasinan.png" alt="Pangasinan Website Icon">
                <h3>Pangasinan Provincial Website</h3>
                <p>Learn more about the Province of Pangasinan.</p>
            </a>
        </div>
    </section>

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
        // --- Hero Carousel Logic ---
        let heroSlideIndex; // Will be initialized to point to the first REAL slide
        let heroAutoSlideInterval;
        let heroCarouselInner;
        let heroSlides;
        const totalHeroRealSlides = 3; // Number of original hero slides

        // Function to show/hide the appropriate hero slide
        function showHeroSlides(n, smoothTransition = true) {
            heroSlides = document.querySelectorAll(".hero-slide");
            heroCarouselInner = document.querySelector(".hero-carousel-inner");

            if (!heroSlides.length || !heroCarouselInner) return;

            if (smoothTransition) {
                heroCarouselInner.style.transition = "transform 1s ease-in-out";
            } else {
                heroCarouselInner.style.transition = "none"; // For instant snap back
            }

            // Adjust index for duplicated slides
            if (n > totalHeroRealSlides) { // If going past the last real slide (onto duplicated first)
                heroSlideIndex = totalHeroRealSlides + 1; // Temporarily go to the duplicated first slide
                // Then, after the transition, snap back to the actual first slide
                setTimeout(() => {
                    heroCarouselInner.style.transition = "none";
                    heroSlideIndex = 1; // Reset to the first real slide's index
                    heroCarouselInner.style.transform = `translateX(-${heroSlideIndex * heroSlides[0].clientWidth}px)`;
                }, 1000); // Must be slightly longer than the transition duration
            } else if (n < 1) { // If going before the first real slide (onto duplicated last)
                heroSlideIndex = 0; // Temporarily go to the duplicated last slide
                // Then, after the transition, snap back to the actual last slide
                setTimeout(() => {
                    heroCarouselInner.style.transition = "none";
                    heroSlideIndex = totalHeroRealSlides; // Reset to the last real slide's index
                    heroCarouselInner.style.transform = `translateX(-${heroSlideIndex * heroSlides[0].clientWidth}px)`;
                }, 1000); // Must be slightly longer than the transition duration
            } else {
                heroSlideIndex = n;
            }

            // Calculate the transform value based on the current slide index
            const slideWidth = heroSlides[0].clientWidth;
            heroCarouselInner.style.transform = `translateX(-${heroSlideIndex * slideWidth}px)`;
        }

        // Functions for hero navigation buttons
        function heroNextSlide() {
            showHeroSlides(heroSlideIndex + 1);
        }

        function heroPrevSlide() {
            showHeroSlides(heroSlideIndex - 1);
        }

        // Auto-play for hero carousel
        function startHeroAutoPlay() {
            if (heroAutoSlideInterval) {
                clearInterval(heroAutoSlideInterval);
            }
            heroAutoSlideInterval = setInterval(heroNextSlide, 3000); // Change slide every 3 seconds
        }

        function stopHeroAutoPlay() {
            clearInterval(heroAutoSlideInterval);
        }

        // --- Announcements Carousel Logic ---
        let slideIndex; // Will be initialized to point to the first REAL slide
        let autoPlayInterval;
        let carouselInner;
        let announcementDetailsArea;
        let announcementTitle;
        let announcementDate;
        let announcementDescription;
        const totalAnnouncementRealSlides = 3; // Number of original announcement slides

        const announcementsData = [
            {
                title: "Upcoming Municipal Programs and Events", // Swapped order to match your HTML
                date: "June 17, 2025",
                description: "Discover the latest initiatives, programs, and community events hosted by the Municipality of Urbiztondo. From cultural celebrations to public service projects, there's always something happening to engage and benefit our residents. Join us!",
            },
            {
                title: "Emergency Alerts for Urbiztondo Residents", // Swapped order to match your HTML
                date: "June 02, 2025",
                description: "Stay vigilant and informed during critical situations. This section provides real-time updates and important instructions from local authorities. Ensure your safety by following all advisories and preparing for contingencies.",
            },
            {
                title: "Public Advisory: Health and Safety Guidelines", // Swapped order to match your HTML
                date: "June 05, 2025",
                description: "Important notices regarding public health and safety protocols within the municipality. This includes information on local ordinances, community gatherings, and disease prevention measures. Your cooperation is vital for everyone's well-being.",
            }
        ];

        window.onload = function() {
            // Initialize Hero Carousel
            heroCarouselInner = document.querySelector(".hero-carousel-inner");
            heroSlides = document.querySelectorAll(".hero-slide");
            heroSlideIndex = 1; // Start on the first REAL slide
            showHeroSlides(heroSlideIndex, false); // Initialize without smooth transition
            startHeroAutoPlay();

            // Initialize Announcement Carousel elements
            carouselInner = document.querySelector('.carousel-inner');
            announcementDetailsArea = document.querySelector('.announcement-details-area');
            announcementTitle = document.getElementById('announcement-title');
            announcementDate = document.getElementById('announcement-date');
            announcementDescription = document.getElementById('announcement-description');

            // Initialize the Announcements Carousel
            slideIndex = 1; // Start on the first REAL slide
            showSlides(slideIndex, false); // Initialize without smooth transition
            startAutoPlay();
        };

        function plusSlides(n) {
            stopAutoPlay();
            showSlides(slideIndex + n);
            startAutoPlay();
        }

        function currentSlide(n) {
            stopAutoPlay();
            showSlides(n); // Dots should directly jump to the real slide index (1, 2, 3)
            startAutoPlay();
        }

        function showSlides(n, smoothTransition = true) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");

            if (slides.length === 0) return;

            if (smoothTransition) {
                carouselInner.style.transition = "transform 0.6s ease-in-out";
            } else {
                carouselInner.style.transition = "none"; // For instant snap back
            }

            // Handle "infinite" loop logic
            if (n > totalAnnouncementRealSlides) { // If going past the last real slide (onto duplicated first)
                slideIndex = totalAnnouncementRealSlides + 1; // Temporarily go to the duplicated first slide
                setTimeout(() => {
                    carouselInner.style.transition = "none";
                    slideIndex = 1; // Reset to the first real slide's index
                    carouselInner.style.transform = `translateX(-${slideIndex * slides[0].clientWidth}px)`;
                }, 600); // Must be slightly longer than the transition duration
            } else if (n < 1) { // If going before the first real slide (onto duplicated last)
                slideIndex = 0; // Temporarily go to the duplicated last slide
                setTimeout(() => {
                    carouselInner.style.transition = "none";
                    slideIndex = totalAnnouncementRealSlides; // Reset to the last real slide's index
                    carouselInner.style.transform = `translateX(-${slideIndex * slides[0].clientWidth}px)`;
                }, 600); // Must be slightly longer than the transition duration
            } else {
                slideIndex = n;
            }

            // Update dot active class (dots represent real slides, so index from 1 to totalRealSlides)
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            // The dot index corresponds to the real slide index (1-based)
            if (dots[slideIndex - 1]) {
                dots[slideIndex - 1].className += " active";
            }

            // Calculate the transform based on the current `slideIndex` (0 for duplicated last, 1-total for real, total+1 for duplicated first)
            const slideWidth = slides[0].clientWidth; // Use current width for responsiveness
            if (carouselInner) {
                carouselInner.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
            }

            // --- MODIFICATION START ---
            // Instead of fading the entire area, fade out the individual text elements
            if (announcementTitle) announcementTitle.style.opacity = 0;
            if (announcementDate) announcementDate.style.opacity = 0;
            if (announcementDescription) announcementDescription.style.opacity = 0;

            setTimeout(() => {
                // Ensure correct data is picked when snapping back
                let dataIndex = slideIndex;
                if (dataIndex === 0) { // If currently on the duplicated last slide
                    dataIndex = totalAnnouncementRealSlides;
                } else if (dataIndex === totalAnnouncementRealSlides + 1) { // If currently on the duplicated first slide
                    dataIndex = 1;
                }
                const currentAnnouncement = announcementsData[dataIndex - 1]; // dataIndex is 1-based

                if (announcementTitle) announcementTitle.textContent = currentAnnouncement.title;
                if (announcementDate) announcementDate.textContent = currentAnnouncement.date;
                if (announcementDescription) announcementDescription.textContent = currentAnnouncement.description;

                // Fade in the individual text elements
                if (announcementTitle) announcementTitle.style.opacity = 1;
                if (announcementDate) announcementDate.style.opacity = 1;
                if (announcementDescription) announcementDescription.style.opacity = 1;

            }, 300); // 300ms delay for fade out before content changes and fades in
            // --- MODIFICATION END ---
        }

        function startAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
            }

            autoPlayInterval = setInterval(() => {
                plusSlides(1);
            }, 4000);
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        const carouselArea = document.querySelector('.announcement-carousel-area');
        if (carouselArea) {
            carouselArea.addEventListener('mouseover', stopAutoPlay);
            carouselArea.addEventListener('mouseout', startAutoPlay);
        }

        // Add event listeners for the hero carousel container to pause on hover
        const heroContainer = document.querySelector('.content'); // Targeting the main .content div for hero hover
        if (heroContainer) {
            heroContainer.addEventListener('mouseover', stopHeroAutoPlay);
            heroContainer.addEventListener('mouseout', startHeroAutoPlay);
        }

        window.addEventListener('resize', () => {
            // Recalculate slide positions on resize to ensure responsiveness for both carousels
            showSlides(slideIndex, false); // False for no transition on resize
            showHeroSlides(heroSlideIndex, false); // False for no transition on resize
        });
    </script>
</body>
</html>