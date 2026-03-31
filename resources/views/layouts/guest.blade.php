<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('app.name', 'Laravel') }} - Secure Authentication">
    
    <title>{{ config('app.name', 'Laravel') }} | {{ ucfirst(request()->route()->getName() ?? 'Authentication') }}</title>

    <!-- Fonts - Modern Stack -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
    
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
            
            --secondary-50: #f0f9ff;
            --secondary-100: #e0f2fe;
            --secondary-500: #0ea5e9;
            --secondary-600: #0284c7;
            
            --success-500: #22c55e;
            --warning-500: #eab308;
            --danger-500: #ef4444;
            
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
      

        /* Floating Shapes Animation */
        .shape {
            position: fixed;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
            background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(14,165,233,0.2));
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            right: -50px;
            background: linear-gradient(135deg, rgba(236,72,153,0.2), rgba(168,85,247,0.2));
            animation: float 10s ease-in-out infinite reverse;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 10%;
            background: rgba(255,255,255,0.03);
            animation: float 12s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        /* Main Container */
        .auth-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem 1rem;
            position: relative;
            z-index: 1;
        }

        /* Logo Section */
        .logo-wrapper {
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeInDown 0.8s ease-out;
        }

        .logo-link {
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .logo-link:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, white, rgba(255,255,255,0.9));
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 30px -10px rgba(0,0,0,0.2);
            margin: 0 auto 1rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .logo-icon i {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, white, rgba(255,255,255,0.9));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            margin-top: 0.5rem;
        }

        /* Auth Card */
        .auth-card {
            width: 100%;
            max-width: 480px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            padding: 2.5rem;
            box-shadow: 
                0 30px 60px -10px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.1) inset;
            animation: fadeInUp 0.8s ease-out 0.2s both;
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* Card Header */
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--gray-800), var(--gray-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: var(--gray-500);
            font-size: 0.95rem;
        }

        /* Form Styles */
        .auth-form {
            margin-top: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 1.1rem;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
            color: var(--gray-700);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px var(--primary-100);
        }

        .form-input:focus + .input-icon {
            color: var(--primary-600);
        }

        .form-input.has-error {
            border-color: var(--danger-500);
            background-color: #fef2f2;
        }

        .error-message {
            font-size: 0.8rem;
            color: var(--danger-500);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: var(--primary-600);
        }

        /* Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border: 2px solid var(--gray-300);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-wrapper input[type="checkbox"]:checked {
            background-color: var(--primary-600);
            border-color: var(--primary-600);
        }

        .checkbox-label {
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            color: white;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -5px rgba(79, 70, 229, 0.4);
        }

        .btn-google {
            background: white;
            color: var(--gray-700);
            border: 2px solid var(--gray-200);
            margin-top: 1rem;
        }

        .btn-google:hover {
            border-color: var(--primary-500);
            background: var(--gray-50);
            transform: translateY(-2px);
        }

        .btn-google i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
            color: #ea4335;
        }

        /* Links */
        .auth-links {
            margin-top: 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .auth-link {
            color: var(--gray-500);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .auth-link:hover {
            color: var(--primary-600);
        }

        .auth-link i {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .auth-link:hover i {
            transform: translateX(3px);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--gray-200);
        }

        .divider span {
            padding: 0 1rem;
            color: var(--gray-400);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert i {
            font-size: 1.2rem;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }
            
            .auth-title {
                font-size: 1.75rem;
            }
            
            .logo-icon {
                width: 60px;
                height: 60px;
            }
            
            .logo-icon i {
                font-size: 2rem;
            }
            
            .logo-text {
                font-size: 1.5rem;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1e1b4b 0%, #2e1065 100%);
            }
            
            .auth-card {
                background: rgba(31, 41, 55, 0.95);
                border-color: rgba(255,255,255,0.05);
            }
            
            .auth-title {
                background: linear-gradient(135deg, white, var(--gray-300));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .form-input {
                background: var(--gray-800);
                border-color: var(--gray-700);
                color: white;
            }
            
            .form-label {
                color: var(--gray-300);
            }
            
            .checkbox-label {
                color: var(--gray-400);
            }
        }

        /* Additional Utilities */
        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .w-full {
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Animated Background Shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="auth-container">
        <!-- Logo Section -->
        <div class="logo-wrapper">
            <a href="/" class="logo-link">
                <div class="logo-icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
                
            </a>
        </div>

        <!-- Auth Card -->
        <div class="auth-card">
            @isset($header)
                <div class="auth-header">
                    <h1 class="auth-title">{{ $header }}</h1>
                    @isset($subtitle)
                        <p class="auth-subtitle">{{ $subtitle }}</p>
                    @endisset
                </div>
            @endisset

            <!-- Alert Messages -->
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Main Content -->
            <div class="auth-form">
                {{ $slot }}
            </div>

            <!-- Additional Links -->
            @if(request()->routeIs('login'))
                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-link">
                            <i class="fas fa-lock"></i>
                            Forgot your password?
                        </a>
                    @endif
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="auth-link">
                            Don't have an account?
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            @endif

            @if(request()->routeIs('register'))
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link">
                        Already have an account?
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endif

            @if(request()->routeIs('password.request'))
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to login
                    </a>
                </div>
            @endif

            @if(request()->routeIs('password.reset'))
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to login
                    </a>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="text-center mt-4">
            <p class="text-white/80 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'MotoFleet') }}. All rights reserved.
            </p>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.password-toggle');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    
                    // Toggle icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            });

            // Form submission loading state
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('[type="submit"]');
                    if (submitButton) {
                        const originalText = submitButton.innerHTML;
                        submitButton.disabled = true;
                        submitButton.innerHTML = '<span class="spinner"></span> Processing...';
                        
                        // Re-enable after timeout (in case of error)
                        setTimeout(() => {
                            submitButton.disabled = false;
                            submitButton.innerHTML = originalText;
                        }, 5000);
                    }
                });
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });

            // Input focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.input-group')?.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.closest('.input-group')?.classList.remove('focused');
                });
            });
        });
    </script>

    <!-- Stack for additional scripts -->
    @stack('scripts')
</body>
</html>