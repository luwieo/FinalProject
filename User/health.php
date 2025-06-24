<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health and Emergency Services - Urbiztondo, Pangasinan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/health.css">
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
            <li><a href="#">Health</a></li>
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
        <h1>Health and Emergency Services</h1>
        <p>Information on health news, service schedules, and disaster preparedness in Urbiztondo, Pangasinan.</p>
    </header>

    <main>
        <section id="health-news" class="content-section">
            <h2>News about Health</h2>
            <div class="health-news-grid"> <div class="content-card">
                    <h3>July 22, 2024: Dengue Prevention Advisory</h3>
                    <p>The Urbiztondo Rural Health Unit urges all residents to actively participate in dengue prevention efforts, especially during the rainy season. Practice the "4S" strategy: <strong>Search and destroy mosquito breeding places</strong>, <strong>Self-protection measures</strong> (wearing long sleeves, using mosquito nets), <strong>Seek early consultation</strong> for fever, and <strong>Support fogging/spraying</strong> in hotspot areas. Report any stagnant water sources or suspected dengue cases to the RHU. Stay vigilant for the health of our community.</p>
                    <p><em>Source: Urbiztondo Rural Health Unit</em></p>
                </div>
                <div class="content-card">
                    <h3>June 15, 2024: Measles and Rubella Vaccination Campaign</h3>
                    <p>The Department of Health, in coordination with the Urbiztondo Rural Health Unit, reminds parents and guardians to ensure their children receive complete Measles and Rubella vaccinations. These vaccines are vital in preventing serious childhood diseases and protecting our youth. Contact the RHU for the current vaccination schedule and eligibility.</p>
                    <p><em>Source: Department of Health / Urbiztondo Rural Health Unit</em></p>
                </div>
        </section>

        <section id="health-schedules" class="content-section">
            <h2>Schedules about Health Services</h2>
            <p>Here are the general schedules for health services at the Urbiztondo Rural Health Unit.</p>
            <div class="health-schedules-grid"> <div class="content-card"><div class="content-card1">
                    <h3>Urbiztondo Rural Health Unit (RHU) - General Consultations</h3>
                    <p><strong>Location:</strong> Basista - Urbiztondo Road, Urbiztondo, 2414, Pangasinan</p>
                    <ul>
                        <li><strong>Monday - Friday:</strong> 8:00 AM - 5:00 PM</li>
                        <li>Specific services like prenatal check-ups, family planning, and immunization may have dedicated days/hours. Please inquire directly.</li>
                    </ul>
                    </div>
                    <p><em>Contact: (075) 633-3091</em></p>
                </div>
                <div id="content-card">
                    <h3>Immunization / Vaccination Services</h3>
                    <p>Routine childhood vaccinations and other government immunization programs are conducted regularly. Please contact the Urbiztondo Rural Health Unit for the most current schedule and to know what vaccines are available.</p>
                </div>
            </div>
        </section>

        <section id="health-appointments" class="content-section">
            <h2>Appointment Regarding Health</h2>
            <p>For most health services at the Urbiztondo Rural Health Unit, it is highly recommended to call ahead to inquire about specific appointment requirements or ideal visiting times. This ensures you receive timely service and helps the RHU manage patient flow.</p>
            <div class="content-card">
                <ul>
                    <li>
                        <strong>Call the Urbiztondo Rural Health Unit:</strong>
                        <p>For inquiries and to potentially set an appointment, please call: (075) 633-3091.</p>
                        <p style="margin-top: -2rem; margin-bottom: 1rem;"><em>Office Hours: Monday - Friday, 8:00 AM - 5:00 PM</em></p>
                    </li>
                    <li style="margin-bottom: 1rem;">
                        <strong>In-person Inquiry:</strong>
                        <p>You may also visit the Urbiztondo Rural Health Unit directly during their operating hours to inquire about services and appointment procedures.</p>
                    </li>
                    <li>
                        <strong>What to Bring:</strong>
                        <p>Always bring a valid ID. For specific consultations (e.g., child vaccinations, prenatal check-ups), bring relevant health records or booklets.</p>
                    </li>
                </ul>
                <p><strong>For Medical Emergencies:</strong> In case of urgent medical emergencies, do not attempt to book an appointment. Proceed immediately to the nearest hospital or call the emergency hotlines listed in the Disaster Preparedness Guide.</p>
            </div>
        </section>

        <section id="disaster-guide" class="content-section">
            <h2>Disaster Preparedness Guide - Urbiztondo, Pangasinan</h2>
            <p>Being prepared is vital for the safety of our community in Urbiztondo. This guide provides essential information for preparing for and responding to various emergencies common in our area, such as typhoons, floods, and earthquakes.</p>

            <div class="content-card">
                    <h3>Emergency Hotlines (Urbiztondo & Provincial)</h3>
                    <ul>
                        <li><strong>National Emergency Hotline:</strong> 911</li>
                        <li><strong>Philippine National Police (PNP):</strong> 117 (National) / Urbiztondo PNP: 0998-598-5112</li>
                        <li><strong>Bureau of Fire Protection (BFP):</strong>0917-189-1611</li>
                        <li><strong>Philippine Red Cross:</strong> 143 (National Hotline)</li>
                        <li><strong>Pangasinan Provincial Disaster Risk Reduction and Management Office (PDRRMO):</strong> (075) 656-3243</li>
                        <li><strong>Urbiztondo Local Disaster Risk Reduction and Management Office (LDRRMO):</strong>0915-395-2551</li>
                    </ul>
                </div>   

                <div class="disaster-guide-grid"> <div class="content-card"><div class="content-card1">
                    <h3>Build Your Emergency Go-Bag (72-Hour Kit)</h3>
                    <p>Prepare a readily accessible kit with essentials that can sustain your family for at least 72 hours. Keep it in a waterproof bag.</p>
                    <ul>
                        <li><strong>Water:</strong> 1 gallon per person per day (at least 3-day supply).</li>
                        <li><strong>Food:</strong> Non-perishable, easy-to-prepare items (canned goods, energy bars, dried fruits).</li>
                        <li><strong>First-Aid Kit:</strong> Bandages, antiseptic wipes, pain relievers, gauze, medical tape, prescribed medicines, any personal medical necessities.</li>
                        <li><strong>Flashlight & Extra Batteries / Power Bank:</strong></li>
                        <li><strong>Whistle:</strong> To signal for help.</li>
                        <li><strong>Dust Mask:</strong> To filter contaminated air.</li>
                        <li><strong>Multi-tool or Manual Can Opener:</strong></li>
                        <li><strong>Local Maps:</strong> Of Urbiztondo and surrounding areas.</li>
                        <li><strong>Cell Phone with Chargers/Power Bank:</strong></li>
                        <li><strong>Battery-powered or Hand Crank Radio:</strong> For emergency broadcasts.</li>
                        <li><strong>Important Documents:</strong> Copies of IDs, birth certificates, marriage certificates, land titles, insurance policies, bank records (all sealed in waterproof bags).</li>
                        <li><strong>Cash (small bills):</strong> ATMs and online transactions may be unavailable.</li>
                        <li><strong>Personal Sanitation Items:</strong> Soap, toothbrush, toothpaste, sanitary napkins, wet wipes.</li>
                        <li><strong>Change of Clothes:</strong> For each family member.</li>
                        <li><strong>Emergency Blanket or Sleeping Bag:</strong> For warmth.</li>
                    </ul>
                </div>
                </div>

                <div class="content-card"><div class="content-card1">
                    <h3>Specific Disaster Tips for Urbiztondo</h3>
                    <h4>Typhoon & Flood Preparedness:</h4>
                    <ul>
                        <li><strong>Monitor Weather Updates:</strong> Stay tuned to PAGASA advisories (<a href="https://www.pagasa.dost.gov.ph/" target="_blank">www.pagasa.dost.gov.ph</a>) and local government announcements.</li>
                        <li><strong>Secure Your Home:</strong> Trim tree branches, secure roofs, and loose objects outdoors.</li>
                        <li><strong>Unplug Appliances:</strong> Before a storm hits, unplug electrical appliances to prevent damage from power surges.</li>
                        <li><strong>Prepare for Evacuation:</strong> If advised to evacuate by local authorities, do so promptly. Know your designated evacuation centers in Urbiztondo.</li>
                        <li><strong>Avoid Floodwaters:</strong> Do not attempt to cross flooded areas, whether on foot or by vehicle.</li>
                    </ul>
                    <h4>Earthquake Preparedness:</h4>
                    <ul>
                        <li><strong>During an Earthquake:</strong> <i><b>DROP</b></i> to the ground, take <i><b>COVER</b></i> under a sturdy table or desk, and <i><b>HOLD ON</b></i> until the shaking stops.</li>
                        <li><strong>Stay Away:</strong> Avoid windows, mirrors, heavy furniture, and other falling objects.</li>
                        <li><strong>After an Earthquake:</strong> Check for injuries, fire hazards, and structural damage. Be prepared for aftershocks. Know how to turn off gas, electricity, and water if needed.</li>
                    </ul>
                    <h4>Fire Safety:</h4>
                    <ul>
                        <li>Regularly check electrical wiring and avoid octopus connections.</li>
                        <li>Keep flammable materials away from heat sources.</li>
                        <li>Have a fire extinguisher readily available.</li>
                        <li>Plan and practice fire escape routes from your home.</li>
                    </ul>
                    </div>
                </div>
                </div>
                <div class="content-card">
                    <h3>Family Emergency Plan</h3>
                    <ul>
                        <li><strong>Designate a Meeting Point:</strong> Choose a safe place outside your home in case of immediate evacuation, and another outside your neighborhood in case you cannot return home.</li>
                        <li><strong>Establish Communication Methods:</strong> Discuss how family members will contact each other if regular communication lines are down. Consider an out-of-town contact person.</li>
                        <li><strong>Know Your Evacuation Routes:</strong> Plan multiple safe routes out of your home and neighborhood, especially if you live in a flood-prone or landslide-prone area.</li>
                        <li><strong>Identify Safe Places at Home:</strong> Know the strongest parts of your house for an earthquake, or higher ground for floods.</li>
                        <li><strong>Practice Your Plan Regularly!</strong> Conduct family drills.</li>
                    </ul>
                </div>
            </div>  
            <p>For more detailed information and updates specific to Urbiztondo's disaster preparedness plans, please visit the official website of the Local Government Unit of Urbiztondo or contact the Urbiztondo MDRRMO directly.</p>
            <p>You can also refer to the <a href="https://ndrrmc.gov.ph/" target="_blank">National Disaster Risk Reduction and Management Council (NDRRMC)</a> for national guidelines.</p>
        </section>
    </main>

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