<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Driver | {{ config('app.name', 'Fleet Manager') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Input Mask for phone formatting -->
    <script src="https://cdn.jsdelivr.net/npm/imask@7.6.1/dist/imask.min.js"></script>
    
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #f1f5f9 100%);
            min-height: 100vh;
            color: #1e293b;
            position: relative;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.03) 0%, transparent 70%);
            pointer-events: none;
            z-index: -1;
            animation: float 20s infinite ease-in-out;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.03) 0%, transparent 70%);
            pointer-events: none;
            z-index: -1;
            animation: float 25s infinite ease-in-out reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(5%, 5%) rotate(1deg); }
            66% { transform: translate(-5%, -5%) rotate(-1deg); }
        }

        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        }

        /* Form Styles */
        .form-container {
            animation: slideInUp 0.6s ease-out forwards;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            position: relative;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #818cf8, #4f46e5);
            background-size: 200% 100%;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-header {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 2rem;
            border-bottom: 1px solid rgba(203, 213, 225, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-label i {
            color: #4f46e5;
            margin-right: 0.5rem;
            font-size: 0.875rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
            color: #1e293b;
        }

        .form-control:hover {
            border-color: #818cf8;
        }

        .form-control:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        .form-control.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .input-icon-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #4f46e5;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-icon-wrapper .form-control {
            padding-left: 2.75rem;
        }

        .input-icon-wrapper:focus-within .input-icon {
            color: #4f46e5;
            transform: translateY(-50%) scale(1.1);
        }

        /* Select Styling */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #4f46e5;
            pointer-events: none;
            font-size: 0.875rem;
        }

        select.form-control {
            cursor: pointer;
            background-image: none;
            appearance: none;
        }

        /* User Card in Select */
        .user-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #4f46e5, #818cf8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Validation Styles */
        .validation-message {
            font-size: 0.75rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            border-radius: 12px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .validation-message.error {
            color: #dc2626;
            background: #fef2f2;
            border-left: 3px solid #dc2626;
        }

        .validation-message.success {
            color: #16a34a;
            background: #f0fdf4;
            border-left: 3px solid #16a34a;
        }

        .validation-message.info {
            color: #2563eb;
            background: #eff6ff;
            border-left: 3px solid #2563eb;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
            width: 100%;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.5);
        }

        .btn-primary::before {
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

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -5px rgba(79, 70, 229, 0.6);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-secondary {
            background: white;
            color: #4f46e5;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid #4f46e5;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }

        /* License Card Preview */
        .license-preview {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 24px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 2px dashed #cbd5e1;
            transition: all 0.3s ease;
        }

        .license-preview:hover {
            border-color: #4f46e5;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        }

        .license-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .license-icon {
            width: 48px;
            height: 48px;
            background: #4f46e5;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .license-detail {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .license-detail:last-child {
            border-bottom: none;
        }

        .license-label {
            color: #64748b;
            font-size: 0.875rem;
        }

        .license-value {
            font-weight: 600;
            color: #1e293b;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            transform: translateY(-50%);
        }

        .step {
            position: relative;
            z-index: 2;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #94a3b8;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .step.active {
            background: #4f46e5;
            border-color: #4f46e5;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.2);
        }

        .step.completed {
            background: #22c55e;
            border-color: #22c55e;
            color: white;
        }

        /* Success Animation */
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-animation {
            animation: checkmark 0.5s ease-out forwards;
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background: #1e293b;
            color: white;
            text-align: center;
            padding: 0.5rem;
            border-radius: 12px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.75rem;
            pointer-events: none;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Document Upload */
        .upload-area {
            border: 3px dashed #e2e8f0;
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .upload-area:hover {
            border-color: #4f46e5;
            background: #f8fafc;
        }

        .upload-area.dragover {
            border-color: #4f46e5;
            background: #eef2ff;
            transform: scale(1.02);
        }

        .upload-area input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            width: 60px;
            height: 60px;
            background: #eef2ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            transition: all 0.3s ease;
        }

        .upload-area:hover .upload-icon {
            transform: scale(1.1);
            background: #4f46e5;
            color: white;
        }

        /* Driver Card */
        .driver-card {
            background: white;
            border-radius: 20px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .driver-card:hover {
            border-color: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.2);
        }

        .driver-card.selected {
            border-color: #4f46e5;
            background: #eef2ff;
        }

        .driver-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4f46e5, #818cf8);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-card {
                border-radius: 24px;
            }
            
            .form-header {
                padding: 1.5rem;
            }
            
            .driver-card {
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body class="antialiased">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-white/90 backdrop-blur-sm z-[9999] flex items-center justify-center transition-all duration-500 opacity-0 pointer-events-none">
        <div class="text-center">
            <div class="w-20 h-20 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
            <p class="text-gray-600 font-medium animate-pulse">Preparing driver registration...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50 border-b border-gray-200/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-users text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-xl bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                            FleetManager
                        </span>
                        <span class="text-xs text-gray-500 block">Driver Management</span>
                    </div>
                </div>

                <!-- Right Navigation -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('drivers.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors flex items-center gap-2">
                        <i class="fa-regular fa-arrow-left"></i>
                        <span class="hidden md:inline">Back to Drivers</span>
                    </a>
                    
                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl flex items-center justify-center text-white font-semibold">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-48 glass rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 transition-colors">
                                <i class="fa-regular fa-user text-indigo-600"></i>
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fa-regular fa-sign-out"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <span class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-semibold inline-flex items-center gap-2">
                <i class="fa-regular fa-user-plus"></i>
                New Driver
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mt-4">
                <span class="bg-gradient-to-r from-indigo-600 to-indigo-800 bg-clip-text text-transparent">
                    Register New Driver
                </span>
            </h1>
            <p class="text-gray-600 mt-2">Add a new driver to your fleet team</p>
        </div>

        <!-- Progress Steps -->
        <div class="progress-steps max-w-md mx-auto mb-8">
            <div class="step active">1</div>
            <div class="step">2</div>
            <div class="step">3</div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <div class="form-card">
                <div class="form-header">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center">
                            <i class="fa-regular fa-id-card text-2xl text-indigo-600"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Driver Information</h2>
                            <p class="text-sm text-gray-500">Enter the driver's personal and license details</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('drivers.store') }}" id="driverForm" enctype="multipart/form-data">
                        @csrf

                        <!-- Validation Summary -->
                        @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl">
                            <div class="flex items-start gap-3">
                                <i class="fa-regular fa-circle-exclamation text-red-500 text-xl mt-0.5"></i>
                                <div>
                                    <p class="font-medium text-red-800">Please fix the following errors:</p>
                                    <ul class="text-sm text-red-600 mt-2 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Success Message -->
                        @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-2xl">
                            <div class="flex items-center gap-3">
                                <i class="fa-regular fa-circle-check text-green-500 text-xl success-animation"></i>
                                <div>
                                    <p class="font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- User Selection -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fa-regular fa-user"></i>
                                Select User
                            </label>
                            <div class="select-wrapper">
                                <select name="user_id" class="form-control" required id="userSelect">
                                    <option value="" disabled selected>Choose a user...</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" data-email="{{ $user->email }}" data-name="{{ $user->name }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                            <div class="validation-message error">
                                <i class="fa-regular fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Selected User Preview -->
                        <div id="selectedUserPreview" class="hidden mb-6">
                            <div class="driver-card selected">
                                <div class="driver-avatar" id="userAvatar">JD</div>
                                <div>
                                    <p class="font-semibold text-gray-800" id="userName">John Doe</p>
                                    <p class="text-sm text-gray-500" id="userEmail">john@example.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Phone Number -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-phone"></i>
                                    Phone Number
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-phone input-icon"></i>
                                    <input type="text" 
                                           name="phone" 
                                           id="phone"
                                           class="form-control" 
                                           placeholder="+255 XXX XXX XXX"
                                           value="{{ old('phone') }}"
                                           required>
                                </div>
                                <div class="validation-message" id="phoneValidation"></div>
                                @error('phone')
                                <div class="validation-message error">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- License Number -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-id-card"></i>
                                    License Number
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-id-card input-icon"></i>
                                    <input type="text" 
                                           name="license_number" 
                                           id="licenseNumber"
                                           class="form-control" 
                                           placeholder="e.g., DL-1234-5678"
                                           value="{{ old('license_number') }}"
                                           required>
                                </div>
                                <div class="validation-message" id="licenseValidation"></div>
                                @error('license_number')
                                <div class="validation-message error">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- License Expiry Date -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-calendar"></i>
                                    License Expiry Date
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-calendar input-icon"></i>
                                    <input type="date" 
                                           name="license_expiry" 
                                           class="form-control" 
                                           value="{{ old('license_expiry') }}"
                                           min="{{ date('Y-m-d') }}">
                                </div>
                                @error('license_expiry')
                                <div class="validation-message error">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- License Class -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-star"></i>
                                    License Class
                                </label>
                                <div class="select-wrapper">
                                    <select name="license_class" class="form-control">
                                        <option value="">Select class</option>
                                        <option value="A" {{ old('license_class') == 'A' ? 'selected' : '' }}>Class A - Motorcycle</option>
                                        <option value="B" {{ old('license_class') == 'B' ? 'selected' : '' }}>Class B - Light Vehicle</option>
                                        <option value="C" {{ old('license_class') == 'C' ? 'selected' : '' }}>Class C - Heavy Vehicle</option>
                                        <option value="D" {{ old('license_class') == 'D' ? 'selected' : '' }}>Class D - Commercial</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Emergency Contact -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-phone-alt"></i>
                                    Emergency Contact
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-phone-alt input-icon"></i>
                                    <input type="text" 
                                           name="emergency_contact" 
                                           class="form-control" 
                                           placeholder="Emergency phone number"
                                           value="{{ old('emergency_contact') }}">
                                </div>
                            </div>

                            <!-- Blood Type -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-droplet"></i>
                                    Blood Type
                                </label>
                                <div class="select-wrapper">
                                    <select name="blood_type" class="form-control">
                                        <option value="">Select blood type</option>
                                        <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                                        <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Date of Birth -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-cake"></i>
                                    Date of Birth
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-cake input-icon"></i>
                                    <input type="date" 
                                           name="date_of_birth" 
                                           class="form-control" 
                                           value="{{ old('date_of_birth') }}"
                                           max="{{ date('Y-m-d', strtotime('-18 years')) }}">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="form-group md:col-span-2">
                                <label class="form-label">
                                    <i class="fa-regular fa-location-dot"></i>
                                    Address
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-location-dot input-icon"></i>
                                    <textarea name="address" rows="2" class="form-control" placeholder="Full address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- License Document Upload -->
                        <div class="form-group mt-6">
                            <label class="form-label">
                                <i class="fa-regular fa-file-pdf"></i>
                                License Document
                                <span class="text-xs text-gray-400 ml-2">(Optional)</span>
                            </label>
                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">
                                    <i class="fa-regular fa-cloud-upload-alt fa-2x"></i>
                                </div>
                                <p class="text-gray-600 font-medium">Click or drag license document to upload</p>
                                <p class="text-xs text-gray-400 mt-2">Supports: PDF, JPG, PNG (Max 5MB)</p>
                                <input type="file" name="license_document" accept=".pdf,.jpg,.jpeg,.png" id="documentInput">
                            </div>
                            <div id="documentPreview" class="hidden mt-4">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                    <div class="flex items-center gap-3">
                                        <i class="fa-regular fa-file-pdf text-red-500 text-2xl"></i>
                                        <div>
                                            <p class="font-medium text-gray-800" id="fileName">document.pdf</p>
                                            <p class="text-xs text-gray-500" id="fileSize">2.5 MB</p>
                                        </div>
                                    </div>
                                    <button type="button" onclick="removeDocument()" class="text-red-500 hover:text-red-600">
                                        <i class="fa-regular fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- License Preview Card -->
                        <div class="license-preview">
                            <div class="license-header">
                                <div class="license-icon">
                                    <i class="fa-regular fa-id-card"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Driver's License Preview</h3>
                                    <p class="text-xs text-gray-500">Information will appear here</p>
                                </div>
                            </div>
                            <div class="license-detail">
                                <span class="license-label">Full Name:</span>
                                <span class="license-value" id="previewName">Not selected</span>
                            </div>
                            <div class="license-detail">
                                <span class="license-label">License Number:</span>
                                <span class="license-value" id="previewLicense">Not entered</span>
                            </div>
                            <div class="license-detail">
                                <span class="license-label">Phone:</span>
                                <span class="license-value" id="previewPhone">Not entered</span>
                            </div>
                            <div class="license-detail">
                                <span class="license-label">License Class:</span>
                                <span class="license-value" id="previewClass">Not selected</span>
                            </div>
                            <div class="license-detail">
                                <span class="license-label">Expiry Date:</span>
                                <span class="license-value" id="previewExpiry">Not set</span>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-2xl">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" name="terms" class="mt-1 w-5 h-5 text-indigo-600 rounded-lg focus:ring-indigo-500" required>
                                <span class="text-sm text-gray-600">
                                    I confirm that all information provided is accurate and I have verified the driver's documents.
                                </span>
                            </label>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center gap-4 mt-8">
                            <a href="{{ route('drivers.index') }}" class="btn-secondary flex-1">
                                <i class="fa-regular fa-times"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn-primary flex-1" id="submitBtn">
                                <i class="fa-regular fa-user-plus"></i>
                                Register Driver
                                <i class="fa-regular fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Tips -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-circle-check text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Verify Documents</p>
                        <p class="text-xs text-gray-500">Ensure license is valid</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-phone text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Emergency Contact</p>
                        <p class="text-xs text-gray-500">Always provide backup</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-calendar text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Check Expiry</p>
                        <p class="text-xs text-gray-500">Monitor license dates</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-sm border-t border-gray-200/30 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} FleetManager. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Quick Tips Floating Button -->
    <div class="fixed bottom-6 left-6 z-40">
        <div class="tooltip">
            <button class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all">
                <i class="fa-regular fa-lightbulb"></i>
            </button>
            <div class="tooltip-text">Driver registration tips</div>
        </div>
    </div>

    <script>
        // Hide loading overlay
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading-overlay').classList.add('opacity-0', 'pointer-events-none');
            }, 500);
        });

        // User selection preview
        const userSelect = document.getElementById('userSelect');
        const selectedUserPreview = document.getElementById('selectedUserPreview');
        const userName = document.getElementById('userName');
        const userEmail = document.getElementById('userEmail');
        const userAvatar = document.getElementById('userAvatar');
        const previewName = document.getElementById('previewName');

        userSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            if (selected.value) {
                const name = selected.dataset.name;
                const email = selected.dataset.email;
                const initials = name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
                
                userName.textContent = name;
                userEmail.textContent = email;
                userAvatar.textContent = initials;
                selectedUserPreview.classList.remove('hidden');
                
                // Update preview
                previewName.textContent = name;
            } else {
                selectedUserPreview.classList.add('hidden');
                previewName.textContent = 'Not selected';
            }
        });

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        const phoneValidation = document.getElementById('phoneValidation');

        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            
            // Format as +255 XXX XXX XXX
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = '+255 ' + value;
                } else if (value.length <= 6) {
                    value = '+255 ' + value.slice(0, 3) + ' ' + value.slice(3);
                } else {
                    value = '+255 ' + value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6, 9);
                }
            }
            
            this.value = value;
            
            // Validation
            const digits = value.replace(/\D/g, '').length;
            if (digits < 9) {
                phoneValidation.className = 'validation-message error';
                phoneValidation.innerHTML = '<i class="fa-regular fa-circle-exclamation"></i> Phone number must have at least 9 digits';
            } else if (digits > 9) {
                phoneValidation.className = 'validation-message error';
                phoneValidation.innerHTML = '<i class="fa-regular fa-circle-exclamation"></i> Phone number cannot exceed 9 digits';
            } else {
                phoneValidation.className = 'validation-message success';
                phoneValidation.innerHTML = '<i class="fa-regular fa-circle-check"></i> Valid phone number';
            }
            
            updatePreview();
        });

        // License number formatting
        const licenseInput = document.getElementById('licenseNumber');
        const licenseValidation = document.getElementById('licenseValidation');

        licenseInput.addEventListener('input', function(e) {
            let value = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
            
            // Auto-format license number (e.g., DL-1234-5678)
            if (value.length > 2 && !value.includes('-')) {
                value = value.slice(0, 2) + '-' + value.slice(2);
            }
            if (value.length > 7 && value.indexOf('-', 3) === -1) {
                value = value.slice(0, 7) + '-' + value.slice(7);
            }
            
            this.value = value;
            
            // Validation
            if (value.length < 10) {
                licenseValidation.className = 'validation-message error';
                licenseValidation.innerHTML = '<i class="fa-regular fa-circle-exclamation"></i> License number should be at least 10 characters';
            } else {
                licenseValidation.className = 'validation-message success';
                licenseValidation.innerHTML = '<i class="fa-regular fa-circle-check"></i> Valid license format';
            }
            
            updatePreview();
        });

        // Update preview
        function updatePreview() {
            document.getElementById('previewLicense').textContent = licenseInput.value || 'Not entered';
            document.getElementById('previewPhone').textContent = phoneInput.value || 'Not entered';
            
            const licenseClass = document.querySelector('select[name="license_class"]');
            document.getElementById('previewClass').textContent = licenseClass.options[licenseClass.selectedIndex]?.text.split(' - ')[0] || 'Not selected';
            
            const expiryDate = document.querySelector('input[name="license_expiry"]');
            document.getElementById('previewExpiry').textContent = expiryDate.value || 'Not set';
        }

        document.querySelector('select[name="license_class"]').addEventListener('change', updatePreview);
        document.querySelector('input[name="license_expiry"]').addEventListener('change', updatePreview);

        // Document upload
        const uploadArea = document.getElementById('uploadArea');
        const documentInput = document.getElementById('documentInput');
        const documentPreview = document.getElementById('documentPreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');

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
            handleDocumentUpload(file);
        });

        documentInput.addEventListener('change', function() {
            handleDocumentUpload(this.files[0]);
        });

        function handleDocumentUpload(file) {
            if (file) {
                const validTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload a PDF or image file');
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    return;
                }
                
                fileName.textContent = file.name;
                fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                documentPreview.classList.remove('hidden');
                uploadArea.classList.add('hidden');
            }
        }

        window.removeDocument = function() {
            documentInput.value = '';
            documentPreview.classList.add('hidden');
            uploadArea.classList.remove('hidden');
        };

        // Form submission
        document.getElementById('driverForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-regular fa-spinner fa-spin"></i> Registering Driver...';
        });

        // Age validation
        const dobInput = document.querySelector('input[name="date_of_birth"]');
        dobInput.addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();
            const age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            
            if (age < 18 || (age === 18 && monthDiff < 0)) {
                alert('Driver must be at least 18 years old');
                this.value = '';
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('driverForm').submit();
            }
            // Escape to go back
            if (e.key === 'Escape') {
                window.location.href = '{{ route("drivers.index") }}';
            }
        });

        // Auto-save draft to localStorage
        function saveDraft() {
            const formData = {
                user_id: userSelect.value,
                phone: phoneInput.value,
                license_number: licenseInput.value,
                license_expiry: document.querySelector('input[name="license_expiry"]').value,
                license_class: document.querySelector('select[name="license_class"]').value,
                emergency_contact: document.querySelector('input[name="emergency_contact"]').value,
                blood_type: document.querySelector('select[name="blood_type"]').value,
                date_of_birth: document.querySelector('input[name="date_of_birth"]').value,
                address: document.querySelector('textarea[name="address"]').value
            };
            
            localStorage.setItem('driverDraft', JSON.stringify(formData));
        }

        // Load draft from localStorage
        function loadDraft() {
            const draft = localStorage.getItem('driverDraft');
            if (draft) {
                const formData = JSON.parse(draft);
                if (confirm('You have an unsaved draft. Would you like to restore it?')) {
                    userSelect.value = formData.user_id || '';
                    if (userSelect.value) {
                        userSelect.dispatchEvent(new Event('change'));
                    }
                    phoneInput.value = formData.phone || '';
                    licenseInput.value = formData.license_number || '';
                    document.querySelector('input[name="license_expiry"]').value = formData.license_expiry || '';
                    document.querySelector('select[name="license_class"]').value = formData.license_class || '';
                    document.querySelector('input[name="emergency_contact"]').value = formData.emergency_contact || '';
                    document.querySelector('select[name="blood_type"]').value = formData.blood_type || '';
                    document.querySelector('input[name="date_of_birth"]').value = formData.date_of_birth || '';
                    document.querySelector('textarea[name="address"]').value = formData.address || '';
                    
                    updatePreview();
                }
            }
        }

        // Auto-save every 30 seconds
        setInterval(saveDraft, 30000);

        // Clear draft on successful submission
        @if(session('success'))
        localStorage.removeItem('driverDraft');
        @endif

        // Load draft on page load
        window.addEventListener('load', loadDraft);
    </script>

    <!-- Alpine.js for dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>