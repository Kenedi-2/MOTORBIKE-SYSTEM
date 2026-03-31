<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Motorbikes Management | <?php echo e(config('app.name', 'Fleet Manager')); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            --success-700: #15803d;
            
            --warning-50: #fefce8;
            --warning-100: #fef9c3;
            --warning-500: #eab308;
            --warning-600: #ca8a04;
            --warning-700: #a16207;
            
            --danger-50: #fef2f2;
            --danger-100: #fee2e2;
            --danger-500: #ef4444;
            --danger-600: #dc2626;
            --danger-700: #b91c1c;
            
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
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.12);
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border: none;
            border-radius: 24px;
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

        /* Progress Bar */
        .progress-modern {
            background: var(--gray-200);
            border-radius: 12px;
            height: 6px;
            overflow: hidden;
        }

        .progress-bar-modern {
            border-radius: 12px;
            transition: width 1s ease;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .modern-table {
            margin-bottom: 0;
        }

        .modern-table thead th {
            background: var(--gray-50);
            padding: 1.25rem 1.5rem;
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
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge.active {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
        }

        .status-badge.maintenance {
            background: linear-gradient(135deg, #fef9c3, #fef08a);
            color: #854d0e;
        }

        .status-badge.inactive {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            color: #475569;
        }

        .status-badge.available {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 0.5rem;
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
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn.view:hover {
            background: #10b981;
            color: white;
        }

        .action-btn.edit:hover {
            background: var(--primary-600);
            color: white;
        }

        .action-btn.delete:hover {
            background: var(--danger-600);
            color: white;
        }

        /* Search and Filter */
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
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .filter-select {
            padding: 0.75rem 2rem 0.75rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            font-size: 0.875rem;
            background: white;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%234f46e5' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
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

        /* Pagination */
        .pagination-modern {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
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

        /* Modal */
        .modal-modern .modal-content {
            border: none;
            border-radius: 32px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
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

        /* Quick Actions Cards */
        .quick-action-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            padding: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .quick-action-card:hover {
            border-color: var(--primary-300);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
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
                $totalBikes = $motorbikes->count();
                $activeBikes = $motorbikes->where('status', 'active')->count();
                $maintenanceBikes = $motorbikes->where('status', 'maintenance')->count();
                $availableBikes = $motorbikes->where('status', 'available')->count();
            ?>

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5">
                
                <div class="d-flex gap-3">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                    <a href="<?php echo e(route('motorbikes.create')); ?>" class="btn btn-gradient-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Motorbike
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Total Bikes</p>
                                <h3 class="stat-value mb-0"><?php echo e($totalBikes); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe);">
                                <i class="fas fa-motorcycle text-primary fa-2x"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="fas fa-arrow-up me-1"></i>+2
                            </span>
                            <span class="small text-muted">from last month</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Active</p>
                                <h3 class="stat-value text-success mb-0"><?php echo e($activeBikes); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                        </div>
                        <div class="progress-modern">
                            <div class="progress-bar-modern bg-success" style="width: <?php echo e($totalBikes > 0 ? ($activeBikes / $totalBikes) * 100 : 0); ?>%"></div>
                        </div>
                        <p class="small text-muted mt-2"><?php echo e($totalBikes > 0 ? round(($activeBikes / $totalBikes) * 100) : 0); ?>% of total fleet</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Maintenance</p>
                                <h3 class="stat-value text-warning mb-0"><?php echo e($maintenanceBikes); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #fef9c3, #fef08a);">
                                <i class="fas fa-tools text-warning fa-2x"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-clock me-1"></i>3 due soon
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Available</p>
                                <h3 class="stat-value text-info mb-0"><?php echo e($availableBikes); ?></h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                                <i class="fas fa-check text-info fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Ready for assignment</p>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search by plate number, model, or engine number...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="filter-select w-100" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="inactive">Inactive</option>
                        <option value="available">Available</option>
                    </select>
                </div>
            </div>

            <!-- Motorbikes Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="modern-table table">
                        <thead>
                            <tr>
                                <th>Bike Info</th>
                                <th>Model</th>
                                <th>Engine Number</th>
                                <th>Status</th>
                                <th>Last Service</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php $__empty_1 = true; $__currentLoopData = $motorbikes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bike): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="motorbike-row" onclick="viewMotorbike(<?php echo e($bike->id); ?>)">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-motorcycle text-indigo-600 fa-lg"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold"><?php echo e($bike->plate_number); ?></div>
                                            <div class="small text-muted">ID: <?php echo e(substr($bike->id, 0, 8)); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium"><?php echo e($bike->model); ?></div>
                                    <div class="small text-muted"><?php echo e($bike->year ?? 'Year N/A'); ?></div>
                                </td>
                                <td>
                                    <code class="small"><?php echo e($bike->engine_number); ?></code>
                                </td>
                                <td>
                                    <span class="status-badge <?php echo e($bike->status); ?>">
                                        <i class="fas fa-circle fa-2xs"></i>
                                        <?php echo e(ucfirst($bike->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="small"><?php echo e($bike->last_service_date ?? 'Not serviced'); ?></div>
                                    <?php if($bike->last_service_date): ?>
                                    <div class="small text-muted">
                                        <?php echo e(\Carbon\Carbon::parse($bike->last_service_date)->diffForHumans()); ?>

                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td onclick="event.stopPropagation()">
                                    <div class="action-group">
                                        <button onclick="viewMotorbike(<?php echo e($bike->id); ?>)" class="action-btn view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="<?php echo e(route('motorbikes.edit', $bike)); ?>" class="action-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="deleteMotorbike(<?php echo e($bike->id); ?>)" class="action-btn delete" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-motorcycle"></i>
                                        </div>
                                        <h5 class="fw-bold text-muted mb-2">No Motorbikes Found</h5>
                                        <p class="text-muted mb-3">Get started by adding your first motorbike to the fleet</p>
                                        <a href="<?php echo e(route('motorbikes.create')); ?>" class="btn btn-gradient-primary">
                                            <i class="fas fa-plus-circle me-2"></i>Add Your First Motorbike
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
            <?php if($motorbikes->hasPages()): ?>
            <div class="pagination-modern">
                
                <?php if($motorbikes->onFirstPage()): ?>
                <span class="page-link-modern disabled opacity-50">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <?php else: ?>
                <a href="<?php echo e($motorbikes->previousPageUrl()); ?>" class="page-link-modern">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <?php endif; ?>

                
                <?php $__currentLoopData = range(1, $motorbikes->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($i >= $motorbikes->currentPage() - 2 && $i <= $motorbikes->currentPage() + 2): ?>
                        <?php if($i == $motorbikes->currentPage()): ?>
                        <span class="page-link-modern active"><?php echo e($i); ?></span>
                        <?php else: ?>
                        <a href="<?php echo e($motorbikes->url($i)); ?>" class="page-link-modern"><?php echo e($i); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if($motorbikes->hasMorePages()): ?>
                <a href="<?php echo e($motorbikes->nextPageUrl()); ?>" class="page-link-modern">
                    <i class="fas fa-chevron-right"></i>
                </a>
                <?php else: ?>
                <span class="page-link-modern disabled opacity-50">
                    <i class="fas fa-chevron-right"></i>
                </span>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Quick Actions -->
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="quick-action-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-file-import text-info fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-0">Bulk Import</h6>
                                <p class="small text-muted mb-0">Import multiple motorbikes</p>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="quick-action-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-file-pdf text-success fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-0">Generate Report</h6>
                                <p class="small text-muted mb-0">Fleet status report</p>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="quick-action-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-calendar-check text-warning fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-0">Schedule Service</h6>
                                <p class="small text-muted mb-0">Maintenance planning</p>
                            </div>
                            <i class="fas fa-arrow-right text-muted"></i>
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
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-modern">
                <div class="modal-body p-4 text-center">
                    <div class="mx-auto mb-4" style="width: 80px; height: 80px; background: #fee2e2; border-radius: 30px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-trash-alt text-danger fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Delete Motorbike</h5>
                    <p class="text-muted mb-4">Are you sure you want to delete this motorbike? This action cannot be undone.</p>
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
        
        // Initialize Bootstrap Modal
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
            
            // Search and Filter
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('.motorbike-row');
            
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusTerm = statusFilter.value.toLowerCase();
                let visibleCount = 0;
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const status = row.querySelector('.status-badge')?.textContent.toLowerCase().trim() || '';
                    
                    const matchesSearch = text.includes(searchTerm);
                    const matchesStatus = !statusTerm || status.includes(statusTerm);
                    
                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // Show/hide empty state
                const tbody = document.getElementById('tableBody');
                const existingEmptyRow = tbody.querySelector('.empty-state-row');
                
                if (visibleCount === 0 && !existingEmptyRow) {
                    const emptyRow = document.createElement('tr');
                    emptyRow.className = 'empty-state-row';
                    emptyRow.innerHTML = `
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h5 class="fw-bold text-muted mb-2">No Results Found</h5>
                                <p class="text-muted mb-0">No motorbikes match your search criteria</p>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(emptyRow);
                } else if (visibleCount > 0 && existingEmptyRow) {
                    existingEmptyRow.remove();
                }
            }
            
            if (searchInput) searchInput.addEventListener('keyup', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);
        });
        
        // View Motorbike
        window.viewMotorbike = function(id) {
            window.location.href = `/motorbikes/${id}`;
        };
        
        // Delete Motorbike
        window.deleteMotorbike = function(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/motorbikes/${id}`;
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
        
        <?php if(session('warning')): ?>
        showToast('<?php echo e(session('warning')); ?>', 'warning');
        <?php endif; ?>
        
        // Keyboard Shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 'a') {
                e.preventDefault();
                window.location.href = '<?php echo e(route("motorbikes.create")); ?>';
            }
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('searchInput')?.focus();
            }
            if (e.altKey && e.key === 't') {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\motorbike-system\resources\views/motorbikes/index.blade.php ENDPATH**/ ?>