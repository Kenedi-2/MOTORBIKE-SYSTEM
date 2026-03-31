<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Motorbike | {{ config('app.name', 'Fleet Manager') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Input Mask for plate number formatting -->
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

        /* Character Count */
        .char-count {
            position: absolute;
            right: 1rem;
            bottom: 0.5rem;
            font-size: 0.7rem;
            color: #94a3b8;
            background: white;
            padding: 0.2rem 0.5rem;
            border-radius: 30px;
            border: 1px solid #e2e8f0;
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

        /* Preview Card */
        .preview-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 24px;
            padding: 1.5rem;
            border: 2px dashed #cbd5e1;
            transition: all 0.3s ease;
        }

        .preview-card:hover {
            border-color: #4f46e5;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        }

        .preview-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .preview-item:last-child {
            border-bottom: none;
        }

        .preview-label {
            color: #64748b;
            font-size: 0.875rem;
        }

        .preview-value {
            font-weight: 600;
            color: #1e293b;
        }

        /* Image Upload Area */
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

        /* Responsive */
        @media (max-width: 768px) {
            .form-card {
                border-radius: 24px;
            }
            
            .form-header {
                padding: 1.5rem;
            }
            
            .preview-card {
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body class="antialiased">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-white/90 backdrop-blur-sm z-[9999] flex items-center justify-center transition-all duration-500 opacity-0 pointer-events-none">
        <div class="text-center">
            <div class="w-20 h-20 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin mb-4"></div>
            <p class="text-gray-600 font-medium animate-pulse">Preparing form...</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50 border-b border-gray-200/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-motorcycle text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="font-bold text-xl bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                            FleetManager
                        </span>
                        <span class="text-xs text-gray-500 block">Add New Motorbike</span>
                    </div>
                </div>

                <!-- Right Navigation -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('motorbikes.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors flex items-center gap-2">
                        <i class="fa-regular fa-arrow-left"></i>
                        <span class="hidden md:inline">Back to Fleet</span>
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
                <i class="fa-regular fa-plus-circle"></i>
                New Vehicle
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mt-4">
                <span class="bg-gradient-to-r from-indigo-600 to-indigo-800 bg-clip-text text-transparent">
                    Add New Motorbike
                </span>
            </h1>
            <p class="text-gray-600 mt-2">Register a new motorbike to your fleet</p>
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
                            <i class="fa-regular fa-motorcycle text-2xl text-indigo-600"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Motorbike Information</h2>
                            <p class="text-sm text-gray-500">Enter the details of the new motorbike</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('motorbikes.store') }}" id="motorbikeForm" enctype="multipart/form-data">
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Plate Number -->
                            <div class="form-group md:col-span-2">
                                <label class="form-label">
                                    <i class="fa-regular fa-plate"></i>
                                    Plate Number
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-tag input-icon"></i>
                                    <input type="text" 
                                           name="plate_number" 
                                           id="plate_number"
                                           class="form-control" 
                                           placeholder="e.g., AB-123-CD"
                                           value="{{ old('plate_number') }}"
                                           maxlength="10"
                                           required>
                                    <span class="char-count" id="plateCount">0/10</span>
                                </div>
                                <div class="validation-message" id="plateValidation"></div>
                                @error('plate_number')
                                <div class="validation-message error">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Model -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-motorcycle"></i>
                                    Model
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-cube input-icon"></i>
                                    <input type="text" 
                                           name="model" 
                                           class="form-control" 
                                           placeholder="e.g., Yamaha MT-15"
                                           value="{{ old('model') }}"
                                           required>
                                </div>
                                @error('model')
                                <div class="validation-message error">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Engine Number -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-engine"></i>
                                    Engine Number
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-gear input-icon"></i>
                                    <input type="text" 
                                           name="engine_number" 
                                           class="form-control" 
                                           placeholder="e.g., ENG-123456"
                                           value="{{ old('engine_number') }}"
                                           required>
                                </div>
                                @error('engine_number')
                                <div class="validation-message error">
                                    <i class="fa-regular fa-circle-exclamation"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Year -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-calendar"></i>
                                    Year
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-calendar input-icon"></i>
                                    <select name="year" class="form-control">
                                        <option value="">Select year</option>
                                        @for($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Color -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-palette"></i>
                                    Color
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-paint-brush input-icon"></i>
                                    <input type="text" 
                                           name="color" 
                                           class="form-control" 
                                           placeholder="e.g., Red, Blue"
                                           value="{{ old('color') }}">
                                </div>
                            </div>

                            <!-- Fuel Type -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-gas-pump"></i>
                                    Fuel Type
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-droplet input-icon"></i>
                                    <select name="fuel_type" class="form-control">
                                        <option value="">Select fuel type</option>
                                        <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Mileage -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-gauge-high"></i>
                                    Initial Mileage (km)
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-road input-icon"></i>
                                    <input type="number" 
                                           name="mileage" 
                                           class="form-control" 
                                           placeholder="0"
                                           value="{{ old('mileage', 0) }}"
                                           min="0">
                                </div>
                            </div>

                            <!-- Purchase Date -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-calendar-check"></i>
                                    Purchase Date
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-calendar-check input-icon"></i>
                                    <input type="date" 
                                           name="purchase_date" 
                                           class="form-control" 
                                           value="{{ old('purchase_date') }}">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fa-regular fa-circle"></i>
                                    Status
                                </label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-flag input-icon"></i>
                                    <select name="status" class="form-control" required>
                                        <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group mt-6">
                            <label class="form-label">
                                <i class="fa-regular fa-image"></i>
                                Vehicle Image
                                <span class="text-xs text-gray-400 ml-2">(Optional)</span>
                            </label>
                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">
                                    <i class="fa-regular fa-cloud-upload-alt fa-2x"></i>
                                </div>
                                <p class="text-gray-600 font-medium">Click or drag image to upload</p>
                                <p class="text-xs text-gray-400 mt-2">Supports: JPG, PNG, GIF (Max 5MB)</p>
                                <input type="file" name="image" accept="image/*" id="imageInput">
                            </div>
                            <div id="imagePreview" class="hidden mt-4 relative">
                                <img src="#" alt="Preview" class="w-full h-48 object-cover rounded-2xl">
                                <button type="button" onclick="removeImage()" class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors">
                                    <i class="fa-regular fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="form-group mt-6">
                            <label class="form-label">
                                <i class="fa-regular fa-note"></i>
                                Notes
                                <span class="text-xs text-gray-400 ml-2">(Optional)</span>
                            </label>
                            <textarea name="notes" rows="3" class="form-control" placeholder="Any additional information about the motorbike...">{{ old('notes') }}</textarea>
                        </div>

                        <!-- Preview Card -->
                        <div class="preview-card mt-6">
                            <h3 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                                <i class="fa-regular fa-eye"></i>
                                Preview
                            </h3>
                            <div class="preview-item">
                                <span class="preview-label">Plate Number:</span>
                                <span class="preview-value" id="previewPlate">Not set</span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-label">Model:</span>
                                <span class="preview-value" id="previewModel">Not set</span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-label">Engine Number:</span>
                                <span class="preview-value" id="previewEngine">Not set</span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-label">Status:</span>
                                <span class="preview-value" id="previewStatus">Available</span>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-2xl">
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input type="checkbox" name="terms" class="mt-1 w-5 h-5 text-indigo-600 rounded-lg focus:ring-indigo-500" required>
                                <span class="text-sm text-gray-600">
                                    I confirm that all information provided is accurate and I have the authority to register this vehicle.
                                </span>
                            </label>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center gap-4 mt-8">
                            <a href="{{ route('motorbikes.index') }}" class="btn-secondary flex-1">
                                <i class="fa-regular fa-times"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn-primary flex-1" id="submitBtn">
                                <i class="fa-regular fa-motorcycle"></i>
                                Add Motorbike
                                <i class="fa-regular fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-circle-question text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Need Help?</p>
                        <p class="text-xs text-gray-500">Check our documentation</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-bolt text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Quick Tips</p>
                        <p class="text-xs text-gray-500">Plate format: AB-123-CD</p>
                    </div>
                </div>
            </div>
            <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-headset text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Support</p>
                        <p class="text-xs text-gray-500">24/7 customer service</p>
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

    <!-- Quick Tips Tooltip -->
    <div class="fixed bottom-6 left-6 z-40">
        <div class="tooltip">
            <button class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all">
                <i class="fa-regular fa-lightbulb"></i>
            </button>
            <div class="tooltip-text">Quick tips available</div>
        </div>
    </div>

    <script>
        // Hide loading overlay
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading-overlay').classList.add('opacity-0', 'pointer-events-none');
            }, 500);
        });

        // Plate number formatting and validation
        const plateInput = document.getElementById('plate_number');
        const plateCount = document.getElementById('plateCount');
        const plateValidation = document.getElementById('plateValidation');

        plateInput.addEventListener('input', function(e) {
            let value = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
            
            // Auto-format plate number (e.g., AB-123-CD)
            if (value.length > 2 && !value.includes('-')) {
                value = value.slice(0, 2) + '-' + value.slice(2);
            }
            if (value.length > 6 && value.indexOf('-', 3) === -1) {
                value = value.slice(0, 6) + '-' + value.slice(6);
            }
            
            this.value = value;
            plateCount.textContent = `${value.length}/10`;
            
            // Validation
            if (value.length < 8) {
                plateValidation.className = 'validation-message error';
                plateValidation.innerHTML = '<i class="fa-regular fa-circle-exclamation"></i> Plate number should be at least 8 characters';
            } else {
                plateValidation.className = 'validation-message success';
                plateValidation.innerHTML = '<i class="fa-regular fa-circle-check"></i> Plate number looks good';
            }
            
            updatePreview();
        });

        // Update preview
        const previewPlate = document.getElementById('previewPlate');
        const previewModel = document.getElementById('previewModel');
        const previewEngine = document.getElementById('previewEngine');
        const previewStatus = document.getElementById('previewStatus');

        function updatePreview() {
            previewPlate.textContent = plateInput.value || 'Not set';
            previewModel.textContent = document.querySelector('input[name="model"]').value || 'Not set';
            previewEngine.textContent = document.querySelector('input[name="engine_number"]').value || 'Not set';
            
            const statusSelect = document.querySelector('select[name="status"]');
            previewStatus.textContent = statusSelect.options[statusSelect.selectedIndex]?.text || 'Available';
        }

        document.querySelectorAll('input[name="model"], input[name="engine_number"], select[name="status"]').forEach(input => {
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        });

        // Image upload preview
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

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
            handleImageUpload(file);
        });

        imageInput.addEventListener('change', function() {
            handleImageUpload(this.files[0]);
        });

        function handleImageUpload(file) {
            if (file && file.type.startsWith('image/')) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.querySelector('img').src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        window.removeImage = function() {
            imageInput.value = '';
            imagePreview.classList.add('hidden');
            uploadArea.classList.remove('hidden');
        };

        // Form submission
        document.getElementById('motorbikeForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-regular fa-spinner fa-spin"></i> Adding Motorbike...';
        });

        // Character counter for plate number
        function updateCharCount() {
            const length = plateInput.value.length;
            plateCount.textContent = `${length}/10`;
            
            if (length === 10) {
                plateCount.style.color = '#eab308';
            } else {
                plateCount.style.color = '#94a3b8';
            }
        }

        plateInput.addEventListener('input', updateCharCount);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('motorbikeForm').submit();
            }
            // Escape to go back
            if (e.key === 'Escape') {
                window.location.href = '{{ route("motorbikes.index") }}';
            }
        });

        // Auto-save draft to localStorage
        function saveDraft() {
            const formData = {
                plate_number: plateInput.value,
                model: document.querySelector('input[name="model"]').value,
                engine_number: document.querySelector('input[name="engine_number"]').value,
                year: document.querySelector('select[name="year"]').value,
                color: document.querySelector('input[name="color"]').value,
                fuel_type: document.querySelector('select[name="fuel_type"]').value,
                mileage: document.querySelector('input[name="mileage"]').value,
                purchase_date: document.querySelector('input[name="purchase_date"]').value,
                status: document.querySelector('select[name="status"]').value,
                notes: document.querySelector('textarea[name="notes"]').value
            };
            
            localStorage.setItem('motorbikeDraft', JSON.stringify(formData));
        }

        // Load draft from localStorage
        function loadDraft() {
            const draft = localStorage.getItem('motorbikeDraft');
            if (draft) {
                const formData = JSON.parse(draft);
                if (confirm('You have an unsaved draft. Would you like to restore it?')) {
                    plateInput.value = formData.plate_number || '';
                    document.querySelector('input[name="model"]').value = formData.model || '';
                    document.querySelector('input[name="engine_number"]').value = formData.engine_number || '';
                    document.querySelector('select[name="year"]').value = formData.year || '';
                    document.querySelector('input[name="color"]').value = formData.color || '';
                    document.querySelector('select[name="fuel_type"]').value = formData.fuel_type || '';
                    document.querySelector('input[name="mileage"]').value = formData.mileage || '';
                    document.querySelector('input[name="purchase_date"]').value = formData.purchase_date || '';
                    document.querySelector('select[name="status"]').value = formData.status || 'available';
                    document.querySelector('textarea[name="notes"]').value = formData.notes || '';
                    
                    updatePreview();
                    updateCharCount();
                }
            }
        }

        // Auto-save every 30 seconds
        setInterval(saveDraft, 30000);

        // Clear draft on successful submission
        @if(session('success'))
        localStorage.removeItem('motorbikeDraft');
        @endif

        // Load draft on page load
        window.addEventListener('load', loadDraft);

        // Form validation before submit
        document.getElementById('motorbikeForm').addEventListener('submit', function(e) {
            const plate = plateInput.value;
            if (plate.length < 8) {
                e.preventDefault();
                alert('Plate number must be at least 8 characters');
                return false;
            }
        });

        // Tooltips
        const tooltips = document.querySelectorAll('[data-tooltip]');
        tooltips.forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip-text';
                tooltip.textContent = this.dataset.tooltip;
                this.appendChild(tooltip);
            });
        });
    </script>

    <!-- Alpine.js for dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>