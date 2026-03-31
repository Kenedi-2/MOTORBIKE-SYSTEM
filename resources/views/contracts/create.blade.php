<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Contract | {{ config('app.name', 'Fleet Manager') }}</title>
    
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
            --primary-50: #eef2ff;
            --primary-100: #e0e7ff;
            --primary-200: #c7d2fe;
            --primary-300: #a5b4fc;
            --primary-400: #818cf8;
            --primary-500: #6366f1;
            --primary-600: #4f46e5;
            --primary-700: #4338ca;
            --primary-800: #3730a3;
            --primary-900: #312e81;
            
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
            background: radial-gradient(circle, rgba(79, 70, 229, 0.03) 0%, transparent 70%);
            animation: float 20s infinite ease-in-out;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-select-modern {
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            padding: 0.75rem 2rem 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234f46e5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
        }

        .form-select-modern:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
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

        /* Amount Preview Card */
        .amount-preview-card {
            background: linear-gradient(135deg, var(--gray-50), white);
            border-radius: 20px;
            padding: 1.5rem;
            border: 2px dashed var(--gray-200);
            transition: all 0.3s ease;
        }

        .amount-preview-card:hover {
            border-color: var(--primary-500);
            background: linear-gradient(135deg, var(--primary-50), white);
        }

        .preview-item {
            padding: 0.75rem;
            background: white;
            border-radius: 12px;
        }

        .preview-label {
            font-size: 0.7rem;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .preview-value {
            font-weight: 700;
            color: var(--gray-800);
            font-size: 1.1rem;
        }

        .preview-value small {
            font-size: 0.75rem;
            font-weight: 400;
            color: var(--gray-500);
        }

        /* Remaining Amount Alert */
        .remaining-alert {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 16px;
            padding: 1rem;
            margin-top: 1rem;
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
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
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
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
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

    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg bg-white bg-opacity-95 backdrop-blur-sm sticky-top shadow-sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100 py-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-gradient-primary rounded-3 p-2" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                        <i class="fas fa-file-contract text-white"></i>
                    </div>
                    <div>
                        <span class="fw-bold fs-5">FleetManager</span>
                        <span class="badge bg-secondary ms-2">Contract Creation</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('contracts.index') }}" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-light rounded-circle p-2" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4 py-lg-5">
        <div class="container px-4 px-lg-5">
            
            <!-- Header -->
            <div class="text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                    <i class="fas fa-file-signature me-1"></i>New Contract
                </span>
                <h1 class="display-5 fw-bold mb-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Create New Contract
                </h1>
                <p class="text-muted">Fill in the details below to create a new contract agreement</p>
            </div>

            <!-- Main Form Card -->
            <div class="modern-card">
                <div class="page-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white bg-opacity-20 rounded-3 p-3">
                            <i class="fas fa-file-lines fa-2x text-white"></i>
                        </div>
                        <div>
                            <h2 class="h4 fw-bold text-white mb-1">Contract Information</h2>
                            <p class="text-white text-opacity-90 mb-0 small">Please provide all required details for the contract</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 p-lg-5">
                    <form method="POST" action="{{ route('contracts.store') }}" id="contractForm">
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

                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="alert alert-success border-0 rounded-4 mb-4">
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle fa-lg mt-1"></i>
                                <div>
                                    <strong class="d-block mb-1">Success!</strong>
                                    <p class="mb-0 small">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row g-4">
                            <!-- Motorbike Selection -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-motorcycle me-1 text-primary"></i>Select Motorbike
                                    <span class="required">*</span>
                                </label>
                                <select name="motorbike_id" class="form-select-modern w-100" required id="motorbikeSelect">
                                    <option value="" disabled selected>Choose a motorbike...</option>
                                    @foreach($motorbikes as $bike)
                                    <option value="{{ $bike->id }}" {{ old('motorbike_id') == $bike->id ? 'selected' : '' }}>
                                        {{ $bike->plate_number }} - {{ $bike->model }} ({{ $bike->year ?? 'N/A' }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Driver Selection -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-user me-1 text-primary"></i>Select Driver
                                    <span class="required">*</span>
                                </label>
                                <select name="driver_id" class="form-select-modern w-100" required id="driverSelect">
                                    <option value="" disabled selected>Choose a driver...</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->user->name }} ({{ $driver->license_number ?? 'No license' }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sponsor Selection -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-building me-1 text-primary"></i>Select Sponsor
                                    <span class="required">*</span>
                                </label>
                                <select name="sponsor_id" class="form-select-modern w-100" required id="sponsorSelect">
                                    <option value="" disabled selected>Choose a sponsor...</option>
                                    @foreach($sponsors as $sponsor)
                                    <option value="{{ $sponsor->id }}" {{ old('sponsor_id') == $sponsor->id ? 'selected' : '' }}>
                                        {{ $sponsor->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Contract Status -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-circle-info me-1 text-primary"></i>Contract Status
                                    <span class="required">*</span>
                                </label>
                                <select name="status" class="form-select-modern w-100" required>
                                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt me-1 text-primary"></i>Start Date
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar"></i>
                                    <input type="date" 
                                           name="start_date" 
                                           class="form-control-modern w-100" 
                                           value="{{ old('start_date', date('Y-m-d')) }}"
                                           required
                                           id="startDate">
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar-check me-1 text-primary"></i>End Date
                                    <span class="text-muted fw-normal">(Optional)</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-calendar-check"></i>
                                    <input type="date" 
                                           name="end_date" 
                                           class="form-control-modern w-100" 
                                           value="{{ old('end_date') }}"
                                           id="endDate">
                                </div>
                            </div>

                            <!-- Daily Amount -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-coins me-1 text-primary"></i>Daily Amount (Tsh)
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-tag"></i>
                                    <input type="number" 
                                           name="daily_amount" 
                                           class="form-control-modern w-100" 
                                           placeholder="Enter daily rate"
                                           value="{{ old('daily_amount') }}"
                                           min="0"
                                           step="0.01"
                                           id="dailyAmount"
                                           required>
                                </div>
                                <small class="text-muted">Amount per day for the contract</small>
                            </div>

                            <!-- Total Amount -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-sack-dollar me-1 text-primary"></i>Total Amount (Tsh)
                                    <span class="required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-money-bill"></i>
                                    <input type="number" 
                                           name="total_amount" 
                                           class="form-control-modern w-100" 
                                           placeholder="Enter total amount"
                                           value="{{ old('total_amount') }}"
                                           min="0"
                                           step="0.01"
                                           id="totalAmount"
                                           required>
                                </div>
                            </div>

                            <!-- Amount Paid (Initial Payment) -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-hand-holding-usd me-1 text-primary"></i>Amount Paid
                                </label>
                                <div class="input-group-modern">
                                    <i class="fas fa-check-circle"></i>
                                    <input type="number" 
                                           name="amount_paid" 
                                           class="form-control-modern w-100" 
                                           placeholder="Initial payment received"
                                           value="{{ old('amount_paid', 0) }}"
                                           min="0"
                                           step="0.01"
                                           id="amountPaid">
                                </div>
                                <small class="text-muted">Amount already paid (if any)</small>
                            </div>

                            <!-- Remaining Amount Display -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-chart-line me-1 text-primary"></i>Remaining Amount
                                </label>
                                <div class="remaining-alert" id="remainingAlert">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fas fa-hourglass-half fa-lg text-warning"></i>
                                            <span class="fw-semibold ms-2">Balance to Pay:</span>
                                        </div>
                                        <div>
                                            <span class="fs-4 fw-bold text-warning" id="remainingAmount">Tsh 0</span>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar bg-warning" id="paymentProgress" style="width: 0%"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block" id="paymentPercentage">0% paid</small>
                                </div>
                            </div>
                        </div>

                        <!-- Amount Preview Card -->
                        <div class="amount-preview-card mt-4">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-chart-simple me-2 text-primary"></i>Financial Summary
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="preview-item">
                                        <div class="preview-label">Daily Rate</div>
                                        <div class="preview-value" id="dailyRatePreview">Tsh 0</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="preview-item">
                                        <div class="preview-label">Total Contract Value</div>
                                        <div class="preview-value" id="totalPreview">Tsh 0</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="preview-item">
                                        <div class="preview-label">Amount Paid</div>
                                        <div class="preview-value" id="paidPreview">Tsh 0</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="preview-item">
                                        <div class="preview-label">Remaining Balance</div>
                                        <div class="preview-value text-warning" id="remainingPreview">Tsh 0</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="preview-item">
                                        <div class="preview-label">Contract Duration</div>
                                        <div class="preview-value" id="durationPreview">Not calculated</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mt-4 p-3 bg-light rounded-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="termsCheckbox" name="terms" required>
                                <label class="form-check-label small" for="termsCheckbox">
                                    I confirm that all information provided is accurate and I agree to the 
                                    <a href="#" class="text-primary">terms and conditions</a> of this contract agreement.
                                </label>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('contracts.index') }}" class="btn btn-outline-modern flex-grow-1">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-gradient-primary flex-grow-1" id="submitBtn">
                                <i class="fas fa-file-signature me-2"></i>Create Contract
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="bg-white rounded-4 p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-circle-info text-info fa-lg"></i>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0">Need Help?</p>
                                <small class="text-muted">Check our documentation</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded-4 p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-shield-alt text-success fa-lg"></i>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0">Secure</p>
                                <small class="text-muted">All data is encrypted</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-white rounded-4 p-3 shadow-sm">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-purple bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-headset text-purple fa-lg"></i>
                            </div>
                            <div>
                                <p class="fw-semibold mb-0">24/7 Support</p>
                                <small class="text-muted">We're here to help</small>
                            </div>
                        </div>
                    </div>
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
        // Calculate remaining amount and all previews
        function calculateRemaining() {
            const total = parseFloat(document.getElementById('totalAmount').value) || 0;
            const paid = parseFloat(document.getElementById('amountPaid').value) || 0;
            const daily = parseFloat(document.getElementById('dailyAmount').value) || 0;
            
            // Calculate remaining
            const remaining = Math.max(total - paid, 0);
            const paymentPercentage = total > 0 ? (paid / total) * 100 : 0;
            
            // Update remaining amount display
            document.getElementById('remainingAmount').innerHTML = `Tsh ${remaining.toLocaleString()}`;
            document.getElementById('paymentProgress').style.width = `${paymentPercentage}%`;
            document.getElementById('paymentPercentage').innerHTML = `${paymentPercentage.toFixed(1)}% paid`;
            
            // Update previews
            document.getElementById('dailyRatePreview').innerHTML = `Tsh ${daily.toLocaleString()}`;
            document.getElementById('totalPreview').innerHTML = `Tsh ${total.toLocaleString()}`;
            document.getElementById('paidPreview').innerHTML = `Tsh ${paid.toLocaleString()}`;
            document.getElementById('remainingPreview').innerHTML = `Tsh ${remaining.toLocaleString()}`;
            
            // Change alert color based on remaining amount
            const remainingAlert = document.getElementById('remainingAlert');
            if (remaining === 0) {
                remainingAlert.style.background = 'linear-gradient(135deg, #dcfce7, #bbf7d0)';
                document.getElementById('remainingAmount').classList.add('text-success');
                document.getElementById('remainingAmount').classList.remove('text-warning');
                document.getElementById('paymentProgress').classList.add('bg-success');
                document.getElementById('paymentProgress').classList.remove('bg-warning');
            } else {
                remainingAlert.style.background = 'linear-gradient(135deg, #fef3c7, #fde68a)';
                document.getElementById('remainingAmount').classList.add('text-warning');
                document.getElementById('remainingAmount').classList.remove('text-success');
                document.getElementById('paymentProgress').classList.add('bg-warning');
                document.getElementById('paymentProgress').classList.remove('bg-success');
            }
            
            // Calculate duration
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays > 0) {
                    document.getElementById('durationPreview').innerHTML = `${diffDays} days (${(diffDays * daily).toLocaleString()} total)`;
                } else {
                    document.getElementById('durationPreview').innerHTML = 'Invalid date range';
                }
            } else if (startDate) {
                document.getElementById('durationPreview').innerHTML = 'Select end date to calculate duration';
            } else {
                document.getElementById('durationPreview').innerHTML = 'Select start and end dates';
            }
        }
        
        // Add event listeners
        document.getElementById('totalAmount').addEventListener('input', calculateRemaining);
        document.getElementById('amountPaid').addEventListener('input', calculateRemaining);
        document.getElementById('dailyAmount').addEventListener('input', calculateRemaining);
        document.getElementById('startDate').addEventListener('change', calculateRemaining);
        document.getElementById('endDate').addEventListener('change', calculateRemaining);
        
        // Initial calculation
        calculateRemaining();
        
        // Form submission
        document.getElementById('contractForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Contract...';
        });
        
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
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('contractForm').submit();
            }
            if (e.key === 'Escape') {
                window.location.href = '{{ route("contracts.index") }}';
            }
        });
        
        // Auto-save draft
        function saveDraft() {
            const formData = {
                motorbike_id: document.querySelector('select[name="motorbike_id"]').value,
                driver_id: document.querySelector('select[name="driver_id"]').value,
                sponsor_id: document.querySelector('select[name="sponsor_id"]').value,
                status: document.querySelector('select[name="status"]').value,
                start_date: document.getElementById('startDate').value,
                end_date: document.getElementById('endDate').value,
                daily_amount: document.getElementById('dailyAmount').value,
                total_amount: document.getElementById('totalAmount').value,
                amount_paid: document.getElementById('amountPaid').value
            };
            localStorage.setItem('contractDraft', JSON.stringify(formData));
        }
        
        function loadDraft() {
            const draft = localStorage.getItem('contractDraft');
            if (draft) {
                const formData = JSON.parse(draft);
                if (formData.motorbike_id || formData.driver_id || formData.sponsor_id || formData.total_amount) {
                    if (confirm('You have an unsaved draft. Would you like to restore it?')) {
                        document.querySelector('select[name="motorbike_id"]').value = formData.motorbike_id || '';
                        document.querySelector('select[name="driver_id"]').value = formData.driver_id || '';
                        document.querySelector('select[name="sponsor_id"]').value = formData.sponsor_id || '';
                        document.querySelector('select[name="status"]').value = formData.status || 'active';
                        document.getElementById('startDate').value = formData.start_date || '';
                        document.getElementById('endDate').value = formData.end_date || '';
                        document.getElementById('dailyAmount').value = formData.daily_amount || '';
                        document.getElementById('totalAmount').value = formData.total_amount || '';
                        document.getElementById('amountPaid').value = formData.amount_paid || 0;
                        calculateRemaining();
                    }
                }
            }
        }
        
        setInterval(saveDraft, 30000);
        window.addEventListener('load', loadDraft);
        
        @if(session('success'))
        localStorage.removeItem('contractDraft');
        @endif
    </script>
</body>
</html>