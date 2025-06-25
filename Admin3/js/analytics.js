document.addEventListener('DOMContentLoaded', function() {
    // Chart Functionality
    const canvas = document.getElementById('doughnutChart');
    let ctx = null;
    if (canvas) {
        ctx = canvas.getContext('2d');
    }

    let currentChartData = [];
    let hoveredSegmentIndex = -1;
    let currentChartTitle = 'Overall Data Distribution';

    // --- Table specific variables ---
    let originalTableRows = [];
    let currentTableSortOrder = 'none';
    let currentTableSearchTerm = '';
    let currentTableFilterLabel = '';
    let currentTableFilterMode = 'all';

    // --- Global Application Type Categories ---
    const serviceTypes = [
        'Business Permit',
        'Building Permit',
        'Demolition Permit',
        'Sanitary Permit',
        'Electrical Permit'
    ];
    const complaintTypes = [
        'Roads and Infrastructure',
        'Waste Management',
        'Public Safety',
        'Permits and Licensing',
        'Local Government Services',
        'Environment',
        'Other'
    ];

    const colors = [
        '#ef4444', '#3b82f6', '#22c55e', '#eab308', '#a855f7',
        '#f97316', '#06b6d4', '#8b5cf6', '#ec4899', '#6b7280'
    ];

    function assignColors(data) {
        let colorMap = {};
        let colorIndex = 0;
        return data.map(item => {
            if (!colorMap[item.label]) {
                colorMap[item.label] = colors[colorIndex % colors.length];
                colorIndex++;
            }
            return { ...item, color: colorMap[item.label] };
        });
    }

    function getApplicationsChartData() {
        const applicationCounts = {};
        originalTableRows.forEach(row => {
            const applicationTypeCell = row.children[2];
            if (applicationTypeCell) {
                const applicationType = applicationTypeCell.textContent.trim();
                applicationCounts[applicationType] = (applicationCounts[applicationType] || 0) + 1;
            }
        });
        const rawData = Object.keys(applicationCounts).map(label => ({
            label: label,
            value: applicationCounts[label]
        }));
        return assignColors(rawData);
    }

    function getServicesChartData() {
        const serviceCounts = {};
        originalTableRows.forEach(row => {
            const applicationTypeCell = row.children[2];
            if (applicationTypeCell) {
                const applicationType = applicationTypeCell.textContent.trim();
                if (serviceTypes.includes(applicationType)) {
                    serviceCounts[applicationType] = (serviceCounts[applicationType] || 0) + 1;
                }
            }
        });
        const rawData = Object.keys(serviceCounts).map(label => ({
            label: label,
            value: serviceCounts[label]
        }));
        return assignColors(rawData);
    }

    function getComplaintsChartData() {
        const complaintCounts = {};
        originalTableRows.forEach(row => {
            const applicationTypeCell = row.children[2];
            if (applicationTypeCell) {
                const applicationType = applicationTypeCell.textContent.trim();
                if (complaintTypes.includes(applicationType)) {
                    complaintCounts[applicationType] = (complaintCounts[applicationType] || 0) + 1;
                }
            }
        });
        const rawData = Object.keys(complaintCounts).map(label => ({
            label: label,
            value: complaintCounts[label]
        }));
        return assignColors(rawData);
    }

    function drawDoughnutChart(hoveredIndex = -1) {
        if (!ctx || !canvas) return []; // Ensure context and canvas exist

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        const dpi = window.devicePixelRatio || 1;
        const styleWidth = getComputedStyle(canvas).width;
        const styleHeight = getComputedStyle(canvas).height;
        canvas.width = parseFloat(styleWidth) * dpi;
        canvas.height = parseFloat(styleHeight) * dpi;
        ctx.scale(dpi, dpi);

        const centerX = canvas.width / (2 * dpi);
        const centerY = canvas.height / (2 * dpi);
        const baseRadius = Math.min(centerX, centerY) * 0.8;
        const innerRadius = baseRadius * 0.6;

        let totalValue = currentChartData.reduce((sum, item) => sum + item.value, 0);
        let currentAngle = 0;

        const segmentsForClick = [];

        currentChartData.forEach((segment, index) => {
            const sliceAngle = (segment.value / totalValue) * Math.PI * 2;
            const isHovered = (index === hoveredIndex);
            const radius = isHovered ? baseRadius * 1.05 : baseRadius;

            segmentsForClick.push({
                startAngle: currentAngle,
                endAngle: currentAngle + sliceAngle,
                innerRadius: innerRadius,
                outerRadius: radius,
                label: segment.label
            });

            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, currentAngle, currentAngle + sliceAngle);
            ctx.arc(centerX, centerY, innerRadius, currentAngle + sliceAngle, currentAngle, true);
            ctx.closePath();
            ctx.fillStyle = segment.color;
            ctx.fill();

            ctx.strokeStyle = '#ffffff';
            ctx.lineWidth = isHovered ? 3 : 2;
            ctx.stroke();

            const midAngle = currentAngle + sliceAngle / 2;
            const textRadius = (radius + innerRadius) / 2;
            const textX = centerX + textRadius * Math.cos(midAngle);
            const textY = centerY + textRadius * Math.sin(midAngle);

            ctx.fillStyle = '#ffffff';
            ctx.font = `bold ${baseRadius * 0.06}px Inter`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            const percentage = (totalValue > 0) ? ((segment.value / totalValue) * 100).toFixed(1) : 0;
            if (percentage > 5) {
                ctx.fillText(`${percentage}%`, textX, textY);
            }

            currentAngle += sliceAngle;
        });

        ctx.beginPath();
        ctx.arc(centerX, centerY, innerRadius, 0, Math.PI * 2);
        ctx.fillStyle = '#f8fafc';
        ctx.fill();

        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        if (hoveredIndex !== -1) {
            const hoveredSegment = currentChartData[hoveredIndex];
            ctx.fillStyle = '#334155';
            ctx.font = `bold ${baseRadius * 0.12}px Inter`;
            ctx.fillText(hoveredSegment.label, centerX, centerY - baseRadius * 0.08);
            ctx.font = `normal ${baseRadius * 0.06}px Inter`;
            ctx.fillText(`Value: ${hoveredSegment.value}`, centerX, centerY + baseRadius * 0.08);
        } else {
            ctx.fillStyle = '#334155';
            ctx.font = `bold ${baseRadius * 0.12}px Inter`;
            const titleParts = currentChartTitle.split(' ');
            if (titleParts.length > 1) {
                ctx.fillText(titleParts[0], centerX, centerY - baseRadius * 0.08);
                ctx.font = `normal ${baseRadius * 0.06}px Inter`;
                ctx.fillText(titleParts.slice(1).join(' '), centerX, centerY + baseRadius * 0.08);
            } else {
                ctx.fillText(currentChartTitle, centerX, centerY);
            }
        }
        return segmentsForClick;
    }

    let activeSegmentsForClick = [];

    function updateChartAndTable(type) {
        hoveredSegmentIndex = -1;

        if (type === 'services') {
            currentChartData = getServicesChartData();
            currentChartTitle = 'Service Requests';
            currentTableFilterMode = 'category';
            currentTableFilterLabel = 'services';
        } else if (type === 'complaints') {
            currentChartData = getComplaintsChartData();
            currentChartTitle = 'Complaint Categories';
            currentTableFilterMode = 'category';
            currentTableFilterLabel = 'complaints';
        } else {
            currentChartData = getApplicationsChartData();
            currentChartTitle = 'Overall Data Distribution';
            currentTableFilterMode = 'all';
            currentTableFilterLabel = '';
        }
        activeSegmentsForClick = drawDoughnutChart();
        renderFilteredAndSortedTable();
    }

    if (canvas) { // Only attach mouse events if canvas exists
        canvas.addEventListener('mousemove', function(event) {
            const mouseX = event.offsetX;
            const mouseY = event.offsetY;

            const dpi = window.devicePixelRatio || 1;
            const centerX = canvas.width / (2 * dpi);
            const centerY = canvas.height / (2 * dpi);
            const baseRadius = Math.min(centerX, centerY) * 0.8;
            const innerRadius = baseRadius * 0.6;

            const dx = mouseX - centerX;
            const dy = mouseY - centerY;
            const distance = Math.sqrt(dx * dx + dy * dy);

            let totalValue = currentChartData.reduce((sum, item) => sum + item.value, 0);

            if (distance >= innerRadius && distance <= baseRadius * 1.05) {
                let angle = Math.atan2(dy, dx);
                if (angle < 0) angle += Math.PI * 2;

                let currentAngle = 0;
                let newHoveredIndex = -1;

                for (let i = 0; i < currentChartData.length; i++) {
                    const segment = currentChartData[i];
                    const sliceAngle = (totalValue > 0) ? (segment.value / totalValue) * Math.PI * 2 : 0;
                    const endAngle = currentAngle + sliceAngle;

                    if (currentAngle <= angle && angle < endAngle) {
                        newHoveredIndex = i;
                        break;
                    }
                    currentAngle = endAngle;
                }

                if (newHoveredIndex !== hoveredSegmentIndex) {
                    hoveredSegmentIndex = newHoveredIndex;
                    drawDoughnutChart(hoveredSegmentIndex);
                }
            } else {
                if (hoveredSegmentIndex !== -1) {
                    hoveredSegmentIndex = -1;
                    drawDoughnutChart();
                }
            }
        });

        canvas.addEventListener('mouseout', function() {
            if (hoveredSegmentIndex !== -1) {
                hoveredSegmentIndex = -1;
                drawDoughnutChart();
            }
        });
    }


    function parseDate(dateString) {
        const parts = dateString.split('-');
        // Note: Month is 0-indexed in Date constructor, so parts[0] - 1
        return new Date(parts[2], parts[0] - 1, parts[1]);
    }

    /**
     * Calculates the duration between a past date and the current date.
     * @param {string} dateString The date in MM-DD-YYYY format.
     * @returns {string} A human-readable duration (e.g., "5 days ago", "2 months ago", "1 year ago").
     */
    function calculateDuration(dateString) {
        const submittedDate = parseDate(dateString);
        const currentDate = new Date();
        // Set both dates to start of day to avoid time differences affecting duration
        submittedDate.setHours(0, 0, 0, 0);
        currentDate.setHours(0, 0, 0, 0);

        const diffTime = Math.abs(currentDate.getTime() - submittedDate.getTime());
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays === 0) {
            return "Today";
        } else if (diffDays === 1) {
            return "1 day ago";
        } else if (diffDays < 30) { // Roughly a month
            return `${diffDays} days ago`;
        } else if (diffDays < 365) { // Roughly a year
            const diffMonths = Math.floor(diffDays / 30); // Simple month calculation
            return `${diffMonths} month${diffMonths > 1 ? 's' : ''} ago`;
        } else {
            const diffYears = Math.floor(diffDays / 365);
            return `${diffYears} year${diffYears > 1 ? 's' : ''} ago`;
        }
    }

    // Function to update the duration column for all visible rows
    function updateDurations() {
        document.querySelectorAll('.table-data tbody tr').forEach(row => {
            const dateSubmittedCell = row.children[4]; // Assuming 'Date Submitted' is the 5th column (index 4)
            const durationCell = row.querySelector('.application-duration'); // Using the new class
            if (dateSubmittedCell && durationCell) {
                const dateSubmitted = dateSubmittedCell.textContent.trim();
                const duration = calculateDuration(dateSubmitted);
                durationCell.textContent = duration;
            }
        });
    }


    function renderFilteredAndSortedTable() {
        const tableBody = document.querySelector('.table-data tbody');
        if (!tableBody) return; // Exit if tableBody is not found

        let displayedRows = originalTableRows.map(row => row.cloneNode(true));

        // 1. Apply Search Filter
        if (currentTableFilterMode === 'search' && currentTableSearchTerm) {
            displayedRows = displayedRows.filter(row => {
                const rowText = row.textContent.toLowerCase();
                return rowText.includes(currentTableSearchTerm);
            });
        }

        // 2. Apply Category/Segment Filter
        if (currentTableFilterMode === 'segment' && currentTableFilterLabel) {
            displayedRows = displayedRows.filter(row => {
                const applicationTypeCell = row.children[2];
                return applicationTypeCell && applicationTypeCell.textContent.trim() === currentTableFilterLabel;
            });
        } else if (currentTableFilterMode === 'category') {
            displayedRows = displayedRows.filter(row => {
                const applicationTypeCell = row.children[2];
                if (!applicationTypeCell) return false;
                const applicationType = applicationTypeCell.textContent.trim();

                if (currentTableFilterLabel === 'services') {
                    return serviceTypes.includes(applicationType);
                } else if (currentTableFilterLabel === 'complaints') {
                    return complaintTypes.includes(applicationType);
                }
                return false;
            });
        }

        // 3. Apply Sort Order
        if (currentTableSortOrder !== 'none') {
            displayedRows.sort((rowA, rowB) => {
                const dateA = parseDate(rowA.children[4].textContent.trim());
                const dateB = parseDate(rowB.children[4].textContent.trim());
                if (currentTableSortOrder === 'asc') {
                    return dateA.getTime() - dateB.getTime();
                } else {
                    return dateB.getTime() - dateA.getTime();
                }
            });
        }

        // Clear existing rows in the actual table body
        tableBody.innerHTML = '';

        // Append the filtered and sorted rows or "No results found" message
        if (displayedRows.length > 0) {
            displayedRows.forEach(row => tableBody.appendChild(row));
        } else {
            const newNoResultsRow = document.createElement('tr');
            newNoResultsRow.classList.add('no-results-row');
            newNoResultsRow.innerHTML = `<td colspan="10" style="text-align: center;">No results found.</td>`;
            tableBody.appendChild(newNoResultsRow);
        }

        // Crucial: Re-attach event listeners for status/remarks AFTER table is rendered
        attachSelectEventListeners();
        // --- NEW: Update durations AFTER table is rendered ---
        updateDurations();
    }

    function handleFilterButtonClick() {
        currentTableSearchTerm = '';
        const searchInput = document.getElementById('search-input');
        if (searchInput) searchInput.value = '';
        currentTableFilterLabel = '';
        currentTableFilterMode = 'all';

        if (currentTableSortOrder === 'none') {
            currentTableSortOrder = 'asc';
        } else if (currentTableSortOrder === 'asc') {
            currentTableSortOrder = 'desc';
        } else {
            currentTableSortOrder = 'none';
        }
        renderFilteredAndSortedTable();
    }

    function handleSearchInput() {
        const searchInput = document.getElementById('search-input');
        currentTableSearchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
        currentTableFilterLabel = '';
        currentTableFilterMode = 'search';
        currentTableSortOrder = 'none';
        renderFilteredAndSortedTable();
    }

    function handleShowAllDataClick() {
        const searchInput = document.getElementById('search-input');
        if (searchInput) searchInput.value = '';
        currentTableSearchTerm = '';
        currentTableSortOrder = 'none';
        currentTableFilterLabel = '';
        currentTableFilterMode = 'all';
        renderFilteredAndSortedTable();
    }

    function handleChartSegmentClick(segmentLabel) {
        const searchInput = document.getElementById('search-input');
        if (searchInput) searchInput.value = '';
        currentTableSearchTerm = '';
        currentTableSortOrder = 'none';
        currentTableFilterLabel = segmentLabel;
        currentTableFilterMode = 'segment';
        renderFilteredAndSortedTable();
    }

    // --- Status and Remarks functionality ---
    function handleStatusChange(event) {
        const statusSelect = event.target;
        const selectedStatusValue = statusSelect.value;

        // Update the status span class for styling
        const statusSpan = statusSelect.closest('.status');
        if (statusSpan) {
            // Remove all existing status classes dynamically
            statusSpan.classList.remove('completed', 'process', 'pending', 'denied');
            statusSpan.classList.add(selectedStatusValue); // Add the selected status as a class
        }

        // Update the "Last Updated" date
        const row = statusSelect.closest('tr');
        const lastUpdatedCell = row.querySelector('.last-updated-date');
        if (lastUpdatedCell) {
            const today = new Date();
            const month = (today.getMonth() + 1).toString().padStart(2, '0');
            const day = today.getDate().toString().padStart(2, '0');
            const year = today.getFullYear();
            const formattedDate = `${month}-${day}-${year}`;
            lastUpdatedCell.textContent = formattedDate;
        }

        // Update Remarks based on Status
        const remarksSelect = statusSelect.closest('tr').querySelector('.remarks-select');
        if (remarksSelect) {
            let newRemarksValue;
            if (selectedStatusValue === 'complete' || selectedStatusValue === 'process') {
                newRemarksValue = 'approved';
            } else if (selectedStatusValue === 'pending') {
                newRemarksValue = 'under-approval';
            } else if (selectedStatusValue === 'denied') {
                newRemarksValue = 'declined';
            }
            remarksSelect.value = newRemarksValue;
        }
    }

    // Function to attach/re-attach event listeners for status/remarks dropdowns
    function attachSelectEventListeners() {
        document.querySelectorAll('.status-select').forEach(select => {
            select.removeEventListener('change', handleStatusChange);
            select.addEventListener('change', handleStatusChange);
            handleStatusChange({ target: select }); // Initial call to set remarks based on initial status
        });
    }

    // --- Initialization Logic ---
    const tableBody = document.querySelector('.table-data tbody');
    if (tableBody) {
        originalTableRows = Array.from(tableBody.querySelectorAll('tr')).filter(row => !row.classList.contains('no-results-row'));
    }

    // Attach chart type selectors
    const applicationsLink = document.getElementById('applications-link');
    if (applicationsLink) applicationsLink.addEventListener('click', (e) => {
        e.preventDefault();
        updateChartAndTable('applications');
    });

    const servicesLink = document.getElementById('services-link');
    if (servicesLink) servicesLink.addEventListener('click', (e) => {
        e.preventDefault();
        updateChartAndTable('services');
    });

    const complaintsLink = document.getElementById('complaints-link');
    if (complaintsLink) complaintsLink.addEventListener('click', (e) => {
        e.preventDefault();
        updateChartAndTable('complaints');
    });

    // Attach event listeners for table manipulation
    const filterButton = document.getElementById('filter-button');
    if (filterButton) filterButton.addEventListener('click', handleFilterButtonClick);

    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');

    if (searchButton) searchButton.addEventListener('click', handleSearchInput);
    if (searchInput) searchInput.addEventListener('keyup', handleSearchInput);

    const showAllButton = document.getElementById('show-all-button');
    if (showAllButton) showAllButton.addEventListener('click', handleShowAllDataClick);

    // Add click listener to the canvas for chart segment filtering
    if (canvas) {
        canvas.addEventListener('click', function(event) {
            const mouseX = event.offsetX;
            const mouseY = event.offsetY;

            const dpi = window.devicePixelRatio || 1;
            const clientX = mouseX * dpi;
            const clientY = mouseY * dpi;

            const centerX = canvas.width / (2 * dpi);
            const centerY = canvas.height / (2 * dpi);

            let clickedSegmentLabel = null;

            for (let i = 0; i < activeSegmentsForClick.length; i++) {
                const segment = activeSegmentsForClick[i];

                const tempPath = new Path2D();
                tempPath.arc(centerX, centerY, segment.outerRadius, segment.startAngle, segment.endAngle);
                tempPath.arc(centerX, centerY, segment.innerRadius, segment.endAngle, segment.startAngle, true);
                tempPath.closePath();

                if (ctx && ctx.isPointInPath(tempPath, clientX, clientY)) {
                    clickedSegmentLabel = segment.label;
                    break;
                }
            }

            if (clickedSegmentLabel) {
                handleChartSegmentClick(clickedSegmentLabel);
            }
        });
    }

    // Initially load the overall data chart and render the table
    updateChartAndTable('applications'); // This also calls renderFilteredAndSortedTable() which calls updateDurations()

    // Redraw chart on window resize to make it responsive
    window.addEventListener('resize', () => {
        if (canvas) {
             updateChartAndTable(currentChartTitle.includes('Overall') ? 'applications' : (currentChartTitle.includes('Service') ? 'services' : 'complaints'))
        }
    });

    // One-time initial attachment of event listeners when the page first loads
    // and calculation of durations for the initially rendered table.
    attachSelectEventListeners();
    updateDurations(); // Call this here to ensure initial durations are set on page load.
});

const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
if (menuBar && sidebar) {
    menuBar.addEventListener("click", function () {
        sidebar.classList.toggle("hide");
    });
}

// Selects all elements with the ID 'switch-mode' (assuming there might be multiple, though ID should be unique).
const switchModeElements = document.querySelectorAll('#switch-mode');
switchModeElements.forEach(switchMode => {
    // Retrieves the dark mode preference from local storage.
    const darkMode = localStorage.getItem('darkMode');

    // Applies dark mode if previously enabled in local storage.
    if (darkMode === 'enabled') {
        document.body.classList.add('dark'); // Adds 'dark' class to the body.
        switchMode.checked = true; // Checks the switch.
    }

    // Adds an event listener for changes on the dark mode switch.
    switchMode.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark'); // Enables dark mode.
            localStorage.setItem('darkMode', 'enabled'); // Stores preference in local storage.
        } else {
            document.body.classList.remove('dark'); // Disables dark mode.
            localStorage.setItem('darkMode', 'disabled'); // Stores preference in local storage.
        }
    });
});