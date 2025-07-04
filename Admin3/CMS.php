<?php
session_start();

// Check if user is logged in AND if they are an admin
if (!isset($_SESSION['user_id']) || ($_SESSION['user']['user_type'] ?? 'Resident') !== 'System Administrator') {
    // Not logged in or not an admin, redirect to login page (in User folder)
    header('Location: ../User/login.html?error=access_denied');
    exit;
}

// If they are an admin, display the admin content
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin CMS - Urbiztondo</title>

  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard.css">

  <style>
    :root {
      --accent-blue: #3b82f6;
      --bg-card: #ffffff;
      --bg-light: #f0f4f8;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f9;
    }

    .cms-section {
      background: var(--bg-card);
      padding: 30px;
      margin-bottom: 40px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      font-size: 1.15rem;
    }

    .form-label {
      font-weight: 600;
      font-size: 1.1rem;
    }

    .form-control, textarea {
      font-size: 1.1rem !important;
      padding: 14px 18px;
      width: 100%;
      max-width: 100%;
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    .preview {
      margin-top: 15px;
      padding: 20px;
      border-radius: 5px;
      background: #f9f9f9;
      border: 1px dashed #ccc;
    }

    .preview img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .nav-tabs {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .nav-tabs button {
      padding: 12px 20px;
      font-size: 1.2rem;
      border: none;
      background-color: var(--bg-light);
      cursor: pointer;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .nav-tabs button.active {
      background-color: var(--accent-blue);
      color: white;
    }

    .cms-section-wrapper {
      display: none;
    }

    .cms-section-wrapper.active {
      display: block;
    }

    .head-title h1 {
      font-size: 2.2rem;
    }
  </style>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/logo.png" id="logo">
            <span class="text">Urbiztondo <br> Admin Portal</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="dashboard.php" data-target="dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="analytics.php" data-target="analytics">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Application Management</span>
                </a>
            </li>
            <li>
                <a href="usermanagement.php" data-target="user-management">
                    <i class='bx bx-user'></i>
                    <span class="text">User Management</span>
                </a>
            </li>
            <li>
                <a href="appointments.php" data-target="appointment">
                    <i class='bx bx-calendar'></i>
                    <span class="text">Appointment</span>
                </a>
            </li>
            <li>
                <a href="finance_dashboard.php" data-target="finance">
                    <i class='bx bxs-bank'></i>
                    <span class="text">Finance</span>
                </a>
            </li>
            <li class="active">
                <a href="CMS.php" class="admin-cms-link">
                    <i class='bx bxs-edit'></i>
                    <span class="text">Admin CMS</span>
                </a>
            </li>
            <li>
                <a href="com&notiffinal.php" class="admin-cms-link">
                    <i class='bx bxs-bell'></i>
                    <span class="text">Comm & Notif</span>
                </a>
            </li>
            <li>
                <a href="feedbackfinal.php" class="admin-cms-link">
                    <i class='bx bxs-comment-detail'></i>
                    <span class="text">Feedback</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu bottom">
            <li>
                <a href="settings" class="settings" data-target="settings">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="log-out" class="logout" data-target="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

  <section id="content">
    <nav>
      <i class='bx bx-menu' ></i>
      <input type="checkbox" id="switch-mode" hidden>
      <label for="switch-mode" class="switch-mode"></label>
      <a href="#" class="profile">
        <img src="images1/people.png">
      </a>
    </nav>

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Admin CMS</h1>
        </div>
      </div>

      <div class="nav-tabs">
        <button class="tab-btn active" data-tab="home"> Home</button>
        <button class="tab-btn" data-tab="announcements"> Announcements</button>
        <button class="tab-btn" data-tab="news"> News & Events</button>
        <button class="tab-btn" data-tab="about"> About Us</button>
        <button class="tab-btn" data-tab="departments"> Departments</button>
        <button class="tab-btn" data-tab="ordinances"> Ordinances</button>
        <button class="tab-btn" data-tab="health"> Health</button>
        <button class="tab-btn" data-tab="terms"> Terms</button>
        <button class="tab-btn" data-tab="privacy"> Privacy</button>
      </div>

            <!-- Home Section -->
      <div id="home" class="cms-section-wrapper active">
        <div class="cms-section">
          <h4> Home Section</h4>
          <label class="form-label">Welcome Message</label>
          <textarea class="form-control" rows="3" placeholder="Enter welcome message here...">Welcome to the Municipality of Urbiztondo!</textarea>

          <label class="form-label mt-3">Banner Image</label>
          <input type="file" class="form-control" onchange="previewImage(this, 'homeBannerPreview')">
          <div id="homeBannerPreview" class="preview"></div>
        </div>
      </div>

      <!-- Announcements Section -->
      <div id="announcements" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> Announcements</h4>
          <label class="form-label">Announcement Title</label>
          <input type="text" class="form-control" placeholder="e.g. Urbiztondo Fiesta Advisory">

          <label class="form-label mt-3">Details</label>
          <textarea class="form-control" rows="4" placeholder="Write full announcement content..."></textarea>

          <label class="form-label mt-3">Optional Image</label>
          <input type="file" class="form-control" onchange="previewImage(this, 'announcementPreview')">
          <div id="announcementPreview" class="preview"></div>

          <label class="form-label mt-3">Date</label>
          <input type="date" class="form-control">
        </div>
      </div>

      <!-- News & Events Section -->
      <div id="news" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> News & Events</h4>

          <label class="form-label">Title</label>
          <input type="text" class="form-control" placeholder="e.g. New Covered Court Inaugurated">

          <label class="form-label mt-3">Content</label>
          <textarea class="form-control" rows="5" placeholder="Write full news or event content..."></textarea>

          <label class="form-label mt-3">Optional Image Upload</label>
          <input type="file" class="form-control" onchange="previewImage(this, 'newsImagePreview')">
          <div id="newsImagePreview" class="preview"></div>

          <label class="form-label mt-3">Optional YouTube Video Link</label>
          <input type="url" class="form-control" placeholder="Paste YouTube embed link here (https://youtube.com/embed/...)">
        </div>
      </div>

            <!-- About Us Section -->
      <div id="about" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> About Us</h4>
          <label class="form-label">Mission</label>
          <textarea class="form-control" rows="3" placeholder="Write mission..."></textarea>

          <label class="form-label mt-3">Vision</label>
          <textarea class="form-control" rows="3" placeholder="Write vision..."></textarea>

          <label class="form-label mt-3">Optional Image</label>
          <input type="file" class="form-control" onchange="previewImage(this, 'aboutPreview')">
          <div id="aboutPreview" class="preview"></div>
        </div>
      </div>

      <!-- Departments Section -->
      <div id="departments" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> Departments</h4>
          <label class="form-label">Department Name</label>
          <input type="text" class="form-control" placeholder="e.g. Municipal Agriculture Office">

          <label class="form-label mt-3">Description</label>
          <textarea class="form-control" rows="4" placeholder="Describe the department..."></textarea>

          <label class="form-label mt-3">Image or Logo</label>
          <input type="file" class="form-control" onchange="previewImage(this, 'deptPreview')">
          <div id="deptPreview" class="preview"></div>
        </div>
      </div>

      <!-- Ordinances Section -->
      <div id="ordinances" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> Municipal Ordinances</h4>
          <label class="form-label">Ordinance Title</label>
          <input type="text" class="form-control" placeholder="e.g. Ordinance No. 123 - Waste Management">

          <label class="form-label mt-3">Upload PDF File</label>
          <input type="file" class="form-control">
        </div>
      </div>

      <!-- Health Section -->
      <div id="health" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> Health & Emergency</h4>
          <label class="form-label">Emergency Hotline</label>
          <input type="text" class="form-control" placeholder="e.g. 911, Brgy Hotline">

          <label class="form-label mt-3">Important Info</label>
          <textarea class="form-control" rows="3" placeholder="Enter other emergency or health-related info..."></textarea>
        </div>
      </div>

      <!-- Terms Section -->
      <div id="terms" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> Terms and Conditions</h4>
          <textarea class="form-control" rows="6" placeholder="Enter terms and conditions..."></textarea>
        </div>
      </div>

      <!-- Privacy Section -->
      <div id="privacy" class="cms-section-wrapper">
        <div class="cms-section">
          <h4> Privacy Policy</h4>
          <textarea class="form-control" rows="6" placeholder="Enter privacy policy..."></textarea>
        </div>
      </div>

      <!-- Save Button -->
      <div class="text-end mt-4">
        <button class="btn btn-success" style="font-size: 1.2rem; padding: 10px 25px;">✅ Save All Changes</button>
      </div>
    </main>
  </section>

  <!-- Tab and Image Preview Script -->
  <script>
    document.querySelectorAll('.tab-btn').forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.cms-section-wrapper').forEach(tab => tab.classList.remove('active'));
        button.classList.add('active');
        document.getElementById(button.dataset.tab).classList.add('active');
      });
    });

    function previewImage(input, targetId) {
      const target = document.getElementById(targetId);
      target.innerHTML = '';
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.style.maxWidth = '100%';
          img.style.borderRadius = '8px';
          target.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>
