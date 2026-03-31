<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="MotoFleet Pro - Enterprise-grade motorbike fleet management solution for modern logistics companies">
    <meta name="keywords" content="fleet management, motorbike tracking, driver management, logistics software">
    <meta name="author" content="MotoFleet Pro">
    <meta property="og:title" content="MotoFleet Pro | Smart Fleet Management">
    <meta property="og:description" content="Streamline your fleet operations with real-time tracking and comprehensive analytics">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    
    <title>{{ config('app.name', 'MotoFleet Pro') }} | Enterprise Fleet Management Platform</title>

    <!-- Google Fonts - Modern Stack -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 (Professional Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Modern CSS -->
    <style>
        /* CSS Variables for consistent theming */
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
            
            --success-50: #f0fdf4;
            --success-500: #22c55e;
            --success-600: #16a34a;
            
            --warning-50: #fefce8;
            --warning-500: #eab308;
            --warning-600: #ca8a04;
            
            --danger-50: #fef2f2;
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
            background: linear-gradient(135deg, var(--gray-50), white);
            color: var(--gray-800);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Modern Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .navbar-scrolled {
            padding: 0.75rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.75rem;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--gray-700) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .nav-link:hover {
            color: var(--primary-600) !important;
        }

        /* Modern Buttons */
        .btn-modern {
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: none;
            letter-spacing: 0.5px;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-modern:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            color: white;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }

        .btn-primary-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -5px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .btn-outline-modern {
            background: transparent;
            border: 2px solid var(--primary-600);
            color: var(--primary-600);
        }

        .btn-outline-modern:hover {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            border-color: transparent;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.3);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 0 80px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 80%;
            height: 200%;
            background: radial-gradient(circle, rgba(99,102,241,0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 80%;
            height: 200%;
            background: radial-gradient(circle, rgba(14,165,233,0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(14,165,233,0.1));
            border-radius: 50px;
            color: var(--primary-600);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(99,102,241,0.2);
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--gray-900), var(--gray-700));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--gray-500);
            margin-bottom: 2.5rem;
            max-width: 600px;
            line-height: 1.8;
        }

        .hero-stats {
            display: flex;
            gap: 4rem;
            margin-top: 3rem;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.25rem;
        }

        .stat-item p {
            font-size: 1rem;
            color: var(--gray-500);
            margin-bottom: 0;
        }

        .hero-image {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        .hero-image img {
            border-radius: 30px;
            box-shadow: 0 50px 70px -20px rgba(0, 0, 0, 0.3);
            transition: all 0.5s ease;
        }

        .hero-image:hover img {
            transform: scale(1.02);
            box-shadow: 0 60px 80px -20px rgba(79, 70, 229, 0.4);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: white;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header .hero-badge {
            margin-bottom: 1rem;
        }

        .section-header h2 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.2rem;
            color: var(--gray-500);
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.02);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 40px 60px rgba(79, 70, 229, 0.1);
            border-color: transparent;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(14,165,233,0.1));
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-icon i {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-card h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--gray-900);
        }

        .feature-card p {
            color: var(--gray-500);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .feature-link {
            color: var(--primary-600);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .feature-link:hover {
            gap: 1rem;
            color: var(--secondary-500);
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .stats-card {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stats-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: white;
        }

        .stats-card h3 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-card p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        /* Status Section */
        .status-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--gray-50), white);
        }

        .status-card {
            background: white;
            border-radius: 40px;
            padding: 3rem;
            box-shadow: 0 40px 60px rgba(0, 0, 0, 0.05);
            max-width: 900px;
            margin: 0 auto;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .status-card:hover {
            box-shadow: 0 50px 70px rgba(79, 70, 229, 0.1);
            transform: translateY(-5px);
        }

        .status-metric {
            background: var(--gray-50);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .status-metric:hover {
            background: linear-gradient(135deg, rgba(99,102,241,0.05), rgba(14,165,233,0.05));
            transform: scale(1.05);
        }

        .status-metric i {
            font-size: 2rem;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .status-metric h5 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }

        .status-metric p {
            color: var(--gray-500);
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .status-badge {
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-block;
        }

        .status-badge.success {
            background: linear-gradient(135deg, rgba(34,197,94,0.1), rgba(22,163,74,0.1));
            color: var(--success-600);
            border: 1px solid rgba(34,197,94,0.2);
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: white;
        }

        .cta-card {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            border-radius: 50px;
            padding: 5rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 40px 60px rgba(79, 70, 229, 0.2);
        }

        .cta-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .cta-card::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 60%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .cta-card h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .cta-card p {
            font-size: 1.3rem;
            opacity: 0.95;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .btn-cta {
            background: white;
            color: var(--primary-600);
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 40px rgba(0, 0, 0, 0.2);
            color: var(--secondary-500);
        }

        /* Footer */
        .footer {
            background: var(--gray-900);
            color: var(--gray-400);
            padding: 80px 0 40px;
            position: relative;
        }

        .footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: var(--gray-400);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .social-links a:hover {
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            transform: translateY(-5px);
        }

        .footer-bottom {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        /* Back to Top Button */
        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-600), var(--secondary-500));
            color: white;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }

        #backToTop:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 20px 30px rgba(79, 70, 229, 0.4);
        }

        /* Loading Spinner */
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid var(--gray-200);
            border-top-color: var(--primary-600);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3rem;
            }
            
            .hero-stats {
                gap: 2rem;
                flex-wrap: wrap;
            }
            
            .section-header h2 {
                font-size: 2.5rem;
            }
            
            .cta-card {
                padding: 3rem;
            }
            
            .cta-card h2 {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 100px 0 60px;
                text-align: center;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-stats {
                justify-content: center;
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }
            
            .stats-card {
                margin-bottom: 1rem;
            }
        }

        /* Custom Animations */
        @keyframes slideInUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.8s ease forwards;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-motorcycle me-2"></i>
            MOTORBIKE 
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#status">System Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item ms-3">
                            <a class="btn btn-modern btn-primary-modern" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                    @elseif(auth()->user()->role === 'driver')
                        <li class="nav-item ms-3">
                            <a class="btn btn-modern btn-primary-modern" href="{{ route('drivers.dashboard') }}">
                                <i class="fas fa-motorcycle me-2"></i>Driver Portal
                            </a>
                        </li>
                    @endif

                    <li class="nav-item ms-2">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-modern btn-outline-modern">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-3">
                        <a class="btn btn-modern btn-outline-modern" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item ms-2">
                            <a class="btn btn-modern btn-primary-modern" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content" data-aos="fade-right">
                <span class="hero-badge">
                    <i class="fas fa-bolt me-2"></i>Enterprise Fleet Management
                </span>
                <h1>
                    Smart <span>Motorbike</span><br>Management Platform
                </h1>
                <p>
                    Streamline your fleet operations with real-time tracking, automated assignments, and comprehensive analytics. Trusted by 500+ companies worldwide.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-modern btn-primary-modern btn-lg">
                        <i class="fas fa-rocket me-2"></i>Start Free Trial
                    </a>
                    <a href="#features" class="btn btn-modern btn-outline-modern btn-lg">
                        <i class="fas fa-play me-2"></i>Watch Demo
                    </a>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <h3>500+</h3>
                        <p>Active Fleets</p>
                    </div>
                    <div class="stat-item">
                        <h3>10k+</h3>
                        <p>Happy Drivers</p>
                    </div>
                    <div class="stat-item">
                        <h3>98%</h3>
                        <p>Satisfaction</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                         alt="Fleet Management Dashboard" 
                         class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute bottom-0 end-0 p-4">
                        <span class="badge bg-white text-primary p-3 rounded-4 shadow">
                            <i class="fas fa-chart-line me-2"></i>Real-time Analytics
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="features">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="hero-badge">
                <i class="fas fa-star me-2"></i>Features
            </span>
            <h2>Everything You Need to Manage Your Fleet</h2>
            <p>Powerful tools designed to streamline your motorbike fleet operations and boost productivity</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h4>Motorbike Management</h4>
                    <p>Track maintenance schedules, fuel efficiency, and real-time location of all your bikes with predictive analytics.</p>
                    <a href="#" class="feature-link">
                        Learn more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Driver Management</h4>
                    <p>Complete driver profiles with license verification, performance tracking, and automated scheduling.</p>
                    <a href="#" class="feature-link">
                        Learn more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h4>Contract Tracking</h4>
                    <p>Smart contract management with automated renewals, digital signatures, and payment processing.</p>
                    <a href="#" class="feature-link">
                        Learn more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h4>Real-time Tracking</h4>
                    <p>GPS tracking with geofencing, route optimization, and live ETA updates for complete fleet visibility.</p>
                    <a href="#" class="feature-link">
                        Learn more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h4>Advanced Analytics</h4>
                    <p>Comprehensive reports on fuel consumption, maintenance costs, and driver performance metrics.</p>
                    <a href="#" class="feature-link">
                        Learn more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Mobile App</h4>
                    <p>Native mobile apps for iOS and Android with offline support and push notifications.</p>
                    <a href="#" class="feature-link">
                        Learn more <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6" data-aos="zoom-in">
                <div class="stats-card">
                    <i class="fas fa-bicycle"></i>
                    <h3 class="counter">2,500</h3>
                    <p>Bikes Managed</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-user-tie"></i>
                    <h3 class="counter">1,800</h3>
                    <p>Active Drivers</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="stats-card">
                    <i class="fas fa-file-signature"></i>
                    <h3 class="counter">3,200</h3>
                    <p>Contracts</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="stats-card">
                    <i class="fas fa-globe"></i>
                    <h3 class="counter">15</h3>
                    <p>Countries</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Status Section with React -->
<section class="status-section" id="status">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="hero-badge">
                <i class="fas fa-heartbeat me-2"></i>Live Status
            </span>
            <h2>System Health Monitor</h2>
            <p>Real-time system status and performance metrics with 99.9% uptime SLA</p>
        </div>
        
        <div class="status-card" data-aos="fade-up">
            <div id="react-status" class="text-center">
                <div class="spinner"></div>
                <p class="text-muted">Loading system status...</p>
            </div>
        </div>
    </div>
</section>
<!-- Enhanced CTA Section -->
<section class="cta-section" id="contact">
    <div class="container">
        <div class="cta-card" data-aos="fade-up">
            <h2>Ready to Transform Your Fleet?</h2>
            <p>Join thousands of companies managing their motorbike fleets with MotoFleet Pro. Start your 14-day free trial today.</p>
            <a href="{{ route('register') }}" class="btn btn-cta btn-lg">
                <i class="fas fa-calendar-check me-2"></i>Start Free Trial
            </a>
            <p class="mt-4 small opacity-75">
                <i class="fas fa-check-circle me-1"></i>No credit card required 
                <i class="fas fa-circle mx-2" style="font-size: 4px;"></i>
                <i class="fas fa-headset me-1"></i>24/7 support
            </p>
        </div>
    </div>
</section>

<!-- Enhanced Footer -->
<footer class="footer" id="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5><i class="fas fa-motorcycle me-2"></i>MotoFleet Pro</h5>
                <p class="mb-4">Professional motorbike fleet management solution for modern businesses. Streamline operations, reduce costs, and maximize efficiency.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h5>Product</h5>
                <ul class="footer-links">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#">Demo</a></li>
                    <li><a href="#">Security</a></li>
                    <li><a href="#">API</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h5>Company</h5>
                <ul class="footer-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Partners</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-4">
                <h5>Resources</h5>
                <ul class="footer-links">
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Tutorials</a></li>
                    <li><a href="#">Webinars</a></li>
                    <li><a href="#">Community</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2">
                <h5>Contact</h5>
                <ul class="footer-links">
                    <li><i class="fas fa-envelope me-2"></i> kg336504@gmail.com</li>
                    <li><i class="fas fa-phone me-2"></i> +255-654-272-458</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i> Dar es Salaam, Tanzania</li>
                    <li><i class="fas fa-clock me-2"></i> 24/7 Support</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    <p>© {{ date('Y') }} MotoFleet Pro. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white-50 me-3">Privacy Policy</a>
                    <a href="#" class="text-white-50 me-3">Terms of Service</a>
                    <a href="#" class="text-white-50">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/react@18.2.0/umd/react.production.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/react-dom@18.2.0/umd/react-dom.production.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/babel-standalone@6.26.0/babel.min.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100,
        easing: 'ease-in-out'
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 50) {
            nav.classList.add('navbar-scrolled');
        } else {
            nav.classList.remove('navbar-scrolled');
        }
    });
    
    // Back to top button
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });
    
    // Counter animation
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 20);
    }
    
    // Intersection Observer for counters
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.querySelectorAll('.counter').forEach(counter => {
                    const target = parseInt(counter.textContent.replace(/,/g, ''));
                    animateCounter(counter, target);
                });
                observer.unobserve(entry.target);
            }
        });
    });
    
    observer.observe(document.querySelector('.stats-section'));
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

<!-- Enhanced React Component -->
<script type="text/babel">
    const { useState, useEffect } = React;

    function SystemStatus() {
        const [status, setStatus] = useState({
            message: "Loading system status...",
            type: "info",
            metrics: null
        });

        useEffect(() => {
            // Simulate API call with real data
            setTimeout(() => {
                setStatus({
                    message: "All systems operational",
                    type: "success",
                    metrics: {
                        uptime: "99.99%",
                        responseTime: "124ms",
                        activeUsers: 2347,
                        serverLoad: "32%",
                        apiCalls: "1.2M",
                        incidents: 0
                    }
                });
            }, 2000);
        }, []);

        if (!status.metrics) {
            return (
                <div className="text-center py-5">
                    <div className="spinner"></div>
                    <p className="text-muted mt-3">{status.message}</p>
                </div>
            );
        }

        return (
            <div>
                <div className="text-center mb-5">
                    <span className="status-badge success">
                        <i className="fas fa-check-circle me-2"></i>
                        {status.message}
                    </span>
                </div>
                
                <div className="row g-4">
                    <div className="col-6 col-md-3">
                        <div className="status-metric">
                            <i className="fas fa-clock"></i>
                            <h5>{status.metrics.uptime}</h5>
                            <p>Uptime</p>
                        </div>
                    </div>
                    
                    <div className="col-6 col-md-3">
                        <div className="status-metric">
                            <i className="fas fa-bolt"></i>
                            <h5>{status.metrics.responseTime}</h5>
                            <p>Response Time</p>
                        </div>
                    </div>
                    
                    <div className="col-6 col-md-3">
                        <div className="status-metric">
                            <i className="fas fa-users"></i>
                            <h5>{status.metrics.activeUsers.toLocaleString()}</h5>
                            <p>Active Users</p>
                        </div>
                    </div>
                    
                    <div className="col-6 col-md-3">
                        <div className="status-metric">
                            <i className="fas fa-microchip"></i>
                            <h5>{status.metrics.serverLoad}</h5>
                            <p>Server Load</p>
                        </div>
                    </div>
                </div>

                <div className="row g-4 mt-2">
                    <div className="col-6">
                        <div className="status-metric">
                            <i className="fas fa-chart-line"></i>
                            <h5>{status.metrics.apiCalls}</h5>
                            <p>API Calls (24h)</p>
                        </div>
                    </div>
                    
                    <div className="col-6">
                        <div className="status-metric">
                            <i className="fas fa-exclamation-triangle"></i>
                            <h5>{status.metrics.incidents}</h5>
                            <p>Incidents</p>
                        </div>
                    </div>
                </div>

                <div className="mt-4 text-center">
                    <span className="text-muted small">
                        <i className="fas fa-sync-alt me-1 fa-spin"></i>
                        Auto-refreshes every 30 seconds
                    </span>
                </div>
            </div>
        );
    }

    // Render React component
    const container = document.getElementById('react-status');
    if (container) {
        const root = ReactDOM.createRoot(container);
        root.render(<SystemStatus />);
    }
</script>

</body>
</html>