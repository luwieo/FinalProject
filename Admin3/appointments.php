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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/usermanagement.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <title>Admin Portal - Appointment Management</title>
    <style>
        /* Custom styles that might not be covered directly by Tailwind or to override defaults */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
            color: #374151; /* Default text color */
        }
        body.dark {
            background-color: #1a202c; /* Dark mode background */
            color: #e2e8f0; /* Dark mode text color */
        }

        /* Adjustments for the main content area */
        #admin-app {
            padding: 2rem; /* Tailwind p-8 equivalent */
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Specific styles for status select to ensure consistent badge-like appearance */
        .status-select {
            appearance: none;
            text-align: center;
            border: none;
            padding: 0.375rem 0.75rem; /* py-1 px-3 */
            border-radius: 9999px; /* rounded-full */
            font-size: 0.75rem; /* text-xs */
            font-weight: 600; /* font-semibold */
            color: white;
            cursor: pointer;
            min-width: 100px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05); /* shadow-sm */
            transition: background-color 0.2s ease, transform 0.1s ease;
        }
        .status-select:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08); /* shadow-md */
        }

        /* Specific background colors for status options */
        .status-select.status-booked { background-color: #3B82F6; /* blue-500 */ }
        .status-select.status-pending { background-color: #FBBF24; /* amber-400 or yellow-500 */ }
        .status-select.status-completed { background-color: #22C55E; /* green-500 */ }
        .status-select.status-cancelled { background-color: #EF4444; /* red-500 */ } /* Keeping red for cancelled as it signifies a negative state */

        /* Modal specific styles for animation */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal.show {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); /* shadow-xl */
            text-align: center;
            max-width: 90%;
            width: 450px;
            transform: translateY(20px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .modal.show .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
        body.dark .modal-content {
            background-color: #2d3748; /* Dark mode background for modal */
        }

        .success-icon {
            height: 4.5rem;
            width: 4.5rem;
            color: #22C55E; /* green-500 */
            margin: 0 auto 1.5rem auto;
            animation: bounceIn 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
        }

        @keyframes bounceIn {
          0% {
            transform: scale(0.3);
            opacity: 0;
          }
          50% {
            transform: scale(1.05);
            opacity: 1;
          }
          70% {
            transform: scale(0.9);
          }
          100% {
            transform: scale(1);
            opacity: 1;
          }
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
            <li class="active">
                <a href="appointment.php" data-target="appointment">
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
            <a href="profile.html" class="profile">
                <img src="images/people.png">
            </a>
        </nav>

        <main>
            <div id="admin-app" class="container">
                </div>
        </main>
    </section>

    <script src="js/dashboard.js"></script>
    <script>
        // No Firebase imports needed as data persistence is not required

        // Admin User ID (for demonstration, a real system would have authentication)
        const adminUserId = 'admin-user-001';

        // Service definitions for the booking system
        // These are intentionally kept here as a global data source for this demo.
        // In a real application, these would come from a database shared by both admin and user sides.
        const services = [
            { id: 'in_person_transaction', name: 'In-Person Transaction', duration: 60, description: 'General in-person transaction for various municipal services.' },
            { id: 'document_pickup', name: 'Document Pickup', duration: 60, description: 'Schedule a time to pick up prepared documents.' },
            { id: 'medical_consultation', name: 'Medical Consultation', duration: 60, description: 'Book a consultation with a municipal health officer.' },
            { id: 'grievance_meeting', name: 'Grievance Meeting', duration: 60, description: 'Schedule a meeting to address grievances or complaints.' },
            { id: 'consultation', name: 'Consultation', duration: 60, description: 'General consultation for inquiries or advice on municipal matters.' },
        ];

        // Central state object for the admin application
        let state = {
            error: '', // General error message for admin actions
            adminServices: [...services], // Admin's editable list of services (copy of initial services)
            editingServiceId: null, // ID of the service being edited in admin panel
            simulatedAppointments: [ // Simulated appointments for admin view
                { id: 'app001', serviceName: 'In-Person Transaction', serviceId: 'in_person_transaction', date: new Date().toISOString().split('T')[0], time: '09:00 AM', userName: 'Michael Famador', userEmail: 'famador.michael@gmail.com', userPhone: '555-1234', status: 'booked', timestamp: new Date().toISOString(), userId: 'guest-user-123' },
                { id: 'app002', serviceName: 'Medical Consultation', serviceId: 'medical_consultation', date: new Date().toISOString().split('T')[0], time: '10:30 AM', userName: 'Mylene Esquilona', userEmail: 'esquilona.mylene@gmail.com', userPhone: '555-5678', status: 'booked', timestamp: new Date().toISOString(), userId: 'guest-user-123' },
                { id: 'app003', serviceName: 'Grievance Meeting', serviceId: 'grievance_meeting', date: new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().split('T')[0], time: '02:00 PM', userName: 'Kim Napatutan', userEmail: 'napatutan.kim@gmail.com', userPhone: '555-9012', status: 'pending', timestamp: new Date().toISOString(), userId: 'guest-user-123' },
            ],
            showConfirmationModal: false,
            confirmationMessage: '',
        };

        // --- Utility Functions (duplicated for self-containment of this file) ---

        /**
         * Formats an ISO date string and time string into a human-readable date and time.
         * @param {string} dateISO - ISO string of the date.
         * @param {string} time - Time string (e.g., "09:00 AM").
         * @returns {string} Formatted date and time string.
         */
        const formatAppointmentDate = (dateISO, time) => {
            const d = new Date(dateISO);
            // Combine date part from ISO and time part for accurate Date object creation
            const dateTimeString = `${d.getFullYear()}-${(d.getMonth() + 1).toString().padStart(2, '0')}-${d.getDate().toString().padStart(2, '0')} ${time}`;
            const appointmentDateTime = new Date(dateTimeString);
            return appointmentDateTime.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        };

        // --- Admin Functions ---

        /**
         * Handles adding a new service from the admin panel.
         * @param {Event} e - The form submission event.
         */
        function handleAddService(e) {
            e.preventDefault();
            const serviceName = document.getElementById('newServiceName').value;
            const serviceDuration = parseInt(document.getElementById('newServiceDuration').value);
            const serviceDescription = document.getElementById('newServiceDescription').value;

            if (!serviceName || !serviceDuration || !serviceDescription) {
                state.error = "All fields are required to add a service.";
                renderAdminApp();
                return;
            }

            const newService = {
                id: serviceName.toLowerCase().replace(/\s/g, '_').slice(0, 20), // Simple ID generation, truncate to avoid very long IDs
                name: serviceName,
                duration: serviceDuration,
                description: serviceDescription
            };

            // Check for duplicate ID (simple check)
            if (state.adminServices.some(s => s.id === newService.id)) {
                state.error = "A service with this generated ID already exists. Please choose a unique name.";
                renderAdminApp();
                return;
            }

            state.adminServices.push(newService); // Add to the admin's view of services
            state.error = ''; // Clear error
            document.getElementById('addServiceForm').reset(); // Clear form
            renderAdminApp();
            console.log("Service added:", newService);
            handleAdminActionSuccess('New service added successfully!');
        }

        /**
         * Sets a service for editing in the admin panel.
         * @param {string} serviceId - The ID of the service to edit.
         */
        function handleEditService(serviceId) {
            state.editingServiceId = serviceId;
            const serviceToEdit = state.adminServices.find(s => s.id === serviceId);
            if (serviceToEdit) {
                // Defer rendering to ensure elements exist before setting value
                requestAnimationFrame(() => {
                    const editServiceNameInput = document.getElementById('editServiceName');
                    const editServiceDurationInput = document.getElementById('editServiceDuration');
                    const editServiceDescriptionTextarea = document.getElementById('editServiceDescription');

                    if (editServiceNameInput) editServiceNameInput.value = serviceToEdit.name;
                    if (editServiceDurationInput) editServiceDurationInput.value = serviceToEdit.duration;
                    if (editServiceDescriptionTextarea) editServiceDescriptionTextarea.value = serviceToEdit.description;
                });
            }
            renderAdminApp();
        }

        /**
         * Handles updating an existing service from the admin panel.
         * @param {Event} e - The form submission event.
         */
        function handleUpdateService(e) {
            e.preventDefault();
            const serviceId = state.editingServiceId;
            const updatedName = document.getElementById('editServiceName').value;
            const updatedDuration = parseInt(document.getElementById('editServiceDuration').value);
            const updatedDescription = document.getElementById('editServiceDescription').value;

            if (!updatedName || !updatedDuration || !updatedDescription) {
                state.error = "All fields are required to update a service.";
                renderAdminApp();
                return;
            }

            const adminServiceIndex = state.adminServices.findIndex(s => s.id === serviceId);
            if (adminServiceIndex !== -1) {
                state.adminServices[adminServiceIndex] = {
                    ...state.adminServices[adminServiceIndex],
                    name: updatedName,
                    duration: updatedDuration,
                    description: updatedDescription
                };
            }

            state.editingServiceId = null; // Exit editing mode
            state.error = ''; // Clear error
            renderAdminApp();
            console.log("Service updated:", state.adminServices.find(s => s.id === serviceId));
            handleAdminActionSuccess('Service updated successfully!');
        }

        /**
         * Handles canceling the service editing process.
         */
        function handleCancelEdit() {
            state.editingServiceId = null;
            state.error = '';
            renderAdminApp();
        }

        /**
         * Handles deleting a service from the admin panel.
         * @param {string} serviceId - The ID of the service to delete.
         */
        function handleDeleteService(serviceId) {
            // Using a custom modal instead of `confirm` as per instructions
            showCustomConfirm('Are you sure you want to delete this service? This action cannot be undone.', () => {
                const initialLength = state.adminServices.length;
                state.adminServices = state.adminServices.filter(s => s.id !== serviceId);

                if (state.adminServices.length < initialLength) {
                    state.error = ''; // Clear any previous error
                    state.editingServiceId = null; // Ensure editing mode is off if deleted
                    renderAdminApp();
                    console.log("Service deleted:", serviceId);
                    handleAdminActionSuccess('Service deleted successfully!');
                } else {
                    state.error = "Failed to delete service. It might not exist.";
                    renderAdminApp();
                }
            });
        }

        /**
         * Simulates changing the status of an appointment.
         * In a real app, this would update a database.
         * @param {string} appointmentId - The ID of the appointment to update.
         * @param {string} newStatus - The new status ('booked', 'pending', 'completed', 'cancelled').
         */
        function handleChangeAppointmentStatus(appointmentId, newStatus) {
            const appointmentIndex = state.simulatedAppointments.findIndex(app => app.id === appointmentId);
            if (appointmentIndex !== -1) {
                state.simulatedAppointments[appointmentIndex].status = newStatus;
                renderAdminApp(); // Re-render to reflect status change visually
                handleAdminActionSuccess(`Appointment ${appointmentId} status changed to ${newStatus}.`);
            } else {
                state.error = `Appointment ${appointmentId} not found.`;
                renderAdminApp();
            }
        }

        /**
         * Shows a success confirmation modal for admin actions.
         * @param {string} message - The message to display.
         */
        function handleAdminActionSuccess(message) {
            state.confirmationMessage = message;
            state.showConfirmationModal = true;
            renderAdminApp();
            setTimeout(() => {
                state.showConfirmationModal = false;
                renderAdminApp();
            }, 3000);
        }

        /**
         * Shows a custom confirmation dialog.
         * @param {string} message - The message to display.
         * @param {Function} onConfirm - Callback if user confirms.
         */
        function showCustomConfirm(message, onConfirm) {
            const modalHtml = `
                <div class="modal" id="customConfirmModal">
                    <div class="modal-content">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Confirm Action</h3>
                        <p class="text-gray-600 mb-6">${message}</p>
                        <div class="flex justify-center space-x-4">
                            <button id="confirmYes" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Yes</button>
                            <button id="confirmNo" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">No</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            requestAnimationFrame(() => { // Ensure modal is rendered before adding 'show' class
                document.getElementById('customConfirmModal').classList.add('show');
            });


            document.getElementById('confirmYes').onclick = () => {
                onConfirm();
                document.getElementById('customConfirmModal').remove();
            };
            document.getElementById('confirmNo').onclick = () => {
                document.getElementById('customConfirmModal').remove();
            };
        }

        // --- Render Functions (responsible for generating HTML strings) ---

        /**
         * Renders the common header section for the admin panel.
         * @returns {string} HTML string for the header.
         */
        function renderAdminHeader() {
            return `
                <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 text-center rounded-t-xl">
                    <h1 class="text-4xl font-extrabold mb-2">Municipal Admin Dashboard</h1>
                    <p class="text-xl font-light">Manage Services & Appointments</p>
                </header>
            `;
        }

        /**
         * Renders the common footer section for the admin panel.
         * @returns {string} HTML string for the footer.
         */
        function renderAdminFooter() {
            return `
                <footer class="bg-gray-100 p-6 text-center text-gray-600 text-sm border-t rounded-b-xl">
                    <p>&copy; 2025 Municipal Services. Admin Panel.</p>
                    <p class="mt-2">Note: All data here is simulated and not persistent.</p>
                </footer>
            `;
        }

        /**
         * Renders the Admin Dashboard page.
         * @returns {string} HTML string for the Admin Dashboard.
         */
        function renderAdminPageContent() {
            // Sort appointments by date and time for better readability
            const sortedAppointments = [...state.simulatedAppointments].sort((a, b) => {
                const dateA = new Date(`${a.date} ${a.time}`);
                const dateB = new Date(`${b.date} ${b.time}`);
                return dateA - dateB;
            });

            const today = new Date().toISOString().split('T')[0];
            const todayAppointments = sortedAppointments.filter(app => app.date === today);

            return `
                <div class="space-y-8">
                    <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Admin Dashboard</h2>

                    ${state.error ? `<p class="bg-blue-100 text-blue-600 p-2 rounded-md border border-blue-200 mb-4 text-center font-semibold">${state.error}</p>` : ''}

                    <section class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Today's Appointments Overview (${new Date().toLocaleDateString()})</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            ${state.adminServices.map(service => {
                                const serviceAppointmentsToday = todayAppointments.filter(app => app.serviceName === service.name);
                                return `
                                    <div class="bg-white p-4 rounded-md shadow-sm border border-blue-100">
                                        <p class="text-lg font-semibold text-blue-600">${service.name}</p>
                                        <p class="text-gray-700 text-xl font-bold">${serviceAppointmentsToday.length} <span class="text-base font-normal">appointments</span></p>
                                    </div>
                                `;
                            }).join('')}
                        </div>
                    </section>

                    <section class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Manage Services</h3>

                        <div class="mb-6 border-b pb-4 border-gray-200">
                            <h4 class="text-xl font-semibold text-gray-700 mb-3">Add New Service</h4>
                            <form id="addServiceForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="newServiceName" class="block text-gray-700 text-sm font-bold mb-1">Service Name:</label>
                                    <input type="text" id="newServiceName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="newServiceDuration" class="block text-gray-700 text-sm font-bold mb-1">Duration (minutes):</label>
                                    <input type="number" id="newServiceDuration" min="5" step="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div class="col-span-full">
                                    <label for="newServiceDescription" class="block text-gray-700 text-sm font-bold mb-1">Description:</label>
                                    <textarea id="newServiceDescription" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                </div>
                                <div class="col-span-full">
                                    <button type="submit" id="addServiceButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                        Add Service
                                    </button>
                                </div>
                            </form>
                        </div>

                        <h4 class="text-xl font-semibold text-gray-700 mb-3">Existing Services</h4>
                        <ul class="divide-y divide-gray-200">
                            ${state.adminServices.map(service => `
                                <li class="py-3 flex flex-col md:flex-row justify-between items-start md:items-center">
                                    <div class="mb-2 md:mb-0">
                                        <p class="text-lg font-medium text-gray-900">${service.name} (${service.duration} mins)</p>
                                                            <p class="text-sm text-gray-600">${service.description}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-1 px-3 rounded-md edit-service-btn" data-service-id="${service.id}">Edit</button>
                                        <button class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-1 px-3 rounded-md delete-service-btn" data-service-id="${service.id}">Delete</button>
                                    </div>
                                </li>
                            `).join('')}
                        </ul>

                        ${state.editingServiceId ? `
                            <div class="mt-6 border-t pt-4 border-gray-200">
                                <h4 class="text-xl font-semibold text-gray-700 mb-3">Edit Service: ${state.adminServices.find(s => s.id === state.editingServiceId)?.name || ''}</h4>
                                <form id="editServiceForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="editServiceName" class="block text-gray-700 text-sm font-bold mb-1">Service Name:</label>
                                        <input type="text" id="editServiceName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                    <div>
                                        <label for="editServiceDuration" class="block text-gray-700 text-sm font-bold mb-1">Duration (minutes):</label>
                                        <input type="number" id="editServiceDuration" min="5" step="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                    <div class="col-span-full">
                                        <label for="editServiceDescription" class="block text-gray-700 text-sm font-bold mb-1">Description:</label>
                                        <textarea id="editServiceDescription" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                    </div>
                                    <div class="col-span-full flex space-x-2">
                                        <button type="submit" id="updateServiceButton" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                            Update Service
                                        </button>
                                        <button type="button" id="cancelEditButton" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        ` : ''}
                    </section>

                    <section class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">All Simulated Appointments</h3>
                        ${sortedAppointments.length === 0 ? `
                            <p class="text-gray-600 text-center">No simulated appointments yet.</p>
                        ` : `
                            <ul class="divide-y divide-gray-200">
                                ${sortedAppointments.map(app => `
                                    <li class="py-3 flex flex-col md:flex-row justify-between items-start md:items-center">
                                        <div class="mb-2 md:mb-0">
                                            <p class="text-lg font-medium text-gray-900">${app.serviceName}</p>
                                            <p class="text-sm text-gray-700"><strong>${formatAppointmentDate(app.date, app.time)}</strong></p>
                                            <p class="text-sm text-gray-600">Booked by: ${app.userName} (${app.userEmail})</p>
                                            <p class="text-xs text-gray-500">User ID: ${app.userId}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <select class="status-select" data-appointment-id="${app.id}">
                                                <option value="booked" ${app.status === 'booked' ? 'selected' : ''}>BOOKED</option>
                                                <option value="pending" ${app.status === 'pending' ? 'selected' : ''}>PENDING</option>
                                                <option value="completed" ${app.status === 'completed' ? 'selected' : ''}>COMPLETED</option>
                                                <option value="cancelled" ${app.status === 'cancelled' ? 'selected' : ''}>CANCELLED</option>
                                            </select>
                                        </div>
                                    </li>
                                `).join('')}
                            </ul>
                        `}
                    </section>
                </div>
            `;
        }

        /**
         * Renders the confirmation modal for admin actions.
         * @returns {string} HTML string for the confirmation modal, or empty string if not visible.
         */
        function renderConfirmationModal() {
            if (!state.showConfirmationModal) return '';
            return `
                <div class="modal" id="confirmationModal">
                    <div class="modal-content">
                        <div class="success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Success!</h3>
                        <p class="text-gray-600 mb-6">${state.confirmationMessage}</p>
                        <button id="close-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                            Close
                        </button>
                    </div>
                </div>
            `;
        }


        // --- Event Listener Attachment (after DOM is rendered) ---

        /**
         * Attaches all necessary event listeners to dynamically rendered elements for the admin panel.
         * This function must be called after every `renderAdminApp()` call.
         */
        function attachAdminEventListeners() {
            const adminAppDiv = document.getElementById('admin-app');
            if (!adminAppDiv) return;

            // Add Service Form
            const addServiceForm = document.getElementById('addServiceForm');
            if (addServiceForm) addServiceForm.onsubmit = handleAddService;

            // Edit Service buttons
            adminAppDiv.querySelectorAll('.edit-service-btn').forEach(button => {
                button.onclick = (e) => handleEditService(e.currentTarget.dataset.serviceId);
            });
            // Delete Service buttons
            adminAppDiv.querySelectorAll('.delete-service-btn').forEach(button => {
                button.onclick = (e) => handleDeleteService(e.currentTarget.dataset.serviceId);
            });

            // Update/Cancel Edit Service Form
            const editServiceForm = document.getElementById('editServiceForm');
            if (editServiceForm) editServiceForm.onsubmit = handleUpdateService;
            const cancelEditButton = document.getElementById('cancelEditButton');
            if (cancelEditButton) cancelEditButton.onclick = handleCancelEdit;

            // Appointment Status Change
            adminAppDiv.querySelectorAll('.status-select').forEach(select => { // Corrected selector
                select.onchange = (e) => {
                    const appointmentId = e.currentTarget.dataset.appointmentId;
                    const newStatus = e.currentTarget.value;
                    handleChangeAppointmentStatus(appointmentId, newStatus);
                    // Update class for visual styling immediately
                    e.currentTarget.className = 'status-select status-' + newStatus;
                };
                // Initial status styling when rendered
                select.classList.add('status-' + select.value);
            });

            // Confirmation modal close button listener
            const closeModalButton = document.getElementById('close-modal');
            if (closeModalButton) closeModalButton.onclick = () => {
                state.showConfirmationModal = false;
                // Remove the 'show' class to trigger fade out before removal
                document.getElementById('confirmationModal').classList.remove('show');
                setTimeout(() => {
                    // Only remove the element after the transition (if any)
                    document.getElementById('confirmationModal').remove();
                    renderAdminApp(); // Re-render to ensure state is clean
                }, 300); // Match CSS transition duration
            };
             // If a confirmation modal exists and is meant to be shown, add the 'show' class
            const confirmationModal = document.getElementById('confirmationModal');
            if (confirmationModal && state.showConfirmationModal) {
                confirmationModal.classList.add('show');
            }
        }

        // --- Main Admin Render Function ---

        /**
         * The primary function that re-renders the entire admin application based on the current `state`.
         * This function should be called whenever the admin application state changes.
         */
        function renderAdminApp() {
            const adminAppDiv = document.getElementById('admin-app');
            if (!adminAppDiv) return;

            adminAppDiv.innerHTML = `
                ${renderAdminHeader()}
                <main class="p-8">
                    ${renderAdminPageContent()}
                </main>
                ${renderAdminFooter()}
                ${renderConfirmationModal()}
            `;
            // Attach event listeners after the new HTML has been inserted into the DOM
            attachAdminEventListeners();
        }

        // Initial render call when the DOM is fully loaded for the admin page
        document.addEventListener('DOMContentLoaded', () => {
            renderAdminApp(); // Initial render of the admin app
        });
    </script>
</body>
</html>