<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Service Records | <?php echo e(config('app.name', 'Fleet Manager')); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            
            --info-50: #eff6ff;
            --info-100: #dbeafe;
            --info-500: #3b82f6;
            --info-600: #2563eb;
            
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

        /* Stats Cards */
        .stat-card {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-500), var(--primary-600));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
        }

        /* Search Box */
        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        /* Table Styles */
        .table-container {
            padding: 1.5rem;
        }

        .modern-table {
            margin-bottom: 0;
        }

        .modern-table thead th {
            background: var(--gray-50);
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            border-bottom: 2px solid var(--gray-200);
        }

        .modern-table tbody tr {
            transition: all 0.2s ease;
            cursor: pointer;
            border-bottom: 1px solid var(--gray-100);
        }

        .modern-table tbody tr:hover {
            background: linear-gradient(90deg, var(--gray-50), white);
            transform: translateX(4px);
        }

        .modern-table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        /* Service ID Badge */
        .service-id {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: white;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Motorbike Avatar */
        .motorbike-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        /* Contract Badge */
        .contract-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Cost Badge */
        .cost-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.875rem;
        }

        /* Date Info */
        .date-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .date-details .date {
            font-weight: 500;
            color: var(--gray-800);
        }

        .date-details .time-ago {
            font-size: 0.75rem;
            color: var(--gray-500);
        }

        /* Description */
        .description-text {
            font-size: 0.875rem;
            color: var(--gray-700);
            line-height: 1.4;
        }

        .description-meta {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-top: 0.25rem;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            color: var(--gray-600);
            background: var(--gray-100);
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn.view:hover {
            background: var(--primary-600);
            color: white;
        }

        .action-btn.edit:hover {
            background: #f59e0b;
            color: white;
        }

        .action-btn.delete:hover {
            background: var(--danger-600);
            color: white;
        }

        /* Buttons */
        .btn-gradient-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
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

        /* Pagination */
        .pagination-modern {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .page-link-modern {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--gray-200);
            color: var(--gray-600);
            transition: all 0.2s ease;
            background: white;
            text-decoration: none;
        }

        .page-link-modern:hover {
            border-color: var(--primary-500);
            color: var(--primary-500);
            transform: translateY(-2px);
        }

        .page-link-modern.active {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: white;
        }

        .page-link-modern.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--gray-100), var(--gray-200));
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .empty-state-icon i {
            font-size: 3rem;
            color: var(--gray-400);
        }

        /* Modal */
        .modal-modern .modal-content {
            border: none;
            border-radius: 28px;
            overflow: hidden;
        }

        /* Toast Notifications */
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
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
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
            .stat-value {
                font-size: 1.5rem;
            }
            
            .modern-table thead th,
            .modern-table tbody td {
                padding: 0.75rem 1rem;
            }
            
            .description-cell {
                max-width: 200px;
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
            
            <?php
                $totalServices = $services->count();
                $totalCost = $services->sum('cost');
                $thisMonthServices = $services->filter(function($service) {
                    return \Carbon\Carbon::parse($service->service_date)->isCurrentMonth();
                })->count();
                $avgCost = $totalServices > 0 ? $totalCost / $totalServices : 0;
            ?>

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
                
                <div class="d-flex gap-3">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                    <a href="<?php echo e(route('services.create')); ?>" class="btn btn-gradient-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Service
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Total Services</p>
                                <h3 class="stat-value mb-0"><?php echo e($totalServices); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                                <i class="fas fa-screwdriver-wrench text-primary fa-2x"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="fas fa-arrow-up me-1"></i>+15%
                            </span>
                            <span class="small text-muted">vs last month</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Total Cost</p>
                                <h3 class="stat-value text-success mb-0">Tsh <?php echo e(number_format($totalCost/1000000, 1)); ?>M</h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                                <i class="fas fa-coins text-success fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Maintenance expenses</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">This Month</p>
                                <h3 class="stat-value text-warning mb-0"><?php echo e($thisMonthServices); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #fef9c3, #fef08a);">
                                <i class="fas fa-calendar-alt text-warning fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Services this month</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Average Cost</p>
                                <h3 class="stat-value text-info mb-0">Tsh <?php echo e(number_format($avgCost, 0)); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                                <i class="fas fa-chart-line text-info fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Per service</p>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="modern-card mb-4">
                <div class="p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchInput" placeholder="Search by service ID, motorbike, description, or contract...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Records Table -->
            <div class="modern-card">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="modern-table table">
                            <thead>
                                <tr>
                                    <th>Service ID</th>
                                    <th>Motorbike</th>
                                    <th>Contract</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Service Date</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="service-row" onclick="viewService(<?php echo e($service->id); ?>)">
                                    <td>
                                        <div class="service-id">
                                            <i class="fas fa-hashtag fa-xs"></i>
                                            <?php echo e(str_pad($service->id, 4, '0', STR_PAD_LEFT)); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="motorbike-avatar">
                                                <i class="fas fa-motorcycle"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold"><?php echo e($service->motorbike->model ?? 'N/A'); ?></div>
                                                <div class="small text-muted">
                                                    <i class="fas fa-tag me-1"></i><?php echo e($service->motorbike->plate_number ?? 'No Plate'); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($service->contract): ?>
                                        <div class="contract-badge">
                                            <i class="fas fa-file-contract"></i>
                                            #<?php echo e(str_pad($service->contract->id, 4, '0', STR_PAD_LEFT)); ?>

                                        </div>
                                        <?php else: ?>
                                        <span class="text-muted">No contract</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="description-text">
                                            <?php echo e(Str::limit($service->description, 60)); ?>

                                        </div>
                                        <?php if(strlen($service->description) > 60): ?>
                                        <div class="description-meta">
                                            <i class="fas fa-ellipsis-h"></i>
                                            Click to view full description
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="cost-badge">
                                            <i class="fas fa-tag"></i>
                                            Tsh <?php echo e(number_format($service->cost, 0)); ?>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                            <div class="date-details">
                                                <div class="date"><?php echo e(\Carbon\Carbon::parse($service->service_date)->format('M d, Y')); ?></div>
                                                <div class="time-ago"><?php echo e(\Carbon\Carbon::parse($service->service_date)->diffForHumans()); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end" onclick="event.stopPropagation()">
                                        <div class="action-group">
                                            <a href="<?php echo e(route('services.index', $service->id)); ?>" class="action-btn view" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('services.edit', $service->id)); ?>" class="action-btn edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button onclick="deleteService(<?php echo e($service->id); ?>)" class="action-btn delete" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <i class="fas fa-screwdriver-wrench"></i>
                                            </div>
                                            <h5 class="fw-bold text-muted mb-2">No Service Records Found</h5>
                                            <p class="text-muted mb-3">Get started by adding your first service record</p>
                                            <a href="<?php echo e(route('services.create')); ?>" class="btn btn-gradient-primary">
                                                <i class="fas fa-plus-circle me-2"></i>Add Your First Service
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if(method_exists($services, 'hasPages') && $services->hasPages()): ?>
                <div class="pagination-modern">
                    <?php if($services->onFirstPage()): ?>
                    <span class="page-link-modern disabled">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    <?php else: ?>
                    <a href="<?php echo e($services->previousPageUrl()); ?>" class="page-link-modern">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <?php endif; ?>

                    <?php $__currentLoopData = range(1, $services->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($i >= $services->currentPage() - 2 && $i <= $services->currentPage() + 2): ?>
                            <?php if($i == $services->currentPage()): ?>
                            <span class="page-link-modern active"><?php echo e($i); ?></span>
                            <?php else: ?>
                            <a href="<?php echo e($services->url($i)); ?>" class="page-link-modern"><?php echo e($i); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($services->hasMorePages()): ?>
                    <a href="<?php echo e($services->nextPageUrl()); ?>" class="page-link-modern">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <?php else: ?>
                    <span class="page-link-modern disabled">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Quick Stats Row -->
            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <div class="bg-white rounded-4 p-3 d-flex align-items-center gap-3 shadow-sm">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-chart-line text-primary fa-lg"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Maintenance Frequency</div>
                            <div class="fw-bold"><?php echo e($totalServices > 0 ? round($totalServices / max(1, \Carbon\Carbon::parse($services->min('service_date') ?? now())->diffInMonths(now())), 1) : 0); ?> services/month</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white rounded-4 p-3 d-flex align-items-center gap-3 shadow-sm">
                        <div class="bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-percent text-success fa-lg"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Cost Efficiency</div>
                            <div class="fw-bold"><?php echo e($totalServices > 0 ? 'Tsh ' . number_format($totalCost / $totalServices, 0) : 'Tsh 0'); ?> per service</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center text-muted small border-top bg-white bg-opacity-50">
        <div class="container">
            &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'FleetManager')); ?>. All rights reserved.
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Delete Modal -->
    <div class="modal fade modal-modern" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <div class="mx-auto mb-4" style="width: 80px; height: 80px; background: #fee2e2; border-radius: 30px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-screwdriver-wrench text-danger fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Delete Service Record</h5>
                    <p class="text-muted mb-4">Are you sure you want to delete this service record? This action cannot be undone.</p>
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-outline-secondary flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteForm" method="POST" class="flex-grow-1">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger w-100">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let deleteModal = null;
        
        document.addEventListener('DOMContentLoaded', function() {
            deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            
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
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const rows = document.querySelectorAll('.service-row');
            
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    let visibleCount = 0;
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Show empty state if no results
                    const tbody = document.getElementById('tableBody');
                    const existingEmptyRow = tbody.querySelector('.empty-search-row');
                    
                    if (visibleCount === 0 && rows.length > 0 && !existingEmptyRow) {
                        const emptyRow = document.createElement('tr');
                        emptyRow.className = 'empty-search-row';
                        emptyRow.innerHTML = `
                            <td colspan="7">
                                <div class="empty-state py-4">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h5 class="fw-bold text-muted mb-2">No Results Found</h5>
                                    <p class="text-muted mb-0">No service records match your search criteria</p>
                                </div>
                              </td>
                        `;
                        tbody.appendChild(emptyRow);
                    } else if (visibleCount > 0 && existingEmptyRow) {
                        existingEmptyRow.remove();
                    }
                });
            }
        });
        
        // View Service
        window.viewService = function(id) {
            window.location.href = `/services/${id}`;
        };
        
        // Delete Service
        window.deleteService = function(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/services/${id}`;
            deleteModal.show();
        };
        
        // Toast Notification
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'warning'} alert-dismissible fade show position-relative mb-3`;
            toast.style.borderRadius = '16px';
            toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
            toast.innerHTML = `
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
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
        
        // Session Messages
        <?php if(session('success')): ?>
        showToast('<?php echo e(session('success')); ?>', 'success');
        <?php endif; ?>
        
        <?php if(session('error')): ?>
        showToast('<?php echo e(session('error')); ?>', 'error');
        <?php endif; ?>
        
        // Keyboard Shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 'a') {
                e.preventDefault();
                window.location.href = '<?php echo e(route("services.create")); ?>';
            }
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('searchInput')?.focus();
            }
            if (e.key === 'Escape') {
                if (deleteModal) deleteModal.hide();
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\motorbike-system\resources\views/services/index.blade.php ENDPATH**/ ?>