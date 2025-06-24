<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urbiztondo - Appointment Scheduling</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/appointment.css">
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
            <li><a href="#">Appointment</a></li>
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

    <div class="space">
        </div>

    <div id="app" class="container">
        </div>

    <script>
        let userId = 'guest-user-123';

        const services = [
            { id: 'in_person_transaction', name: 'In-Person Transaction', duration: 60, description: 'General in-person transaction for various municipal services.' },
            { id: 'document_pickup', name: 'Document Pickup', duration: 60, description: 'Schedule a time to pick up prepared documents.' },
            { id: 'medical_consultation', name: 'Medical Consultation', duration: 60, description: 'Book a consultation with a municipal health officer.' },
            { id: 'grievance_meeting', name: 'Grievance Meeting', duration: 60, description: 'Schedule a meeting to address grievances or complaints.' },
            { id: 'consultation', name: 'Consultation', duration: 60, description: 'General consultation for inquiries or advice on municipal matters.' },
        ];

        let state = {
            currentStep: 1,
            selectedService: null,
            selectedDate: null,
            selectedTime: null,
            showConfirmationModal: false,
            confirmationMessage: '',
            currentMonth: new Date(),
            selectedDateAppointments: [],
            loadingSlots: false,
            error: '',
            simulatedAppointments: [
                { id: 'APP001', serviceName: 'In-Person Transaction', serviceId: 'in_person_transaction', date: new Date().toISOString().split('T')[0], time: '09:00 AM', userName: 'John Doe', userEmail: 'john.doe@example.com', userPhone: '555-1234', status: 'booked', timestamp: new Date().toISOString(), userId: 'guest-user-123' },
                { id: 'APP002', serviceName: 'Medical Consultation', serviceId: 'medical_consultation', date: new Date().toISOString().split('T')[0], time: '10:30 AM', userName: 'Jane Smith', userEmail: 'jane.smith@example.com', userPhone: '555-5678', status: 'booked', timestamp: new Date().toISOString(), userId: 'guest-user-123' },
                { id: 'APP003', serviceName: 'Grievance Meeting', serviceId: 'grievance_meeting', date: new Date(new Date().setDate(new Date().getDate() + 1)).toISOString().split('T')[0], time: '02:00 PM', userName: 'Peter Jones', userEmail: 'peter.jones@example.com', userPhone: '555-9012', status: 'pending', timestamp: new Date().toISOString(), userId: 'guest-user-123' },
            ]
        };

        const generateTimeSlots = (duration) => {
            const slots = [];
            for (let hour = 9; hour < 17; hour++) {
                for (let minute = 0; minute < 60; minute += duration) {
                    const time = new Date();
                    time.setHours(hour, minute, 0, 0);
                    slots.push(time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
                }
            }
            return slots;
        };

        const getDaysInMonth = (date) => {
            const year = date.getFullYear();
            const month = date.getMonth();
            return new Date(year, month + 1, 0).getDate();
        };

        const getFirstDayOfMonth = (date) => {
            const year = date.getFullYear();
            const month = date.getMonth();
            return new Date(year, month, 1).getDay();
        };

        const formatAppointmentDate = (dateISO, time) => {
            const d = new Date(dateISO);
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

        async function fetchAppointmentsForDate(date, serviceId) {
            state.loadingSlots = true;
            state.error = '';
            renderApp();

            await new Promise(resolve => setTimeout(resolve, 500));

            const dateString = date.toISOString().split('T')[0];
            state.selectedDateAppointments = state.simulatedAppointments
                .filter(app => app.date === dateString && app.serviceId === serviceId)
                .map(app => app.time);

            state.loadingSlots = false;
            renderApp();
        }

        function handleServiceSelect(service) {
            state.selectedService = service;
            state.currentStep = 2;
            state.selectedDate = null;
            state.selectedTime = null;
            state.currentMonth = new Date();
            fetchAppointmentsForDate(new Date(), service.id);
            renderApp();
        }

        function handleTimeSelect(date, time) {
            state.selectedDate = date;
            state.selectedTime = time;
            state.currentStep = 3;
            renderApp();
        }

        function handleBookingSuccess(message, appointmentId = '') {
            state.confirmationMessage = message + (appointmentId ? `<br>Your Appointment ID: <strong>${appointmentId}</strong>` : '');
            state.showConfirmationModal = true;
            renderApp();
            setTimeout(() => {
                state.showConfirmationModal = false;
                state.currentStep = 1;
                state.selectedService = null;
                state.selectedDate = null;
                state.selectedTime = null;
                state.error = '';
                renderApp();
            }, 3000);
        }

        function navigateBack() {
            if (state.currentStep > 1) {
                state.currentStep--;
                state.error = '';
                if (state.currentStep === 2) {
                    if (state.selectedService) {
                        const targetDate = state.selectedDate || new Date(state.currentMonth.getFullYear(), state.currentMonth.getMonth(), 1);
                        fetchAppointmentsForDate(targetDate, state.selectedService.id);
                    }
                }
                renderApp();
            }
        }

        function cancelBooking() {
            state.currentStep = 1;
            state.selectedService = null;
            state.selectedDate = null;
            state.selectedTime = null;
            state.error = '';
            renderApp();
        }

        function handleMonthChange(offset) {
            const newMonth = new Date(state.currentMonth.getFullYear(), state.currentMonth.getMonth() + offset, 1);
            const today = new Date();
            if (newMonth.getFullYear() < today.getFullYear() || (newMonth.getFullYear() === today.getFullYear() && newMonth.getMonth() < today.getMonth())) {
                return;
            }
            state.currentMonth = newMonth;
            if (state.selectedService) {
                const firstDayOfNewMonth = new Date(newMonth.getFullYear(), newMonth.getMonth(), 1);
                fetchAppointmentsForDate(firstDayOfNewMonth, state.selectedService.id);
            }
            renderApp();
        }

        async function handleBookingSubmit(e) {
            e.preventDefault(); // Prevent default form submission

            const userName = document.getElementById('userName').value;
            const userEmail = document.getElementById('userEmail').value;
            const userPhone = document.getElementById('userPhone').value;

            // Existing validation for empty fields
            if (!userName || !userEmail || !userPhone) {
                state.error = 'Please fill in all required fields.';
                state.loadingSlots = false;
                renderApp();
                return;
            }

            // New phone number validation
            const phonePattern = /^09\d{9}$/;
            if (!phonePattern.test(userPhone)) {
                state.error = 'Phone number must be 11 digits, starting with "09".';
                state.loadingSlots = false;
                renderApp();
                return;
            }

            // If validation passes, set loading state and re-render to show "Booking..."
            state.loadingSlots = true;
            state.error = ''; // Clear any previous errors
            renderApp();

            await new Promise(resolve => setTimeout(resolve, 1000)); // Simulate API call delay

            // Format the new appointment ID
            const nextAppointmentNumber = (state.simulatedAppointments.length + 1).toString().padStart(3, '0');
            const newAppointment = {
                id: `APP${nextAppointmentNumber}`, // Formatted as APP001, APP002, etc.
                serviceId: state.selectedService.id,
                serviceName: state.selectedService.name,
                date: state.selectedDate.toISOString().split('T')[0],
                time: state.selectedTime,
                userName: userName,
                userEmail: userEmail,
                userPhone: userPhone,
                status: 'booked',
                timestamp: new Date().toISOString(),
                userId: userId
            };
            state.simulatedAppointments.push(newAppointment);
            console.log("Simulated Booking Submitted:", newAppointment);

            handleBookingSuccess('Your appointment has been successfully booked!', newAppointment.id);
            // Clear inputs after successful booking
            document.getElementById('userName').value = '';
            document.getElementById('userEmail').value = '';
            document.getElementById('userPhone').value = '';

            // Note: state.loadingSlots is set to false in handleBookingSuccess
            // renderApp() will be called as part of handleBookingSuccess
        }

        function renderAppHeader() {
            return `
                <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 text-center rounded-t-xl">
                    <h1 class="text-3xl font-extrabold">Schedule Your Appointment</h1>
                </header>
            `;
        }

        function renderBookingPage() {
            let content = '';

            switch (state.currentStep) {
                case 1:
                    content += renderServiceSelection();
                    break;
                case 2:
                    content += renderBookingCalendar();
                    break;
                case 3:
                    content += renderBookingForm();
                    break;
            }

            return `<div class="space-y-6">${content}</div>`;
        }

        function renderServiceSelection() {
            let serviceCards = services.map(service => `
                <div class="service-card" data-service-id="${service.id}">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">${service.name}</h3>
                    <p class="text-gray-600 text-sm mb-3">${service.description}</p>
                    <p class="text-gray-500 text-xs">Estimated duration: ${service.duration} minutes</p>
                    <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors duration-200">
                        Select Appointment
                    </button>
                </div>
            `).join('');

            return `
                <p class="text-lg text-gray-700 text-center">Please select the municipal service appointment you need:</p>
                <div class="grid md:grid-cols-2 gap-6">
                    ${serviceCards}
                </div>
            `;
        }

        function renderBookingCalendar() {
            if (!state.selectedService) return '';

            const daysInMonth = getDaysInMonth(state.currentMonth);
            const firstDay = getFirstDayOfMonth(state.currentMonth);
            const today = new Date();
            const todayStart = new Date(today.getFullYear(), today.getMonth(), today.getDate()).setHours(0,0,0,0);

            let daysHtml = '';
            for (let i = 0; i < firstDay; i++) {
                daysHtml += `<div class="text-center py-2"></div>`;
            }

            const allPossibleSlots = generateTimeSlots(state.selectedService.duration);
            const filteredSlots = allPossibleSlots.filter(slot => {
                const dateString = state.selectedDate ? state.selectedDate.toISOString().split('T')[0] : '';
                return !state.simulatedAppointments.some(app =>
                    app.date === dateString &&
                    app.time === slot &&
                    app.serviceId === state.selectedService.id
                );
            });

            for (let i = 1; i <= daysInMonth; i++) {
                const day = new Date(state.currentMonth.getFullYear(), state.currentMonth.getMonth(), i);
                const isToday = day.toDateString() === today.toDateString();
                const isPastDay = day.setHours(0,0,0,0) < todayStart;
                const isSelectedDay = state.selectedDate && state.selectedDate.toDateString() === day.toDateString();

                daysHtml += `
                    <div class="calendar-day ${isPastDay ? 'past-day' : ''} ${isToday ? 'today' : ''} ${isSelectedDay ? 'selected-day' : ''}"
                         data-day="${i}" data-month="${state.currentMonth.getMonth()}" data-year="${state.currentMonth.getFullYear()}"
                         ${isPastDay ? 'data-disabled="true"' : ''}>
                        ${i}
                    </div>
                `;
            }

            return `
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 text-center mb-4">Schedule for ${state.selectedService.name}</h3>
                    <div class="flex justify-between items-center mb-4">
                        <button id="prev-month" class="p-2 rounded-full hover:bg-gray-200 transition-colors"
                            ${state.currentMonth.getFullYear() <= today.getFullYear() && state.currentMonth.getMonth() <= today.getMonth() ? 'disabled' : ''}>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <h4 class="text-xl font-bold text-blue-700">
                            ${state.currentMonth.toLocaleString('default', { month: 'long', year: 'numeric' })}
                        </h4>
                        <button id="next-month" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-7 text-center font-semibold text-gray-600 mb-2">
                        <div>Sun</div><div>Mon</div><div>Tue</div><div>Thu</div><div>Fri</div><div>Sat</div>
                    </div>
                    <div class="calendar-grid">
                        ${daysHtml}
                    </div>
                    <button id="back-button" class="mt-6 w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-colors duration-200">
                        Back to Appointment Selection
                    </button>
                </div>

                ${state.selectedDate ? `
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mt-6">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">
                            Available Time Slots for ${state.selectedDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                        </h4>
                        ${state.loadingSlots ? `
                            <div class="flex items-center justify-center p-4">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 loader"></div>
                                <p class="ml-3 text-gray-600">Loading slots...</p>
                            </div>
                        ` : state.error ? `
                            <p class="text-red-500 text-center">${state.error}</p>
                        ` : filteredSlots.length > 0 ? `
                            <div class="time-slot-grid">
                                ${filteredSlots.map(slot => `
                                    <button class="time-slot-button" data-time="${slot}">
                                        ${slot}
                                    </button>
                                `).join('')}
                            </div>
                        ` : `
                            <p class="col-span-full text-center text-gray-500">No available slots for this date. Please choose another date or service.</p>
                        `}
                    </div>
                ` : ''}
            `;
        }

        function renderBookingForm() {
            if (!state.selectedService || !state.selectedDate || !state.selectedTime) return '';

            return `
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Confirm Your Appointment</h3>
                    <div class="mb-6 bg-blue-50 p-4 rounded-md border border-blue-200">
                        <p class="text-lg font-medium text-blue-700">Service: <span class="font-bold">${state.selectedService.name}</span></p>
                        <p class="text-lg font-medium text-blue-700">Date: <span class="font-bold">${state.selectedDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</span></p>
                        <p class="text-lg font-medium text-blue-700">Time: <span class="font-bold">${state.selectedTime}</span></p>
                    </div>

                    <form id="booking-form" class="space-y-4">
                        <div>
                            <label for="userName" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                            <input type="text" id="userName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="First Name Last Name">
                        </div>
                        <div>
                            <label for="userEmail" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="email" id="userEmail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="xxxxx@xxxxx.xxx">
                        </div>
                        <div>
                            <label for="userPhone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                            <input type="tel" id="userPhone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="09xxxxxxxxx" pattern="^09\\d{9}$">
                        </div>

                        ${state.error ? `<p class="text-red-600 text-sm text-center">${state.error}</p>` : ''}

                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4 mt-4">
                            <button type="button" id="cancel-booking" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-colors duration-200 flex items-center justify-center">
                                Cancel Booking
                            </button>
                            <button type="button" id="return-to-calendar" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-colors duration-200 flex items-center justify-center">
                                Return to Calendar
                            </button>
                            <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition-colors duration-200 flex items-center justify-center" ${state.loadingSlots ? 'disabled' : ''}>
                                ${state.loadingSlots ? `<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-3 loader"></div>Booking...` : 'Confirm Appointment'}
                            </button>
                        </div>
                    </form>
                </div>
            `;
        }

        function renderMyAppointmentsPage() {
            return `
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">My Booked Appointments</h2>
                    <div class="text-center p-10 bg-gray-50 rounded-lg shadow-sm">
                        <p class="text-xl text-gray-600">This section is not available in this simplified booking-only version.</p>
                    </div>
                </div>
            `;
        }

        function renderConfirmationModal() {
            if (!state.showConfirmationModal) return '';
            return `
                <div class="modal">
                    <div class="modal-content">
                        <div class="flex justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="2xl font-bold text-gray-800 mb-3">Success!</h3>
                        <p class="text-gray-600 mb-6">${state.confirmationMessage}</p>
                        <button id="close-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Close
                        </button>
                    </div>
                </div>
            `;
        }

        function attachEventListeners() {
            const appDiv = document.getElementById('app');
            if (!appDiv) return;

            const backButton = document.getElementById('back-button');
            if (backButton) backButton.onclick = navigateBack;

            if (state.currentStep === 1) {
                appDiv.querySelectorAll('.service-card').forEach(card => {
                    card.onclick = (e) => {
                        const serviceId = e.currentTarget.dataset.serviceId;
                        const service = services.find(s => s.id === serviceId);
                        if (service) handleServiceSelect(service);
                    };
                });
            } else if (state.currentStep === 2) {
                const prevMonthButton = document.getElementById('prev-month');
                const nextMonthButton = document.getElementById('next-month');
                if (prevMonthButton) prevMonthButton.onclick = () => handleMonthChange(-1);
                if (nextMonthButton) nextMonthButton.onclick = () => handleMonthChange(1);

                appDiv.querySelectorAll('.calendar-day').forEach(dayDiv => {
                    if (dayDiv.dataset.disabled !== "true") {
                        dayDiv.onclick = (e) => {
                            const day = parseInt(e.currentTarget.dataset.day);
                            const month = parseInt(e.currentTarget.dataset.month);
                            const year = parseInt(e.currentTarget.dataset.year);
                            const selectedDate = new Date(year, month, day);
                            state.selectedDate = selectedDate;
                            state.selectedTime = null;
                            fetchAppointmentsForDate(selectedDate, state.selectedService.id);
                            renderApp();
                        };
                    }
                });

                appDiv.querySelectorAll('.time-slot-button').forEach(button => {
                    button.onclick = (e) => {
                        const time = e.currentTarget.dataset.time;
                        handleTimeSelect(state.selectedDate, time);
                    };
                });
            } else if (state.currentStep === 3) {
                const bookingForm = document.getElementById('booking-form');
                if (bookingForm) bookingForm.onsubmit = handleBookingSubmit;

                const returnToCalendarButton = document.getElementById('return-to-calendar');
                if (returnToCalendarButton) returnToCalendarButton.onclick = navigateBack;

                const cancelBookingButton = document.getElementById('cancel-booking');
                if (cancelBookingButton) cancelBookingButton.onclick = cancelBooking;
            }

            const closeModalButton = document.getElementById('close-modal');
            if (closeModalButton) closeModalButton.onclick = () => {
                state.showConfirmationModal = false;
                renderApp();
            };
        }

        function renderApp() {
            const appDiv = document.getElementById('app');
            if (!appDiv) return;

            appDiv.innerHTML = `
                ${renderAppHeader()}
                <main class="p-8">
                    ${renderBookingPage()}
                </main>
                ${renderConfirmationModal()}
            `;
            attachEventListeners();
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderApp();
        });
    </script>

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
                    <a href="#">Terms of Use</a> |
                    <a href="#">Privacy Policy</a>
                </p>
            </div>
            <img src="images/seal_logo.png" alt="Pangasinan Logo">
        </div>
        <p class="copyright">
            © 2025 Municipality of Urbiztondo. All rights reserved.
        </p>
    </footer>
</body>
</html>