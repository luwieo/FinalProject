<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Status Tracker</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/paytrack.css">
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
            <li><a href="#" class="active">Tracker</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="http://localhost/Service/logout.php">Log out</a></li>
            <?php else: ?>
            <li><a href="http://localhost/Service/login.html">Log-in/Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="container">
        <header>
            <h1>Live Status Tracker</h1>
            <p>Track your requests in real-time.</p>
        </header>

        <div class="search-section">
            <form id="tracking-form">
                <label for="reference-number">Enter Your Reference Number</label>
                <div class="search-form-elements">
                    <input type="text" id="reference-number" name="reference-number" class="search-input"
                        placeholder="e.g., DOC-2025-002">
                    <button type="submit" class="track-button">
                        Track Status
                    </button>
                </div>
                <p class="sample-numbers">
                    Sample numbers: <strong>DOC-2025-001</strong> (Document), <strong>DOC-2025-002</strong> (Requires
                    Payment), <strong>FDB-2025-001</strong> (Feedback), <strong>FDB-2025-002</strong> (Feedback)
                </p>
            </form>
        </div>

        <div id="results-container">
        </div>

        <div id="message-box">
            <p id="message-text"></p>
        </div>

    </div>

    <div id="payment-modal-overlay" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Complete Your Payment</h2>
                <button id="modal-close-btn" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Amount Due: <span id="payment-amount"></span></h3>
                <p>Please select a payment method:</p>
                <div id="payment-options" class="payment-options">
                    <label class="payment-option selected">
                        <input type="radio" name="paymentMethod" value="GCash" checked>
                        <img src="logos/gcash.png" alt="GCash Logo" class="payment-logo">
                        GCash
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="paymentMethod" value="Maya">
                        <img src="logos/paymaya.png" alt="Maya Logo" class="payment-logo">
                        Maya
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="paymentMethod" value="Bank Transfer">
                        <img src="logos/bank.jpg" alt="Bank Transfer Logo" class="payment-logo">
                        Bank Transfer
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button id="confirm-payment-button" class="confirm-payment-btn track-button">Confirm Payment</button>
            </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            const initialMockDb = {
                'DOC-2025-001': {
                    referenceNumber: 'DOC-2025-001',
                    type: 'Document',
                    requesterName: 'Alex Doe',
                    dateFiled: '2025-06-15',
                    status: 'Ready for Release',
                    details: {
                        documentName: 'Barangay Clearance',
                        paymentStatus: 'Not Applicable',
                        paymentAmount: null,
                    },
                    department: 'Document Processing Department',
                    departmentRemark: 'Document verified and awaiting pickup by the requester.',
                    timeline: [
                        { status: 'Request Filed', date: '2025-06-15', description: 'Your request has been successfully submitted.' },
                        { status: 'Processing', date: '2025-06-16', description: 'Documents are being verified and processed by our staff.' },
                        { status: 'Ready for Pickup', date: '2025-06-18', description: 'Your document is ready for pickup at the main office.' }
                    ]
                },
                'DOC-2025-002': {
                    referenceNumber: 'DOC-2025-002',
                    type: 'Document',
                    requesterName: 'Jaime Reyes',
                    dateFiled: '2025-06-17',
                    status: 'Waiting for Payment',
                    details: {
                        documentName: 'Business Permit',
                        paymentStatus: 'Pending',
                        paymentAmount: '500.00',
                        transactionNumber: null,
                        paymentMethod: null,
                    },
                    department: 'Treasury Office',
                    departmentRemark: 'Payment still outstanding. Please settle the payment to proceed.',
                    timeline: [
                        { status: 'Request Filed', date: '2025-06-17', description: 'Your request for a business permit has been submitted.' },
                        { status: 'Waiting for Payment', date: '2025-06-17', description: 'Please settle the payment to proceed with the application.' }
                    ]
                },
                'FDB-2025-001': {
                    referenceNumber: 'FDB-2025-001',
                    type: 'Feedback',
                    requesterName: 'Maria Clara',
                    dateFiled: '2025-06-20',
                    status: 'On Process',
                    details: {
                        concernType: 'Suggestion',
                        feedbackMessage: 'Consider adding more public trash bins along the main road to improve cleanliness.',
                        resolution: null,
                    },
                    department: 'Urban Planning Department',
                    departmentRemark: 'Feedback forwarded to relevant team for review and consideration in upcoming projects.',
                    timeline: [
                        { status: 'Feedback Submitted', date: '2025-06-20', description: 'Your feedback has been received and logged.' },
                        { status: 'Under Review', date: '2025-06-21', description: 'The appropriate department is now reviewing your feedback.' },
                    ]
                },
                'FDB-2025-002': {
                    referenceNumber: 'FDB-2025-002',
                    type: 'Feedback',
                    requesterName: 'Crisostomo Ibarra',
                    dateFiled: '2025-06-12',
                    status: 'Complete',
                    details: {
                        concernType: 'Complaint',
                        feedbackMessage: 'A busted street light at the corner of Rizal and Bonifacio street has not been fixed for a week.',
                        resolution: 'Our maintenance team has been dispatched and the street light was replaced on June 14, 2025. Thank you for your report.',
                    },
                    department: 'Public Works Department',
                    departmentRemark: 'Issue resolved. Team has confirmed the street light is now fully operational.',
                    timeline: [
                        { status: 'Feedback Submitted', date: '2025-06-12', description: 'Your complaint has been received.' },
                        { status: 'Acknowledged', date: '2025-06-13', description: 'Maintenance team has been notified.' },
                        { status: 'Resolved', date: '2025-06-14', description: 'The issue has been addressed. See resolution details.' },
                    ]
                }
            };

            localStorage.removeItem('trackingData'); // This line clears the local storage on every load
            const mockDb = { ...initialMockDb }; // This ensures mockDb always starts with the initial data

            const trackingForm = document.getElementById('tracking-form');
            const referenceInput = document.getElementById('reference-number');
            const resultsContainer = document.getElementById('results-container');
            const messageBox = document.getElementById('message-box');
            const messageText = document.getElementById('message-text');

            const paymentModalOverlay = document.getElementById('payment-modal-overlay');
            const modalCloseBtn = document.getElementById('modal-close-btn');
            const paymentOptionsContainer = document.getElementById('payment-options');
            const confirmPaymentBtn = document.getElementById('confirm-payment-button');

            const mockStatusOptions = {
                getDocumentStatuses: function () {
                    return new Promise(resolve => {
                        setTimeout(() => {

                            resolve(["Received", "Processing", "Waiting for Payment", "Ready for Release", "Released"]);
                        }, 100);
                    });
                },
                getFeedbackStatuses: function () {
                    return new Promise(resolve => {
                        setTimeout(() => {
                            resolve(["Pending", "On Process", "Complete", "Denied"]);
                        }, 100);
                    });
                }
            };

            let allowedDocumentStatuses = [];
            let allowedFeedbackStatuses = [];

            async function fetchAllStatusOptions() {
                try {
                    allowedDocumentStatuses = await mockStatusOptions.getDocumentStatuses();
                    allowedFeedbackStatuses = await mockStatusOptions.getFeedbackStatuses();
                } catch (error) {
                    console.error("Error fetching status options:", error);
                    allowedDocumentStatuses = ["Received", "Processing", "Waiting for Payment", "Ready for Release", "Released"];
                    allowedFeedbackStatuses = ["Pending", "On Process", "Complete", "Denied"];
                    showMessage("Could not load dynamic status options. Using default.", "error");
                }
            }

            fetchAllStatusOptions();

            trackingForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const refNum = referenceInput.value.trim().toUpperCase();
                if (refNum) {
                    trackStatus(refNum);
                } else {
                    showMessage('Please enter a reference number.', 'error');
                }
            });

            modalCloseBtn.addEventListener('click', () => paymentModalOverlay.classList.remove('visible'));

            paymentOptionsContainer.addEventListener('click', (e) => {
                const targetOption = e.target.closest('.payment-option');
                if (targetOption) {
                    document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('selected'));
                    targetOption.classList.add('selected');
                    targetOption.querySelector('input').checked = true;
                }
            });

            function trackStatus(refNum) {
                const data = mockDb[refNum];
                resultsContainer.classList.remove('visible');
                resultsContainer.innerHTML = '';

                if (data) {
                    setTimeout(() => {
                        if (data.details.paymentStatus === 'Paid' && !data.details.viewedReceipt) {
                            renderEReceipt(data);
                        } else {
                            renderResults(data);
                        }
                        resultsContainer.classList.add('visible');
                    }, 100);
                } else {
                    showMessage('Reference number not found.', 'error');
                }
            }

            function renderResults(data) {
                const headerHtml = `
                    <div class="results-header">
                        <h2>Tracking Details</h2>
                        <p>Reference #: <span>${data.referenceNumber}</span></p>
                    </div>
                `;
                const summaryHtml = renderSummary(data);
                resultsContainer.innerHTML = headerHtml + summaryHtml;

                const payButton = document.getElementById('pay-now-btn');
                if (payButton) {
                    payButton.addEventListener('click', () => showPaymentModal(data));
                }
            }

            function renderSummary(data) {
                let detailsHtml = '';
                let displayStatus = data.status;

                if (data.type === 'Document') {
                    if (!allowedDocumentStatuses.includes(data.status)) {
                        displayStatus = "Unknown Document Status";
                    }
                } else if (data.type === 'Feedback') {
                    if (!allowedFeedbackStatuses.includes(data.status)) {
                        displayStatus = "Unknown Feedback Status";
                    }
                } else {
                    displayStatus = "Invalid Request Type";
                }

                if (data.type === 'Document') {
                    const isPaymentPending = data.details.paymentStatus === 'Pending' && data.details.paymentAmount;

                    detailsHtml = `
                        <div class="document-details-grid">
                            <div class="summary-item">
                                <p>${data.type}</p>
                                <p>${data.details.documentName}</p>
                            </div>
                            <div class="summary-item">
                                <p>Payment Status</p>
                                <p class="${isPaymentPending ? 'payment-pending' : 'payment-status-green'}">
                                    ${data.details.paymentStatus}
                                </p>
                            </div>
                            ${isPaymentPending ? `
                            <div class="summary-item">
                                <p>Amount Due</p>
                                <p>₱${data.details.paymentAmount}</p>
                            </div>` : ''}
                        </div>
                        ${isPaymentPending ? `<button id="pay-now-btn" class="pay-now-button">Pay Now</button>` : ''}
                    `;
                } else if (data.type === 'Feedback') {
                    detailsHtml = `
                        <div class="summary-item">
                            <p>Concern Type</p>
                            <p>${data.details.concernType}</p>
                        </div>
                        <div class="feedback-message">
                            <p>Your Message</p>
                            <p>${data.details.feedbackMessage}</p>
                        </div>
                        ${data.details.resolution ? `
                        <div class="feedback-resolution">
                            <p>Resolution</p>
                            <p>${data.details.resolution}</p>
                        </div>` : ''}
                    `;
                }

                return `
                    <div class="summary-section">
                           <div class="summary-grid">
                                <div class="summary-item"> <p>Requester</p> <p>${data.requesterName}</p> </div>
                                <div class="summary-item"> <p>Date Filed</p> <p>${data.dateFiled}</p> </div>
                                <div class="summary-item"> <p>Current Status</p> <p class="current-status">${displayStatus}</p> </div>
                                <div class="summary-item"> <p>Department Handling</p> <p>${data.department}</p> </div>
                                <div class="summary-item"> <p>Department Remark</p> <p>${data.departmentRemark}</p> </div>
                           </div>
                           <hr/>
                           ${detailsHtml}
                    </div>
                `;
            }

            function showPaymentModal(data) {
                document.getElementById('payment-amount').textContent = `₱${data.details.paymentAmount}`;
                confirmPaymentBtn.onclick = () => processPayment(data.referenceNumber);
                paymentModalOverlay.classList.add('visible');
            }

            function processPayment(refNum) {
                const data = mockDb[refNum];
                const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
                const transactionNumber = `TRN-${Date.now()}`;
                const amount = data.details.paymentAmount;
                const applicantName = data.requesterName;

                fetch('save_payment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        reference_number: refNum,
                        applicant_name: applicantName,
                        amount: amount,
                        payment_method: paymentMethod,
                        transaction_number: transactionNumber,
                        status: 'Ready for Release'
                    })
                })
                    .then(res => res.json())
                    .then(result => {
                        console.log(result); // ✅ Output what the backend returned
                        if (result.status === 'success') {
                            showMessage('Payment Successful!', 'success');
                        } else {
                            showMessage('Error: ' + result.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error('Fetch error:', err);
                        showMessage('Unexpected error occurred', 'error');
                    });
                // Continue updating mockDb and UI...
                data.status = 'Ready for Release';
                data.details.paymentStatus = 'Paid';
                data.details.transactionNumber = transactionNumber;
                data.details.paymentMethod = paymentMethod;
                data.departmentRemark = "Payment received. Document ready for release.";
                data.timeline.push({
                    status: 'Payment Completed',
                    date: new Date().toISOString().slice(0, 10),
                    description: `₱${amount} paid via ${paymentMethod}.`
                });
                localStorage.setItem('trackingData', JSON.stringify(mockDb));
                paymentModalOverlay.classList.remove('visible');
                showMessage('Payment Successful!', 'success');

                setTimeout(() => trackStatus(refNum), 300);
            }


            function renderEReceipt(data) {
                const { referenceNumber, details } = data;
                resultsContainer.innerHTML = `
                    <div class="results-header">
                        <h2>Payment Successful!</h2>
                        <p>E-Receipt for Reference #: <span>${referenceNumber}</span></p>
                    </div>
                    <div class="ereceipt-section">
                        <h3>Official E-Receipt</h3>
                        <div class="summary-grid">
                            <div class="summary-item"><p>Transaction Number</p><p><strong>${details.transactionNumber}</strong></p></div>
                            <div class="summary-item"><p>Payment Method</p><p>${details.paymentMethod}</p></div>
                            <div class="summary-item"><p>Amount Paid</p><p>₱${details.paymentAmount}</p></div>
                            <div class="summary-item"><p>Status</p><p class="payment-status-green">Paid</p></div>
                        </div>
                        <hr/>
                        <button id="close-receipt-btn" class="track-button" style="margin-top: 1rem;">View Updated Status</button>
                    </div>`;

                document.getElementById('close-receipt-btn').addEventListener('click', () => {
                    data.details.viewedReceipt = true;
                    localStorage.setItem('trackingData', JSON.stringify(mockDb));
                    trackStatus(data.referenceNumber);
                });
            }

            function showMessage(message, type = 'error') {
                messageText.textContent = message;
                messageBox.className = `fixed top-5 right-5 text-white py-3 px-5 rounded-lg shadow-xl ${type === 'error' ? 'bg-red-600' : 'bg-green-600'}`;

                messageBox.classList.add('opacity-0', 'translate-y-[-20px]');

                setTimeout(() => {
                    messageBox.classList.remove('opacity-0', 'translate-y-[-20px]');
                    messageBox.classList.add('opacity-100', 'translate-y-0');
                }, 10);

                setTimeout(() => {
                    messageBox.classList.remove('opacity-100', 'translate-y-0');
                    messageBox.classList.add('opacity-0', 'translate-y-[-20px]');
                }, 3000);
            }

        });
    </script>
</body>
</html>