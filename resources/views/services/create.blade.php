<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Service | {{ config('app.name', 'Fleet Manager') }}</title>
    
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
            --primary-50: #eff6ff;
            --primary-100: #dbeafe;
            --primary-200: #bfdbfe;
            --primary-300: #93c5fd;
            --primary-400: #60a5fa;
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --primary-700: #1d4ed8;
            --primary-800: #1e40af;
            --primary-900: #1e3a8a;
            
            --success-50: #f0fdf4;
            --success-100: #dcfce7;
            --success-500: #22c55e;
            --success-600: #16a34a;
            --success-700: #15803d;
            
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
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            min-height: 100vh;
            color: var(--gray-800);
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
            background: radial-gradient(circle, rgba(59, 130, 246, 0.03) 0%, transparent 70%);
            animation: float 20s infinite ease-in-out;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.03) 0%, transparent 70%);
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
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-select-modern {
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            padding: 0.75rem 2rem 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%233b82f6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 14px;
        }

        .form-select-modern:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
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

        /* Cost Input */
        .cost-input-group {
            position: relative;
        }

        .cost-input-group .prefix {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-600);
            font-weight: 600;
            z-index: 2;
        }

        .cost-input-group .form-control-modern {
            padding-left: 3.5rem;
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
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
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

        .validation-message.warning {
            background: var(--warning-50);
            color: var(--warning-700);
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
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
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
                <div>
                    <h1 class="display-5 fw-bold mb-2" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Add Service Record
                    </h1>
                    <p class="text-muted mb-0">Create a new maintenance or service record for your fleet</p>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('services.index') }}" class="btn btn-outline-modern">
                        <i class="fas fa-list me-2"></i>All Services
                    </a>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="modern-card">
                <div class="page-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-20 rounded-3 p-3">
                            <i class="fas fa-screwdriver-wrench fa-2x text-white"></i>
                        </div>
                        <div>
                            <h2 class="h4 fw-bold text-white mb-1">Service Information</h2>
                            <p class="text-white text-opacity-90 mb-0 small">Fill in the details to record a new service/maintenance</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 p-lg-5">
                    <form method="POST" action="{{ route('services.store') }}" id="serviceForm">
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
                            <!-- Motorbike Selection -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-motorcycle me-1 text-primary"></i>Motorbike
                                    <span class="required">*</span>
                                </label>
                                <select name="motorbike_id" class="form-select-modern w-100" required id="motorbikeSelect">
                                    <option value="" disabled selected>Select a motorbike...</option>
                                    @foreach($motorbikes as $bike)
                                    <option value="{{ $bike->id }}" data-model="{{ $bike->model }}" data-plate="{{ $bike->plate_number }}" {{ old('motorbike_id') == $bike->id ? 'selected' : '' }}>
                                        {{ $bike->model }} ({{ $bike->plate_number }})
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
                                    <option value="{{ $contract->id }}" data-plate="{{ $contract->motorbike->plate_number ?? '' }}" {{ old('contract_id') == $contract->id ? 'selected' : '' }}>
                                        Contract #{{ str_pad($contract->id, 4, '0', STR_PAD_LEFT) }} - {{ $contract->motorbike->plate_number ?? 'No Plate' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label class="form-label">
                                    <i class="fas fa-align-left me-1 text-primary"></i>Description
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-pencil-alt"></i>
                                    <input type="text" 
                                           name="description" 
                                           class="form-control-modern w-100" 
                                           placeholder="e.g., Oil change, Brake repair, Engine tune-up, etc."
                                           value="{{ old('description') }}"
                                           required
                                           id="descriptionInput">
                                </div>
                                <div id="descriptionValidation" class="validation-message d-none"></div>
                            </div>

                            <!-- Cost -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-tag me-1 text-primary"></i>Cost (Tsh)
                                    <span class="required">*</span>
                                </label>
                                <div class="cost-input-group">
                                    <span class="prefix">Tsh</span>
                                    <input type="number" 
                                           name="cost" 
                                           class="form-control-modern w-100" 
                                           placeholder="0.00"
                                           value="{{ old('cost') }}"
                                           step="0.01"
                                           min="0"
                                           required
                                           id="costInput">
                                </div>
                                <div id="costValidation" class="validation-message d-none"></div>
                            </div>

                            <!-- Service Date -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1 text-primary"></i>Service Date
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar-alt"></i>
                                    <input type="date" 
                                           name="service_date" 
                                           class="form-control-modern w-100" 
                                           value="{{ old('service_date', date('Y-m-d')) }}"
                                           required
                                           id="dateInput">
                                </div>
                            </div>

                            <!-- Preview Card -->
                            <div class="col-12">
                                <div class="preview-card">
                                    <h6 class="fw-bold mb-3">
                                        <i class="fas fa-eye me-2 text-primary"></i>Service Preview
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Motorbike</div>
                                                <div class="preview-value" id="previewMotorbike">Not selected</div>
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
                                                <div class="preview-label">Description</div>
                                                <div class="preview-value" id="previewDescription">Not entered</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Cost</div>
                                                <div class="preview-value" id="previewCost">Tsh 0</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview-item">
                                                <div class="preview-label">Service Date</div>
                                                <div class="preview-value" id="previewDate">Not selected</div>
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
                                    <a href="{{ route('services.index') }}" class="btn btn-outline-modern flex-grow-1">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-gradient-primary flex-grow-1" id="submitBtn">
                                        <i class="fas fa-screwdriver-wrench me-2"></i>Add Service Record
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
    
    <script>
        // Preview update function
        function updatePreview() {
            // Motorbike preview
            const motorbikeSelect = document.getElementById('motorbikeSelect');
            const selectedBike = motorbikeSelect.options[motorbikeSelect.selectedIndex];
            document.getElementById('previewMotorbike').textContent = 
                selectedBike && selectedBike.value ? selectedBike.text : 'Not selected';

            // Contract preview
            const contractSelect = document.getElementById('contractSelect');
            const selectedContract = contractSelect.options[contractSelect.selectedIndex];
            document.getElementById('previewContract').textContent = 
                selectedContract && selectedContract.value ? selectedContract.text : 'Not selected';

            // Description preview
            const description = document.getElementById('descriptionInput').value;
            document.getElementById('previewDescription').textContent = 
                description || 'Not entered';

            // Cost preview
            const cost = document.getElementById('costInput').value;
            document.getElementById('previewCost').textContent = 
                cost ? 'Tsh ' + parseFloat(cost).toLocaleString() : 'Tsh 0';

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

        // Add event listeners for preview updates
        document.getElementById('motorbikeSelect').addEventListener('change', updatePreview);
        document.getElementById('contractSelect').addEventListener('change', updatePreview);
        document.getElementById('descriptionInput').addEventListener('input', updatePreview);
        document.getElementById('costInput').addEventListener('input', updatePreview);
        document.getElementById('dateInput').addEventListener('change', updatePreview);

        // Initial preview update
        updatePreview();

        // Description validation
        const descriptionInput = document.getElementById('descriptionInput');
        const descriptionValidation = document.getElementById('descriptionValidation');

        descriptionInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value.length === 0) {
                descriptionValidation.classList.add('d-none');
            } else if (value.length < 5) {
                descriptionValidation.className = 'validation-message error';
                descriptionValidation.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Description must be at least 5 characters';
                descriptionValidation.classList.remove('d-none');
            } else {
                descriptionValidation.className = 'validation-message success';
                descriptionValidation.innerHTML = '<i class="fas fa-check-circle me-1"></i>Description looks good';
                descriptionValidation.classList.remove('d-none');
            }
        });

        // Cost validation
        const costInput = document.getElementById('costInput');
        const costValidation = document.getElementById('costValidation');

        costInput.addEventListener('input', function() {
            const value = parseFloat(this.value);
            if (isNaN(value)) {
                costValidation.classList.add('d-none');
            } else if (value <= 0) {
                costValidation.className = 'validation-message error';
                costValidation.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Cost must be greater than zero';
                costValidation.classList.remove('d-none');
            } else {
                costValidation.className = 'validation-message success';
                costValidation.innerHTML = '<i class="fas fa-check-circle me-1"></i>Valid amount';
                costValidation.classList.remove('d-none');
            }
        });

        // Form submission
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding Service Record...';
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
                document.getElementById('serviceForm').submit();
            }
            if (e.key === 'Escape') {
                window.location.href = '{{ route("services.index") }}';
            }
        });

        // Auto-save draft to localStorage
        function saveDraft() {
            const formData = {
                motorbike_id: document.getElementById('motorbikeSelect').value,
                contract_id: document.getElementById('contractSelect').value,
                description: document.getElementById('descriptionInput').value,
                cost: document.getElementById('costInput').value,
                service_date: document.getElementById('dateInput').value
            };
            
            localStorage.setItem('serviceDraft', JSON.stringify(formData));
        }

        // Load draft from localStorage
        function loadDraft() {
            const draft = localStorage.getItem('serviceDraft');
            if (draft) {
                const formData = JSON.parse(draft);
                if (formData.motorbike_id || formData.contract_id || formData.description || formData.cost || formData.service_date) {
                    if (confirm('You have an unsaved draft. Would you like to restore it?')) {
                        document.getElementById('motorbikeSelect').value = formData.motorbike_id || '';
                        document.getElementById('contractSelect').value = formData.contract_id || '';
                        document.getElementById('descriptionInput').value = formData.description || '';
                        document.getElementById('costInput').value = formData.cost || '';
                        document.getElementById('dateInput').value = formData.service_date || '';
                        
                        updatePreview();
                    }
                }
            }
        }

        // Auto-save every 30 seconds
        setInterval(saveDraft, 30000);

        // Load draft on page load
        window.addEventListener('load', loadDraft);

        // Clear draft on successful submission
        @if(session('success'))
        localStorage.removeItem('serviceDraft');
        @endif
    </script>
</body>
</html>