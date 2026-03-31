<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Payment | {{ config('app.name', 'Fleet Manager') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Flatpickr for date picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <style>
        :root {
            --primary-50: #ecfdf5;
            --primary-100: #d1fae5;
            --primary-200: #a7f3d0;
            --primary-300: #6ee7b7;
            --primary-400: #34d399;
            --primary-500: #10b981;
            --primary-600: #059669;
            --primary-700: #047857;
            --primary-800: #065f46;
            --primary-900: #064e3b;
            
            --success-50: #f0fdf4;
            --success-100: #dcfce7;
            --success-500: #22c55e;
            --success-600: #16a34a;
            
            --warning-50: #fefce8;
            --warning-100: #fef9c3;
            --warning-500: #eab308;
            --warning-600: #ca8a04;
            
            --danger-50: #fef2f2;
            --danger-100: #fee2e2;
            --danger-500: #ef4444;
            --danger-600: #dc2626;
            
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

         body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;

            background: 
                linear-gradient(rgba(245, 247, 250, 0.5), rgba(233, 236, 239, 0.5)),
                url('/images/bike.jpg');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.03) 0%, transparent 70%);
            animation: float 20s infinite ease-in-out;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(5, 150, 105, 0.03) 0%, transparent 70%);
            animation: float 25s infinite ease-in-out reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(5%, 5%) rotate(1deg); }
            66% { transform: translate(-5%, -5%) rotate(-1deg); }
        }

        /* Modern Card Styles */
        .modern-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 2rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Form Controls */
        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-label .required {
            color: var(--danger-500);
            margin-left: 0.25rem;
        }

        .form-control-modern {
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-select-modern {
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            padding: 0.75rem 2rem 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form-select-modern:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        /* Input Group */
        .input-group-modern {
            position: relative;
        }

        .input-group-modern i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            z-index: 2;
        }

        .input-group-modern .form-control-modern {
            padding-left: 2.5rem;
        }

        /* Amount Input */
        .amount-input-group {
            position: relative;
        }

        .amount-input-group .prefix {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-600);
            font-weight: 600;
            z-index: 2;
        }

        .amount-input-group .form-control-modern {
            padding-left: 3.5rem;
        }

        /* File Upload */
        .upload-area {
            border: 2px dashed var(--gray-300);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: var(--gray-50);
        }

        .upload-area:hover {
            border-color: var(--primary-500);
            background: rgba(16, 185, 129, 0.05);
        }

        .upload-area.dragover {
            border-color: var(--primary-500);
            background: rgba(16, 185, 129, 0.1);
            transform: scale(1.02);
        }

        .upload-icon {
            width: 64px;
            height: 64px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: var(--primary-600);
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .upload-area:hover .upload-icon {
            transform: scale(1.1);
            background: var(--primary-600);
            color: white;
        }

        /* Image Preview */
        .image-preview {
            margin-top: 1rem;
            position: relative;
            display: inline-block;
        }

        .preview-image {
            max-width: 200px;
            max-height: 150px;
            border-radius: 16px;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .remove-image {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            background: var(--danger-600);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid white;
        }

        .remove-image:hover {
            transform: scale(1.1);
            background: var(--danger-700);
        }

        /* Preview Card */
        .preview-card {
            background: linear-gradient(135deg, var(--gray-50), white);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .preview-card:hover {
            border-color: var(--primary-300);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .preview-item {
            padding: 0.75rem;
            background: white;
            border-radius: 12px;
            margin-bottom: 0.5rem;
        }

        .preview-label {
            font-size: 0.7rem;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .preview-value {
            font-weight: 600;
            color: var(--gray-800);
            word-break: break-word;
        }

        /* Buttons */
        .btn-gradient-primary {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: white;
            border: none;
            border-radius: 16px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-gradient-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-gradient-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-outline-modern {
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            background: white;
        }

        .btn-outline-modern:hover {
            border-color: var(--primary-500);
            background: var(--primary-50);
            transform: translateY(-2px);
        }

        /* Validation Messages */
        .validation-message {
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            border-radius: 12px;
        }

        .validation-message.error {
            background: var(--danger-50);
            color: var(--danger-700);
        }

        .validation-message.success {
            background: var(--success-50);
            color: var(--success-700);
        }

        /* Toast */
        .toast-notification {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
        }

        /* Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: white;
            border: none;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .preview-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-gradient-primary,
            .btn-outline-modern {
                padding: 0.625rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="animated-bg"></div>

    <!-- Toast Container -->
    <div class="toast-notification" id="toastContainer"></div>

    <!-- Main Content -->
    <main class="container py-4 py-lg-5">
        <div class="container px-4 px-lg-5">
            
            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
                <div class="d-flex gap-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-modern">
                        <i class="fas fa-list me-2"></i>All Payments
                    </a>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="modern-card">
                <div class="page-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-20 rounded-3 p-3">
                            <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                        </div>
                        <div>
                            <h2 class="h4 fw-bold text-white mb-1">Payment Information</h2>
                            <p class="text-white text-opacity-90 mb-0 small">Fill in the details below to record a new payment</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 p-lg-5">
                    <form method="POST" action="{{ route('payments.store') }}" enctype="multipart/form-data" id="paymentForm">
                        @csrf

                        <!-- Validation Errors -->
                        @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-4 mb-4">
                            <div class="d-flex gap-3">
                                <i class="fas fa-exclamation-circle fa-lg mt-1"></i>
                                <div>
                                    <strong class="d-block mb-1">Please fix the following errors:</strong>
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                        <li class="small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row g-4">
                            <!-- Driver Selection -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-user me-1 text-primary"></i>Driver
                                    <span class="required">*</span>
                                </label>
                                <select name="driver_id" class="form-select-modern w-100" required id="driverSelect">
                                    <option value="" disabled selected>Select a driver...</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" data-name="{{ $driver->user->name }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->user->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Contract Selection -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-file-contract me-1 text-primary"></i>Contract
                                    <span class="required">*</span>
                                </label>
                                <select name="contract_id" class="form-select-modern w-100" required id="contractSelect">
                                    <option value="" disabled selected>Select a contract...</option>
                                    @foreach($contracts as $contract)
                                    <option value="{{ $contract->id }}" 
                                            data-plate="{{ $contract->motorbike->plate_number }}"
                                            data-driver="{{ $contract->driver->user->name }}"
                                            {{ old('contract_id') == $contract->id ? 'selected' : '' }}>
                                        {{ $contract->motorbike->plate_number }} - {{ $contract->driver->user->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Amount -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-tag me-1 text-primary"></i>Amount (Tsh)
                                    <span class="required">*</span>
                                </label>
                                <div class="amount-input-group">
                                    <span class="prefix">Tsh</span>
                                    <input type="number" 
                                           name="amount" 
                                           class="form-control-modern w-100" 
                                           placeholder="0.00"
                                           value="{{ old('amount') }}"
                                           step="0.01"
                                           min="0"
                                           required
                                           id="amountInput">
                                </div>
                                <div id="amountValidation" class="validation-message d-none"></div>
                            </div>

                            <!-- Payment Date -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1 text-primary"></i>Payment Date
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar-alt"></i>
                                    <input type="date" 
                                           name="payment_date" 
                                           class="form-control-modern w-100" 
                                           value="{{ old('payment_date', date('Y-m-d')) }}"
                                           required
                                           id="dateInput">
                                </div>
                            </div>

                            <!-- Payment Image Upload -->
                            <div class="col-12">
                                <label class="form-label">
                                    <i class="fas fa-image me-1 text-primary"></i>Payment Receipt
                                    <span class="text-muted small fw-normal">(Optional)</span>
                                </label>
                                <div class="upload-area" id="uploadArea">
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <p class="mb-1">Click or drag receipt image to upload</p>
                                    <small class="text-muted">Supports: JPG, PNG, GIF (Max 5MB)</small>
                                    <input type="file" name="payment_image" accept="image/*" id="imageInput" class="d-none">
                                </div>
                                <div id="imagePreview" class="image-preview" style="display: none;">
                                    <img src="#" alt="Receipt preview" class="preview-image">
                                    <div class="remove-image" onclick="removeImage()">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Card -->
                            <div class="col-12">
                                <div class="preview-card">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-eye me-2 text-primary"></i>Payment Preview
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Driver</div>
                                                <div class="preview-value" id="previewDriver">Not selected</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Contract</div>
                                                <div class="preview-value" id="previewContract">Not selected</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Amount</div>
                                                <div class="preview-value" id="previewAmount">Tsh 0</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Payment Date</div>
                                                <div class="preview-value" id="previewDate">Not selected</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Receipt</div>
                                                <div class="preview-value" id="previewReceipt">Not uploaded</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Status</div>
                                                <div class="preview-value">
                                                    <span class="badge bg-success bg-opacity-10 text-success">Ready to submit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="col-12">
                                <div class="d-flex gap-3 pt-3">
                    
                                    <button type="submit" class="btn btn-gradient-primary flex-grow-1" id="submitBtn">
                                        <i class="fas fa-money-bill-wave me-2"></i>Record Payment
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center text-muted small border-top bg-white bg-opacity-50">
        <div class="container">
            &copy; {{ date('Y') }} {{ config('app.name', 'FleetManager') }}. All rights reserved.
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        // Initialize flatpickr
        flatpickr("#dateInput", {
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate: "today"
        });

        // Preview update function
        function updatePreview() {
            // Driver preview
            const driverSelect = document.getElementById('driverSelect');
            const selectedDriver = driverSelect.options[driverSelect.selectedIndex];
            document.getElementById('previewDriver').textContent = 
                selectedDriver && selectedDriver.value ? selectedDriver.text : 'Not selected';

            // Contract preview
            const contractSelect = document.getElementById('contractSelect');
            const selectedContract = contractSelect.options[contractSelect.selectedIndex];
            document.getElementById('previewContract').textContent = 
                selectedContract && selectedContract.value ? selectedContract.text : 'Not selected';

            // Amount preview
            const amount = document.getElementById('amountInput').value;
            document.getElementById('previewAmount').textContent = 
                amount ? 'Tsh ' + parseFloat(amount).toLocaleString() : 'Tsh 0';

            // Date preview
            const date = document.getElementById('dateInput').value;
            if (date) {
                const formattedDate = new Date(date).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                document.getElementById('previewDate').textContent = formattedDate;
            } else {
                document.getElementById('previewDate').textContent = 'Not selected';
            }
        }

        // Add event listeners
        document.getElementById('driverSelect').addEventListener('change', updatePreview);
        document.getElementById('contractSelect').addEventListener('change', updatePreview);
        document.getElementById('amountInput').addEventListener('input', updatePreview);
        document.getElementById('dateInput').addEventListener('change', updatePreview);

        // Initial preview
        updatePreview();

        // Amount validation
        const amountInput = document.getElementById('amountInput');
        const amountValidation = document.getElementById('amountValidation');

        amountInput.addEventListener('input', function() {
            const value = parseFloat(this.value);
            if (isNaN(value)) {
                amountValidation.classList.add('d-none');
            } else if (value <= 0) {
                amountValidation.className = 'validation-message error';
                amountValidation.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Amount must be greater than zero';
                amountValidation.classList.remove('d-none');
            } else {
                amountValidation.className = 'validation-message success';
                amountValidation.innerHTML = '<i class="fas fa-check-circle me-1"></i>Valid amount';
                amountValidation.classList.remove('d-none');
            }
        });

        // File upload handling
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewReceipt = document.getElementById('previewReceipt');

        uploadArea.addEventListener('click', () => imageInput.click());

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleImageUpload(file);
            }
        });

        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                handleImageUpload(this.files[0]);
            }
        });

        function handleImageUpload(file) {
            if (!file.type.startsWith('image/')) {
                showToast('Please upload an image file', 'error');
                return;
            }
            
            if (file.size > 5 * 1024 * 1024) {
                showToast('File size must be less than 5MB', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = imagePreview.querySelector('img');
                img.src = e.target.result;
                imagePreview.style.display = 'inline-block';
                uploadArea.style.display = 'none';
                previewReceipt.textContent = file.name.substring(0, 20) + (file.name.length > 20 ? '...' : '');
            };
            reader.readAsDataURL(file);
        }

        window.removeImage = function() {
            imageInput.value = '';
            imagePreview.style.display = 'none';
            uploadArea.style.display = 'block';
            previewReceipt.textContent = 'Not uploaded';
        };

        // Form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        });

        // Toast notification
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
            toast.style.borderRadius = '16px';
            toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
            toast.innerHTML = `
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Back to Top
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });
        
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Session messages
        @if(session('success'))
        showToast('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
        showToast('{{ session('error') }}', 'error');
        @endif

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('paymentForm').submit();
            }
            if (e.key === 'Escape') {
                window.location.href = '{{ route("payments.index") }}';
            }
        });
    </script>
</body>
</html>