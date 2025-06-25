document.addEventListener('DOMContentLoaded', function () {
    const serviceSelectionView = document.getElementById('service-selection-view');
    const serviceDetailView = document.getElementById('service-detail-view');
    const serviceDetailTitle = document.getElementById('service-detail-title');
    const backBtn = document.getElementById('back-to-selection-btn');
    const serviceBtns = document.querySelectorAll('.service-btn');
    const detailTabs = document.querySelectorAll('.detail-tab');
    const tabPanes = document.querySelectorAll('.tab-pane-content');
    
    let currentService = '';
    let selectedServiceType = ''; 
    let applicationFiles = new Map();
    let supportingFiles = new Map();
    let isApplicationFormConfirmed = false;
    let isSupportingDocsUploaded = false;
    let currentTrackingNumber = null;
    const tabOrder = ['guide', 'requirements', 'application', 'upload', 'process', 'department'];

    const filePaths = {
        "Building Permit": { guideImages: ["guides/BuildingPermit-Procedure-1.png", "guides/BuildingPermit-Procedure-2.png"], requirementsPdfs: ["requirements/BuildingPermit-Requirements.pdf"], applicationPdfs: ["application/BuildingPermit-Application.pdf"] },
        "Electrical Permit": { guideImages: ["guides/ElectricalPermit-Procedure-1.png", "guides/ElectricalPermit-Procedure-2.png"], requirementsPdfs: ["requirements/ElectricalPermit-Requirements.pdf"], applicationPdfs: ["application/ElectricalPermit-Application.pdf"] },
        "Demolition Permit": { guideImages: ["guides/DemolitionPermit-Procedure-1.png", "guides/DemolitionPermit-Procedure-2.png"], requirementsPdfs: ["requirements/DemolitionPermit-Requirements.pdf"], applicationPdfs: ["application/DemolitionPermit-Application.pdf"] },
        "Business Permit": { guideImages: ["guides/BusinessPermit-Procedure-1.png", "guides/BusinessPermit-Procedure-2.png"], requirementsPdfs: ["requirements/BusinessPermit-Requirements.pdf"], applicationPdfs: ["application/BusinessPermit-Application.pdf"] },
        "Sanitary Permit": { guideImages: ["guides/SanitaryPermit-Procedure-1.png", "guides/SanitaryPermit-Procedure-2.png"], requirementsPdfs: ["requirements/SanitaryPermit-Requirements.pdf"], applicationPdfs: ["application/SanitaryPermit-Application.pdf"] },
        "Birth Certificate": { guideImages: ["guides/BirthCertificate-Procedure-1.png", "guides/BirthCertificate-Procedure-2.png"], requirementsPdfs: ["requirements/BirthCertificate-Requirements.pdf"], applicationPdfs: ["application/BirthCertificate-Application.pdf"] },
        "Marriage License": { guideImages: ["guides/MarriageLicense-Procedure-1.png", "guides/MarriageLicense-Procedure-2.png"], requirementsPdfs: ["requirements/MarriageLicense-Requirements.pdf"], applicationPdfs: ["application/MarriageLicense-Application.pdf"] },
        "Death Certificate": { guideImages: ["guides/DeathCertificate-Procedure-1.png", "guides/DeathCertificate-Procedure-2.png"], requirementsPdfs: ["requirements/DeathCertificate-Requirements.pdf"], applicationPdfs: ["application/DeathCertificate-Application.pdf"] },
        "Certificate of Indigency": { guideImages: ["guides/CertificateofIndigency-Procedure-1.png", "guides/CertificateofIndigency-Procedure-2.png"], requirementsPdfs: ["requirements/CertificateofIndigency-Requirements.pdf"], applicationPdfs: ["application/CertificateofIndigency-Application.pdf"] },
        "Police Clearance": { guideImages: ["guides/PoliceClearance-Procedure-1.png", "guides/PoliceClearance-Procedure-2.png"], requirementsPdfs: ["requirements/PoliceClearance-Requirements.pdf"], applicationPdfs: ["application/PoliceClearance-Application.pdf"] },
        "Certificate of Environment Clearance": { guideImages: ["guides/CEC-Procedures-1.png", "guides/CEC-Procedures-2.png"], requirementsPdfs: ["requirements/CEC-Requirements.pdf"], applicationPdfs: ["application/ECClearance-Application.pdf"] },
        "Fire Safety Evaluation Clearance": { guideImages: ["guides/FSEC-Procedure-1.png", "guides/FSEC-Procedure-2.png"], requirementsPdfs: ["requirements/FSEC-Requirements.pdf"], applicationPdfs: ["application/FSEClearance-Application.pdf"] },
        "CENOMAR Certificate": { guideImages: ["guides/CENOMAR-Procedure-1.png", "guides/CENOMAR-Procedure-2.png"], requirementsPdfs: ["requirements/CENOMAR-Requirements.pdf"], applicationPdfs: ["application/CENOMARCertificate-Application.pdf"] },
        "Medical Certificate": { guideImages: ["guides/MedicalCertificate-Procedure-1.png"], requirementsPdfs: ["requirements/MedicalCertificate-Requirements.pdf"], applicationPdfs: ["application/MedicalCertificate-Application.pdf"] },
    };

    const getFilePaths = (type, fileCategory) => {
        const key = type;
        const paths = filePaths[key] && filePaths[key][fileCategory] ? filePaths[key][fileCategory] : null;

        if (!paths || paths.length === 0) {
            console.warn(`No file paths found for type: "${key}" and category: "${fileCategory}". Using a placeholder.`);
            if (fileCategory === 'guideImages') return [`https://via.placeholder.com/800x1100.png?text=Document+Not+Available`];
            if (fileCategory === 'requirementsPdfs' || fileCategory === 'applicationPdfs') return [""];
        }
        return paths; 
    };

    const createNextButton = (currentTabId) => {
        const currentIndex = tabOrder.indexOf(currentTabId);
        if (currentIndex < tabOrder.length - 1) {
            const nextTabId = tabOrder[currentIndex + 1];
            return `<button data-next-tab="${nextTabId}" class="next-tab-btn continue-btn">Next &rarr;</button>`;
        }
        return '';
    };

    const createHomeButton = () => {
        return `<a href="../home.php" class="continue-btn">Home</a>`;
    };
    
    const updateApplicationContent = (service, type) => {
        const applicationContentDiv = document.getElementById('dynamic-application-content');
        if (!applicationContentDiv) return;

        const serviceTitle = contentData[service].title;
        const applicationPdfs = getFilePaths(type, 'applicationPdfs');
        
        let pdfsHtml = '';
        if (applicationPdfs && applicationPdfs.length > 0 && applicationPdfs[0]) {
            pdfsHtml += `
                <h4 class="guide-heading application-form-heading">Official Application Form</h4>
                <div class="pdf-viewer-container" style="width: 100%; height: 700px; border: 1px solid #e2e8f0; border-radius: 0.375rem; overflow: hidden;">
                    <iframe src="${applicationPdfs[0]}#toolbar=0" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
                <p class="guide-text application-form-text">View the official application form above. You can also download it and other related forms below.</p>
                <div class="pdf-download-section">
            `;
            applicationPdfs.forEach((pdfPath) => {
                const pdfFileName = pdfPath.substring(pdfPath.lastIndexOf('/') + 1);
                pdfsHtml += `<a href="${pdfPath}" download="${pdfFileName}" class="continue-btn">${pdfFileName}</a>`;
            });
            pdfsHtml += '</div>';
        } else {
            pdfsHtml = `<p class="application-no-download-text">No downloadable application form available for this selection. Please visit the responsible department for the official form.</p>`;
        }

        const uploaderHtml = createUploadUI(
            'Upload Your Completed Application Form',
            'Please upload the filled-out application form. This is the first step before uploading other supporting documents.',
            null,
            true 
        );

        applicationContentDiv.innerHTML = `
            <h3 class="upload-heading">Online Application for ${serviceTitle}</h3>
            <p class="upload-description">This overview is for: <strong class="highlight-text-blue">${type}</strong>.</p>
            <div class="guide-content-wrapper guide-content-wrapper-border">${pdfsHtml}</div>
            <div class="upload-section-divider">${uploaderHtml}</div>
        `;
        addUploadFunctionality(true);
    };

    const updateGuideContent = (service, type) => {
        const guideContentDiv = document.getElementById('dynamic-guide-content');
        if (!guideContentDiv) return;

        const dropdownHtml = contentData[service].guideDropdownHtml || '';
        let imagesHtml = '';

        if (type) {
            const guideImages = getFilePaths(type, 'guideImages');
            imagesHtml = '<div class="guide-images-grid">';
            guideImages.forEach((imagePath, index) => {
                const imageFileName = imagePath.substring(imagePath.lastIndexOf('/') + 1);
                imagesHtml += `
                    <div class="guide-image-item">
                        <a href="${imagePath}" target="_blank" title="View full image">
                            <img src="${imagePath}" alt="Process Overview ${index + 1} for ${type}" class="guide-image">
                        </a>
                        <div class="guide-image-info-bar">
                            <span class="guide-image-filename">${imageFileName}</span>
                            <a href="${imagePath}" download="${imageFileName}" class="guide-image-download-btn">Download</a>
                        </div>
                    </div>
                `;
            });
            imagesHtml += '</div>';
        }

        guideContentDiv.innerHTML = `
            <h3 class="guide-heading">Process Overview</h3>
            <p class="guide-text">Review the general process below. Please select a specific document type to see the detailed guide. Current type selected: <strong class="highlight-text-blue">${type || 'None'}</strong>.</p>
            ${dropdownHtml}
            <div class="guide-images-container">${imagesHtml}</div>
            ${type ? createNextButton('guide') : ''}
        `;
    };

    const updateRequirementsContent = (service, type) => {
        const requirementsContentDiv = document.getElementById('dynamic-requirements-content');
        if (!requirementsContentDiv) return;

        let pdfHtml = '';
        if (type) {
            const requirementsPdfs = getFilePaths(type, 'requirementsPdfs');
            if (requirementsPdfs && requirementsPdfs.length > 0 && requirementsPdfs[0]) {
                const pdfPath = requirementsPdfs[0];
                const pdfFileName = pdfPath.substring(pdfPath.lastIndexOf('/') + 1);
                pdfHtml = `
                    <div class="pdf-viewer-container" style="width: 100%; height: 700px; border: 1px solid #e2e8f0; border-radius: 0.375rem; overflow: hidden;">
                        <iframe src="${pdfPath}#toolbar=0" style="width: 100%; height: 100%; border: none;"></iframe>
                    </div>
                    <div class="requirements-download-section">
                        <a href="${pdfPath}" download="${pdfFileName}" class="continue-btn">${pdfFileName}</a>
                    </div>
                `;
            } else {
                pdfHtml = `<p class="requirements-no-pdf-text">No requirements PDF available for this selection.</p>`;
            }
        }

        requirementsContentDiv.innerHTML = `
            <h3 class="guide-heading">Documentary Requirements</h3>
            <p class="guide-text">Please prepare all the required documents listed for: <strong class="highlight-text-blue">${type || 'None'}</strong>.</p>
            <div class="requirements-pdf-container">${pdfHtml}</div>
            ${type ? createNextButton('requirements') : ''}
        `;
    };

const contentData = {
    permits: {
        title: 'Permits',
        guideDropdownHtml: `<div class="dropdown-container"><label for="permit-type-select" class="dropdown-label">Select Permit Type:</label><select id="permit-type-select" name="permit-type" class="dropdown-select"><option value="">-- Please Select --</option><option value="Building Permit">Building Permit</option><option value="Electrical Permit">Electrical Permit</option><option value="Sanitary Permit">Sanitary Permit</option><option value="Demolition Permit">Demolition Permit</option><option value="Business Permit">Business Permit</option></select></div>`,
        processHtml: () => `
            <h3 class="upload-heading">General Permit Application Process</h3>
            <ol class="process-list">
                <li><strong>Application & Document Submission:</strong> Secure and fill out the application form. Compile all required documents, which may include technical plans, previous clearances, and identification. Submit the complete package to the receiving window of the responsible office.</li>
                <li><strong>Assessment & Evaluation:</strong> An officer will review your documents for completeness and compliance with regulations. For technical permits (e.g., Building, Electrical), a detailed evaluation of plans will be conducted by an engineer or building official.</li>
                <li><strong>Fee Assessment & Payment:</strong> Once the evaluation is complete, the corresponding fees will be assessed. Proceed to the Municipal Treasurer's Office to pay the required fees and secure an Official Receipt.</li>
                <li><strong>Inspection (if applicable):</strong> Some permits, particularly for building and business operations, require an on-site inspection to ensure compliance with safety, sanitation, and zoning regulations.</li>
                <li><strong>Approval & Issuance:</strong> Upon successful evaluation, payment, and inspection, your application will be forwarded for final approval. Once signed, the permit will be released to you.</li>
            </ol>
            ${createNextButton('process')}`,
        departmentHtml: () => `
            <h3 class="upload-heading">Departments for Permits</h3>
            <p class="upload-description">Permits are handled by specialized offices. Please direct your inquiries to the appropriate department based on your application.</p>
            <div class="department-info-container">
                <div>
                    <h4 class="department-heading">Municipal Engineering Office / Office of the Building Official (OBO)</h4>
                    <p class="department-contact"><strong>Head:</strong> Engr. Norberto Cancino</p>
                    <p class="department-description">This office is responsible for enforcing the National Building Code and related regulations. They process and issue permits related to construction and structural work.</p>
                    <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Building Permit</li>
                        <li>Electrical Permit</li>
                        <li>Demolition Permit</li>
                    </ul>
                </div>
                <div>
                    <h4 class="department-heading">Business Permit and Licensing Office (BPLO)</h4>
                    <p class="department-description">The BPLO handles the registration and regulation of all business establishments operating within the municipality. This office is typically under the Office of the Mayor.</p>
                    <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Business Permit (New and Renewal)</li>
                    </ul>
                </div>
                <div>
                    <h4 class="department-heading">Rural Health Office</h4>
                     <p class="department-contact"><strong>Head:</strong> Dra. Catherine B. Licuanan</p>
                    <p class="department-description">The municipal health office ensures that establishments comply with the Sanitation Code and public health standards.</p>
                    <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Sanitary Permit</li>
                    </ul>
                </div>
            </div>
            <div class="home-button-container">${createHomeButton()}</div>`
    },
    certificates: {
        title: 'Certificates',
        guideDropdownHtml: `<div class="dropdown-container"><label for="certificate-type-select" class="dropdown-label">Select Certificate Type:</label><select id="certificate-type-select" name="certificate-type" class="dropdown-select"><option value="">-- Please Select --</option><option value="Birth Certificate">Birth Certificate</option><option value="Death Certificate">Death Certificate</option><option value="Certificate of Indigency">Certificate of Indigency</option><option value="CENOMAR Certificate">CENOMAR Certificate</option><option value="Medical Certificate">Medical Certificate</option></select></div>`,
        processHtml: () => `
            <h3 class="upload-heading">General Certificate Application Process</h3>
            <ol class="process-list">
                <li><strong>Request and Verification:</strong> Approach the relevant office (e.g., Local Civil Registrar or Barangay Hall) and state your request. Provide necessary details for the clerk to search the official records.</li>
                <li><strong>Fill Out Request Form:</strong> Complete a request form with the full name, date of event (birth, marriage, death), and other pertinent information. Present a valid ID for verification.</li>
                <li><strong>Fee Payment:</strong> Pay the processing fee at the Municipal Treasurer's Office or the designated collection officer and get an Official Receipt.</li>
                <li><strong>Processing and Printing:</strong> The clerk will process your request, print the certificate on official security paper (for civil registry documents), and have it signed by the authorized official.</li>
                <li><strong>Release:</strong> The certified copy of the document will be released to you upon presentation of the official receipt.</li>
            </ol>
            ${createNextButton('process')}`,
        departmentHtml: () => `
            <h3 class="upload-heading">Departments for Certificates</h3>
            <p class="upload-description">Certificates are issued by the office that holds the corresponding official records.</p>
            <div class="department-info-container">
                <div>
                    <h4 class="department-heading">Local Civil Registrar (LCR) Office</h4>
                    <p class="department-description">The LCR is responsible for recording vital life events (births, marriages, deaths) and serves as the local repository for these records.</p>
                     <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Birth Certificate</li>
                        <li>Death Certificate</li>
                        <li>CENOMAR Certificate</li>
                    </ul>
                </div>
                 <div>
                    <h4 class="department-heading">Rural Health Office</h4>
                    <p class="department-contact"><strong>Head:</strong> Dra. Catherine B. Licuanan</p>
                    <p class="department-description">The Rural Health Unit provides health services to the community and issues certificates based on medical records or examinations.</p>
                     <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Medical Certificate</li>
                    </ul>
                </div>
                <div>
                    <h4 class="department-heading">Municipal Social Welfare and Development Office (MSWDO)</h4>
                     <p class="department-contact"><strong>Head:</strong> Mercedes Bigay</p>
                    <p class="department-description">The MSWDO provides social services and assistance to individuals and families in need, including assessments for indigency.</p>
                     <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Certificate of Indigency</li>
                    </ul>
                </div>
            </div>
            <div class="home-button-container">${createHomeButton()}</div>`
    },
    clearances: {
        title: 'Clearances',
        guideDropdownHtml: `<div class="dropdown-container"><label for="clearance-type-select" class="dropdown-label">Select Clearance Type:</label><select id="clearance-type-select" name="clearance-type" class="dropdown-select"><option value="">-- Please Select --</option><option value="Certificate of Environment Clearance">Certificate of Environment Clearance</option><option value="Police Clearance">Police Clearance</option><option value="Fire Safety Evaluation Clearance">Fire Safety Evaluation Clearance</option></select></div>`,
        processHtml: () => `
            <h3 class="upload-heading">General Clearance Application Process</h3>
            <p class="upload-description">A clearance is an official document stating that a person or entity has no outstanding issues or obligations in the jurisdiction of the issuing body.</p>
            <ol class="process-list">
                <li><strong>Secure Application Form:</strong> Obtain the application form from the respective office (Barangay, Police Station, or Mayor's Office).</li>
                <li><strong>Submit Requirements:</strong> Present the completed form along with necessary requirements, which typically include a valid ID, proof of residency (like a Barangay Clearance), and the official receipt for payment.</li>
                <li><strong>Verification/Background Check:</strong> The office will check its records for any outstanding issues, liabilities, or criminal records associated with your name.</li>
                <li><strong>Biometrics (if applicable):</strong> Some clearances, like those from the police or NBI, require capturing your photograph, fingerprints, and signature.</li>
                <li><strong>Issuance:</strong> If no issues are found, the clearance certificate will be printed, signed, and issued to you.</li>
            </ol>
            ${createNextButton('process')}`,
        departmentHtml: () => `
            <h3 class="upload-heading">Departments for Clearances</h3>
            <p class="upload-description">Clearances are issued by different local and national government units to certify a person's or entity's standing.</p>
            <div class="department-info-container">
                <div>
                    <h4 class="department-heading">Philippine National Police (PNP) / Police Clearance Desk</h4>
                    <p class="department-description">The local PNP station issues police clearances to certify that an individual has no pending criminal cases within the municipality. This is usually coordinated with the Mayor's Office.</p>
                     <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Police Clearance</li>
                    </ul>
                </div>
                 <div> 
                    <h4 class="department-heading">Municipal Environmental Office</h4>
                    <p class="department-description">This office is tasked with implementing environmental laws and managing programs for environmental protection and sustainability.</p>
                     <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Certificate of Environment Clearance</li>
                    </ul>
                </div>
                <div>
                    <h4 class="department-heading">Bureau of Fire Protection (BFP) / Municipal Fire Safety Desk</h4>
                    <p class="department-description">The BFP is responsible for fire prevention and suppression, as well as enforcing the Fire Code of the Philippines. They issue clearances related to fire safety inspections.</p>
                    <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Fire Safety Evaluation Clearance</li>
                    </ul>
                </div>
            </div>
            <div class="home-button-container">${createHomeButton()}</div>`
    },
    licenses: {
        title: 'Licenses',
        guideDropdownHtml: `<div class="dropdown-container"><label for="license-type-select" class="dropdown-label">Select License Type:</label><select id="license-type-select" name="license-type" class="dropdown-select"><option value="">-- Please Select --</option><option value="Marriage License">Marriage License</option></select></div>`,
        processHtml: () => `
            <h3 class="upload-heading">General License Application Process</h3>
            <p class="upload-description">A license is a formal permission from an authoritative body to do, use, or own something. The process varies significantly depending on the type of license.</p>
            <ol class="process-list">
                <li><strong>Fulfill Pre-requisites:</strong> This is the most critical step. It may involve passing an exam (Professional/Driver's License), completing other permits (Business License), or attending seminars.</li>
                <li><strong>Submit Application & Requirements:</strong> File an application with the responsible agency along with all supporting documents.</li>
                <li><strong>Assessment and Payment:</strong> Pay the required fees for application, processing, and the license itself.</li>
                <li><strong>Evaluation / Examination:</strong> Your application and qualifications will be evaluated. This may involve written or practical examinations.</li>
                <li><strong>Issuance of License:</strong> Once all requirements are met and assessments are passed, the license (often in card or certificate form) will be issued. Licenses are typically valid for a specific period and require renewal.</li>
            </ol>
            ${createNextButton('process')}`,
        departmentHtml: () => `
            <h3 class="upload-heading">Departments for Licenses</h3>
            <p class="upload-description">Licenses are issued by various local and national agencies, depending on their purpose.</p>
            <div class="department-info-container">
                 <div>
                    <h4 class="department-heading">Local Civil Registrar (LCR) Office</h4>
                    <p class="department-description">Before a marriage can be solemnized, the LCR processes applications and issues the Marriage License, certifying that the couple is eligible to marry.</p>
                     <p class="department-files-title"><strong>Files Managed in this Category:</strong></p>
                    <ul class="department-list">
                        <li>Marriage License</li>
                    </ul>
                </div>
                <div>
                    <h4 class="department-heading">Business Permit and Licensing Office (BPLO)</h4>
                    <p class="department-description">The BPLO issues the primary license required to legally operate a business within the municipality.</p>
                    <ul class="department-list">
                        <li>Business License (Note: The main application is in the 'Permits' section)</li>
                    </ul>
                </div>
                <div>
                    <h4 class="department-heading">Land Transportation Office (LTO)</h4>
                    <p class="department-description">The LTO is the national agency responsible for issuing driver's licenses and registering motor vehicles.</p>
                    <ul class="department-list">
                        <li>Driver's License (National Agency)</li>
                    </ul>
                </div>
            </div>
            <div class="home-button-container">${createHomeButton()}</div>`
    }
};

    const createGuideUI = () => `<div id="dynamic-guide-content"></div>`;
    const createRequirementsUI = () => `<div id="dynamic-requirements-content"></div>`;
    const createApplicationUI = () => `<div id="dynamic-application-content"></div>`;
    const createProcessUI = (service) => `<div>${contentData[service].processHtml(service)}</div>`;
    const createDepartmentUI = (service) => `<div>${contentData[service].departmentHtml(service)}</div>`;

    const createUploadUI = (heading, description, nextButtonTab, isApplicationTab = false) => {
        const buttonText = isApplicationTab ? 'Confirm Application Form' : 'Upload Files';
        let nextButtonHtml = '';
        
        if (isApplicationTab) {
            nextButtonHtml = '<div id="next-btn-container" class="next-button-container"></div>';
        } else if (nextButtonTab) {
            nextButtonHtml = `<div class="next-button-container">${createNextButton(nextButtonTab)}</div>`;
        }

        const fileInputAttributes = isApplicationTab ? '' : 'multiple';

        return `
        <div>
            <h3 class="upload-heading">${heading}</h3>
            <p class="upload-description">${description}</p>
            <div class="max-w-xl mx-auto upload-area-spacing">
                <p class="upload-formats-text">Accepted formats: PDF, JPEG, PNG. Max size: 5MB per file.</p>
                <input type="file" id="file-input" ${fileInputAttributes} class="visually-hidden-input">
                <label for="file-input" id="drop-zone" class="drop-zone">
                    
                    <svg class="drop-zone-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l-3 3m3-3l3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <p class="drop-zone-main-text">Drag & drop files here</p>
                    <p class="drop-zone-or-text">or</p>
                    <span class="drop-zone-browse-text">Click to browse</span>
                </label>
                <div id="file-list-container" class="file-list-container">
                    <h4 class="file-list-heading">Selected Files:</h4>
                    <ul id="file-list" class="file-list"></ul>
                </div>
                <div id="upload-feedback" class="upload-feedback" style="display: none;"></div>
                <button id="upload-btn" class="upload-btn" disabled>${buttonText}</button>
            </div>
            ${nextButtonHtml}
        </div>`;
    };

    const showTab = (tabId) => {
        if (!selectedServiceType && ['requirements', 'application', 'upload', 'process', 'department'].includes(tabId)) {
            alert('Please select a specific document type from the "Step-by-Step Guide" tab first.');
            return;
        }

        if (['upload', 'process', 'department'].includes(tabId) && !isApplicationFormConfirmed) {
            alert('Please confirm your application form in the "Online Application" tab before proceeding.');
            return;
        }

        if (['process', 'department'].includes(tabId) && !isSupportingDocsUploaded) {
            alert('Please complete the "Upload Supporting Document/s" step before proceeding.');
            return;
        }

        tabPanes.forEach(pane => { 
            if(pane.id !== `${tabId}-content`) {
                pane.innerHTML = ''; 
            }
        }); 

        if (tabId === 'guide') {
            const el = document.getElementById('guide-content');
            if (el.innerHTML === '') {
                el.innerHTML = createGuideUI();
                updateGuideContent(currentService, selectedServiceType);
            }
        } else if (tabId === 'requirements') {
            const el = document.getElementById('requirements-content');
            if (el.innerHTML === '') {
                el.innerHTML = createRequirementsUI();
                updateRequirementsContent(currentService, selectedServiceType);
            }
        } else if (tabId === 'application') {
            const el = document.getElementById('application-content');
            if (el.innerHTML === '') {
                el.innerHTML = createApplicationUI();
                updateApplicationContent(currentService, selectedServiceType);
            }
        } else if (tabId === 'upload') {
            const el = document.getElementById('upload-content');
            if (el.innerHTML === '' || (el.querySelector('#upload-btn') && el.querySelector('#upload-btn').textContent === 'Confirm Application Form')) {
                 el.innerHTML = createUploadUI(
                    'Upload Supporting Document/s',
                    'Here you can upload any additional documentary requirements. Please see the "Requirements" tab to confirm all necessary files.',
                    'upload',
                    false 
                );
                addUploadFunctionality(false);
            }
        } else if (tabId === 'process') {
             const el = document.getElementById('process-content');
             if (el.innerHTML === '') el.innerHTML = createProcessUI(currentService);
        } else if (tabId === 'department') {
            const el = document.getElementById('department-content');
            if (el.innerHTML === '') el.innerHTML = createDepartmentUI(currentService);
        }
        
        tabPanes.forEach(pane => pane.style.display = 'none');
        document.getElementById(`${tabId}-content`).style.display = 'block';

        detailTabs.forEach(tab => tab.classList.remove('detail-tab-active'));
        document.querySelector(`.detail-tab[data-tab="${tabId}"]`).classList.add('detail-tab-active');
    };
    
    document.body.addEventListener('change', function(event) {
        let dropdownId;
        if (currentService === 'permits') dropdownId = 'permit-type-select';
        else if (currentService === 'certificates') dropdownId = 'certificate-type-select';
        else if (currentService === 'clearances') dropdownId = 'clearance-type-select';
        else if (currentService === 'licenses') dropdownId = 'license-type-select';

        if (event.target.id === dropdownId) {
            selectedServiceType = event.target.value;
            isApplicationFormConfirmed = false; 
            isSupportingDocsUploaded = false;
            currentTrackingNumber = null;
            applicationFiles.clear();
            supportingFiles.clear();
            
            tabPanes.forEach(pane => pane.innerHTML = '');
            
            const activeTab = document.querySelector('.detail-tab-active').dataset.tab;
            showTab(activeTab);
        }
    });

    document.body.addEventListener('click', function(event) {
        if (event.target.matches('.next-tab-btn')) {
            const nextTab = event.target.dataset.nextTab;
            if (nextTab) {
                showTab(nextTab);
            }
        }
    });
    
    serviceBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            currentService = btn.dataset.service;
            selectedServiceType = ''; 
            serviceDetailTitle.textContent = contentData[currentService].title;
            serviceSelectionView.style.display = 'none';
            serviceDetailView.style.display = 'block';
            showTab('guide');
        });
    });

    backBtn.addEventListener('click', () => {
        serviceDetailView.style.display = 'none';
        serviceSelectionView.style.display = 'block';
        currentService = '';
        selectedServiceType = ''; 
        applicationFiles.clear();
        supportingFiles.clear();
        isApplicationFormConfirmed = false;
        isSupportingDocsUploaded = false; 
        currentTrackingNumber = null;
    });

    detailTabs.forEach(tab => {
        tab.addEventListener('click', (event) => {
            event.preventDefault(); 
            showTab(tab.dataset.tab);
        });
    });
    
    function addUploadFunctionality(isApplicationTab = false) {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const fileList = document.getElementById('file-list');
        const uploadBtn = document.getElementById('upload-btn');
        const uploadFeedback = document.getElementById('upload-feedback');
        
        if (!dropZone || !fileInput || !fileList || !uploadBtn || !uploadFeedback) {
            console.error("One or more upload UI elements could not be found.");
            return;
        }
        
        const currentFiles = isApplicationTab ? applicationFiles : supportingFiles;

        const updateFileList = () => {
            fileList.innerHTML = '';
            if (currentFiles.size === 0) {
                fileList.innerHTML = `<li id="no-files-message" class="no-files-message">No files selected.</li>`;
                uploadBtn.disabled = true;
            } else {
                currentFiles.forEach((file, name) => {
                    fileList.innerHTML += `<li class="file-item"><span class="file-item-name">${file.name}</span><button data-filename="${name}" class="remove-file-btn">&times;</button></li>`;
                });
                uploadBtn.disabled = false;
            }
        };

        const handleFiles = (files) => {
            if (isApplicationTab && files.length > 1) {
                alert("Please upload only one file for the application form.");
                return;
            }

            for (const file of files) {
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File "${file.name}" exceeds the 5MB limit.`);
                    continue;
                }
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert(`File "${file.name}" has an unsupported format. Only PDF, JPEG, PNG are allowed.`);
                    continue;
                }
                if (isApplicationTab) {
                    currentFiles.clear(); 
                }
                currentFiles.set(file.name, file);
            }
            updateFileList();
        };
        
        const uploadButtonClickHandler = () => {
            if (currentFiles.size === 0) {
                uploadFeedback.className = 'upload-feedback error';
                uploadFeedback.innerHTML = `<p class="upload-feedback-text">Please select at least one file to upload.</p>`;
                uploadFeedback.style.display = 'block';
                return;
            }

            const formData = new FormData();
            currentFiles.forEach((file) => {
                formData.append('documents[]', file);
            });
            formData.append('serviceType', selectedServiceType);
            formData.append('uploadType', isApplicationTab ? 'application' : 'supporting');
            
            if (!isApplicationTab && currentTrackingNumber) {
                formData.append('trackingNumber', currentTrackingNumber);
            }

            uploadBtn.disabled = true;
            uploadBtn.textContent = 'Uploading...';
            uploadFeedback.style.display = 'none';

            fetch('service.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                const contentType = response.headers.get("content-type");
                
                if (!contentType || !contentType.includes("application/json")) {
                    return response.text().then(text => {
                        console.error("Non-JSON response from server (possible PHP die/exit):", text);

                        throw new Error(`Server returned an unexpected response. Please try again later. (Details: "${text.substring(0, 100)}...")`); 
                    });
                }
                
                if (!response.ok) {

                    return response.json().then(err => {
                        throw new Error(err.message || `Server error: ${response.status} ${response.statusText}`);
                    });
                }

                return response.json();
            })
            .then(data => {
                uploadFeedback.style.display = 'block';
                if (data.status === 'success') {
                    uploadFeedback.className = 'upload-feedback success';
                    
                    if (isApplicationTab) {
                        currentTrackingNumber = data.trackingNumber; 
                        isApplicationFormConfirmed = true;
                        uploadBtn.textContent = 'Confirmed';
                        uploadBtn.disabled = true; 

                        const successHtml = `
                            <div class="upload-success-content">
                                    <p class="upload-feedback-text">Success! Application form confirmed.</p>
                                    <p class="upload-tracking-instruction" style="margin-top: 1rem;">You may now proceed to the next step to upload supporting documents.</p>
                            </div>
                        `;
                        uploadFeedback.innerHTML = successHtml;
                        
                        const nextBtnContainer = document.getElementById('next-btn-container');
                        if (nextBtnContainer) {
                            nextBtnContainer.innerHTML = createNextButton('application');
                        }
                    } else { 
                        isSupportingDocsUploaded = true;
                        const successHtml = `
                            <div class="upload-success-content">
                                <p class="upload-feedback-text">Success! ${currentFiles.size} file(s) uploaded.</p>
                                <p class="upload-tracking-instruction">Your application reference number is:</p>
                                <div class="tracking-number-display-container">
                                    <strong id="tracking-number-display" class="tracking-number-display">${data.trackingNumber}</strong>
                                    <button id="copy-tracking-btn" class="copy-tracking-btn-upload">COPY</button>
                                </div>
                                <p id="copy-feedback-upload" class="copy-feedback-message-upload" style="display: none;">Copied to clipboard!</p>
                            </div>`;
                        uploadFeedback.innerHTML = successHtml;

                        const copyBtn = document.getElementById('copy-tracking-btn');
                        if (copyBtn) {
                            copyBtn.addEventListener('click', () => {
                                try {
                                    navigator.clipboard.writeText(data.trackingNumber);
                                    const feedback = document.getElementById('copy-feedback-upload');
                                    if (feedback) {
                                        feedback.style.display = 'block';
                                        setTimeout(() => { feedback.style.display = 'none'; }, 2000);
                                    }
                                } catch (err) {
                                    console.error('Failed to copy: ', err);
                                }
                            });
                        }
                        
                        uploadBtn.textContent = 'Upload More Files';
                        uploadBtn.disabled = false;
                        currentFiles.clear();
                        updateFileList();
                    }
                } else {
             
                    throw new Error(data.message || 'An unknown error occurred on the server.');
                }
            })
            .catch(error => {
                console.error('Upload Error:', error);
                uploadFeedback.className = 'upload-feedback error';
                uploadFeedback.innerHTML = `<p class="upload-feedback-text">Error: ${error.message}</p>`;
                uploadFeedback.style.display = 'block';
                uploadBtn.disabled = false;
                uploadBtn.textContent = isApplicationTab ? 'Confirm Application Form' : 'Upload Files';
            });
        };
        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('drag-over'); });
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
        dropZone.addEventListener('drop', (e) => { e.preventDefault(); dropZone.classList.remove('drag-over'); handleFiles(e.dataTransfer.files); });
        
        fileInput.addEventListener('change', () => { 
            handleFiles(fileInput.files); 
            fileInput.value = ''; 
        });

        fileList.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-file-btn')) {
                if (isApplicationFormConfirmed && isApplicationTab) {
                    alert("Application form is already confirmed. To change the file, please reset the process by selecting a new document type from the 'Step-by-Step' tab.");
                    return;
                }
                currentFiles.delete(e.target.dataset.filename);
                updateFileList();
            }
        });
        
        uploadBtn.addEventListener('click', uploadButtonClickHandler);

        updateFileList();
    }
    });
