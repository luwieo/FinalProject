<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['user']['user_type'] ?? '') !== 'System Administrator') {
    header('Location: ../User/login.html?error=access_denied');
    exit;
}

require_once '../db.php';

$stmt = $pdo->prepare("SELECT * FROM payments ORDER BY payment_date DESC");
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Feedback Management - Urbiztondo</title>

  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f9;
    }

    .cms-section {
      background: #ffffff;
      padding: 30px;
      margin-bottom: 40px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      font-size: 1.15rem;
    }

    .head-title h1 {
      font-size: 2.2rem;
    }

    .badge-high { background-color: #dc3545; }
    .badge-medium { background-color: #ffc107; }
    .badge-low { background-color: #198754; }
    .badge-open { background-color: #dc3545; }
    .badge-in-progress { background-color: #ffc107; }
    .badge-resolved { background-color: #198754; }
    .modal-body pre { white-space: pre-wrap; word-wrap: break-word; }

    /* REMOVE UNDERLINE FROM SIDEBAR LINKS */
    #sidebar a {
      text-decoration: none !important;
    }
    #sidebar {
      padding-left: 0;
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
            <li>
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
            <li class="active">
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
      <i class='bx bx-menu'></i>
      <input type="checkbox" id="switch-mode" hidden>
      <label for="switch-mode" class="switch-mode"></label>
      <a href="#" class="profile">
        <img src="images1/people.png">
      </a>
    </nav>

    <main class="container my-4">
      <div class="head-title">
        <div class="left">
          <h1>Feedback Management</h1>
        </div>
      </div>

      <div class="row text-center mb-4">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body"><strong>Total Feedback:</strong> <span id="totalCount">0</span></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body"><strong>Resolved:</strong> <span id="resolvedCount">0</span></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body"><strong>High Priority:</strong> <span id="highCount">0</span></div>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Submit New Feedback</h5>
          <form id="feedbackForm">
            <div class="row g-2">
              <div class="col-md-6">
                <input type="text" class="form-control" id="name" placeholder="Your Name" required />
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" id="email" placeholder="Email Address" required />
              </div>
              <div class="col-md-6">
                <select class="form-select" id="priority" required>
                  <option value="">Select Priority</option>
                  <option value="High">High</option>
                  <option value="Medium">Medium</option>
                  <option value="Low">Low</option>
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-select" id="barangay" required>
                  <option value="">Select Barangay</option>
                  <option>Poblacion</option>
                  <option>San Juan</option>
                  <option>Camantiles</option>
                  <option>Cabaruan</option>
                  <option>Dalanguin</option>
                  <option>Malayo</option>
                  <option>Pangpang</option>
                  <option>Barangay Uno</option>
                </select>
              </div>
              <div class="col-md-6">
                <input type="file" class="form-control" id="attachment" />
              </div>
              <div class="col-12">
                <textarea class="form-control" id="message" rows="3" placeholder="Write your message..." required></textarea>
              </div>
              <div class="col-12 text-end mt-2">
                <button class="btn btn-success" type="submit">Submit Feedback</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search feedback..." />

      <table class="table table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Barangay</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="feedbackTable"></tbody>
      </table>
    </main>
  </section>

  <div class="modal fade" id="feedbackModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Feedback Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Name:</strong> <span id="modalName"></span></p>
          <p><strong>Email:</strong> <span id="modalEmail"></span> | <a href="#">View Profile</a></p>
          <p><strong>Barangay:</strong> <span id="modalBarangay"></span></p>
          <p><strong>Priority:</strong> <span id="modalPriority"></span></p>
          <p><strong>Status:</strong>
            <select class="form-select form-select-sm w-auto d-inline" id="modalStatus">
              <option>Open</option>
              <option>In Progress</option>
              <option>Resolved</option>
            </select>
          </p>
          <p><strong>Assigned To:</strong>
            <select class="form-select form-select-sm w-auto d-inline" id="modalAssigned">
              <option>Unassigned</option>
              <option>Health Department</option>
              <option>IT Admin</option>
              <option>Mayor's Office</option>
            </select>
          </p>
          <p><strong>Attachment:</strong> <a href="#" id="modalAttachment" target="_blank">View File</a></p>
          <p><strong>Message:</strong></p>
          <pre id="modalMessage"></pre>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" onclick="saveChanges()">Save Changes</button>
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const feedbacks = [];
    let selectedId = null;

    const feedbackTable = document.getElementById("feedbackTable");
    const feedbackForm = document.getElementById("feedbackForm");
    const modal = new bootstrap.Modal(document.getElementById("feedbackModal"));

    feedbackForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const priority = document.getElementById("priority").value;
      const barangay = document.getElementById("barangay").value;
      const message = document.getElementById("message").value;
      const attachment = document.getElementById("attachment").files[0]?.name || "None";

      const newFeedback = {
        id: feedbacks.length + 1,
        name,
        email,
        barangay,
        priority,
        status: "Open",
        assigned: "Unassigned",
        message,
        attachment
      };

      feedbacks.push(newFeedback);
      feedbackForm.reset();
      renderTable();
    });

    function renderTable() {
      feedbackTable.innerHTML = "";
      let resolved = 0, high = 0;

      feedbacks.forEach((fb) => {
        if (fb.status === "Resolved") resolved++;
        if (fb.priority === "High") high++;

        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${fb.id}</td>
          <td>${fb.name}</td>
          <td>${fb.barangay}</td>
          <td><span class="badge ${fb.priority === "High" ? "badge-high" : fb.priority === "Medium" ? "badge-medium" : "badge-low"}">${fb.priority}</span></td>
          <td><span class="badge ${fb.status === "Open" ? "badge-open" : fb.status === "In Progress" ? "badge-in-progress" : "badge-resolved"}">${fb.status}</span></td>
          <td>${fb.assigned}</td>
          <td><button class="btn btn-sm btn-primary" onclick="openModal(${fb.id})">View</button></td>
        `;
        feedbackTable.appendChild(row);
      });

      document.getElementById("totalCount").textContent = feedbacks.length;
      document.getElementById("resolvedCount").textContent = resolved;
      document.getElementById("highCount").textContent = high;
    }

    function openModal(id) {
      const fb = feedbacks.find(f => f.id === id);
      selectedId = id;

      document.getElementById("modalName").textContent = fb.name;
      document.getElementById("modalEmail").textContent = fb.email;
      document.getElementById("modalBarangay").textContent = fb.barangay;
      document.getElementById("modalPriority").textContent = fb.priority;
      document.getElementById("modalStatus").value = fb.status;
      document.getElementById("modalAssigned").value = fb.assigned;
      document.getElementById("modalMessage").textContent = fb.message;
      document.getElementById("modalAttachment").href = "#";

      modal.show();
    }

    function saveChanges() {
      const fb = feedbacks.find(f => f.id === selectedId);
      fb.status = document.getElementById("modalStatus").value;
      fb.assigned = document.getElementById("modalAssigned").value;
      renderTable();
      modal.hide();
    }

    document.getElementById("searchInput").addEventListener("input", function () {
      const val = this.value.toLowerCase();
      document.querySelectorAll("#feedbackTable tr").forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(val) ? "" : "none";
      });
    });
  </script>
</body>
</html>
