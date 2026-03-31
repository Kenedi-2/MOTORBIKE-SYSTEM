<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Contract Management System</title>
    
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
        }

        /* Animation Keyframes */
        @keyframes slideInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border: none;
            border-radius: 24px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            animation: slideInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .stat-label {
            color: var(--gray-500);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .stat-trend {
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.05);
        }

        /* Progress Bar */
        .progress-modern {
            background: rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            height: 6px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .progress-bar-modern {
            border-radius: 12px;
            transition: width 1s ease;
        }

        /* Chart Cards */
        .chart-card {
            background: white;
            border: none;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            animation: fadeIn 0.8s ease-out 0.5s forwards;
            opacity: 0;
        }

        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-btn {
            padding: 0.375rem 1rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-600);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .chart-btn:hover,
        .chart-btn.active {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: white;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.8s ease-out 0.7s forwards;
            opacity: 0;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-box {
            position: relative;
            min-width: 280px;
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
            padding: 0.625rem 1rem 0.625rem 2.5rem;
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
            padding: 0.625rem 2rem 0.625rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            font-size: 0.875rem;
            background: white;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
        }

        .modern-table {
            width: 100%;
        }

        .modern-table thead th {
            background: var(--gray-50);
            padding: 1rem;
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
            background: var(--gray-50);
            transform: translateX(4px);
        }

        .modern-table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.375rem 1rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge i {
            font-size: 0.5rem;
        }

        .status-badge.active {
            background: var(--success-100);
            color: var(--success-700);
        }

        .status-badge.pending {
            background: var(--warning-100);
            color: var(--warning-700);
        }

        .status-badge.completed {
            background: var(--primary-100);
            color: var(--primary-700);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .amount-positive {
            color: var(--success-600);
            font-weight: 700;
        }

        /* Buttons */
        .btn-gradient-primary {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            color: white;
            border: none;
            border-radius: 16px;
            padding: 0.625rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
            color: white;
        }

        .btn-outline-modern {
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            padding: 0.625rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-outline-modern:hover {
            border-color: var(--primary-500);
            background: var(--primary-50);
        }

        /* Pagination */
        .pagination-modern {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .page-link-modern {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
            transition: all 0.2s ease;
            cursor: pointer;
            background: white;
        }

        .page-link-modern:hover {
            background: var(--gray-100);
            border-color: var(--gray-400);
        }

        .page-link-modern.active {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .empty-state-icon i {
            font-size: 3rem;
            color: var(--gray-400);
        }

        /* Date Range Picker */
        .date-range-picker {
            background: white;
            border-radius: 16px;
            padding: 0.5rem 1rem;
            border: 1px solid var(--gray-200);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .date-range-picker:hover {
            border-color: var(--primary-500);
            background: var(--primary-50);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.5rem;
            }
            
            .table-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                min-width: auto;
            }
            
            .pagination-modern {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<x-app-layout>
    <div class="container-fluid py-4 py-lg-5">
        <div class="container px-4 px-lg-5">
            
            <!-- Header with Actions -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                
                
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-modern dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-2"></i>Export
                        </button>

                    </div>
                </div>
            </div>
            
            <!-- Date Range Picker -->
            <div class="d-flex justify-content-end gap-3 mb-4">
                <div class="date-range-picker d-flex align-items-center gap-2">
                    <i class="fas fa-calendar-alt text-primary"></i>
                    <span class="small">Last 30 Days</span>
                    <i class="fas fa-chevron-down text-muted fa-xs"></i>
                </div>
                <button class="btn btn-outline-modern" style="padding: 0.5rem 1rem;">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);">
                            <i class="fas fa-motorcycle fa-2x text-primary"></i>
                        </div>
                        <div class="stat-value">{{ $bikes }}</div>
                        <div class="stat-label">Total Motorbikes</div>
                       
                        <div class="progress-modern">
                            <div class="progress-bar-modern bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                        <div class="stat-value">{{ $drivers }}</div>
                        <div class="stat-label">Active Drivers</div>
                    
                        <div class="progress-modern">
                            <div class="progress-bar-modern bg-success" style="width: 82%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);">
                            <i class="fas fa-file-contract fa-2x text-success"></i>
                        </div>
                        
                         <p class="stat-value">{{ $activeContracts }}</p>
                          <h3>Active Contracts</h3>
                        
                        <div class="progress-modern">
                            <div class="progress-bar-modern bg-warning" style="width: 68%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);">
                            <i class="fas fa-chart-line fa-2x text-danger"></i>
                        </div>
                        <div class="stat-value">Tsh {{ number_format($paymentsTotal/1000000, 1) }}M</div>
                        <div class="stat-label">Total Revenue</div>
                       
                        <div class="progress-modern">
                            <div class="progress-bar-modern bg-danger" style="width: 91%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
           <div class="row g-4 mb-5">
    <!-- Revenue Overview Chart -->
    <div class="col-lg-8">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-chart-line text-primary"></i>
                    Revenue Overview
                </div>
                <div class="btn-group" role="group">
                    <button class="chart-btn active">Monthly</button>
                    <button class="chart-btn">Quarterly</button>
                    <button class="chart-btn">Yearly</button>
                </div>
            </div>
            <div class="position-relative" style="height: 320px;">
                <canvas id="paymentsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Contract Status Chart -->
    <div class="col-lg-4">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <i class="fas fa-chart-pie text-primary"></i>
                    Contract Status
                </div>
                <button class="btn btn-sm text-muted">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>
            <div class="position-relative" style="height: 240px;">
                <canvas id="contractsChart"></canvas>
            </div>

            @php
                $totalContracts = max($activeContracts + $pendingContracts + $completedContracts, 1);

                $activePercent = round(($activeContracts / $totalContracts) * 100);
                $pendingPercent = round(($pendingContracts / $totalContracts) * 100);
                $completedPercent = 100 - ($activePercent + $pendingPercent); // ensures total = 100%
            @endphp

            <div class="row g-3 mt-4">
                <!-- Active Contracts -->
                <div class="col-4 text-center">
                    <div class="mx-auto mb-2" style="width: 40px; height: 40px; background: #dcfce7; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div class="small text-muted">Active</div>
                    <div class="fw-bold">{{ $activeContracts }} 
                        <span class="small text-muted">({{ $activePercent }}%)</span>
                    </div>
                </div>

                <!-- Pending Contracts -->
                <div class="col-4 text-center">
                    <div class="mx-auto mb-2" style="width: 40px; height: 40px; background: #fef3c7; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock text-warning"></i>
                    </div>
                    <div class="small text-muted">Pending</div>
                    <div class="fw-bold">{{ $pendingContracts }} 
                        <span class="small text-muted">({{ $pendingPercent }}%)</span>
                    </div>
                </div>

                <!-- Completed Contracts (remaining amount = 0) -->
                <div class="col-4 text-center">
                    <div class="mx-auto mb-2" style="width: 40px; height: 40px; background: #e0f2fe; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-double text-primary"></i>
                    </div>
                    <div class="small text-muted">Completed</div>
                    <div class="fw-bold text-success">
                        {{ $completedContracts }} 
                        <span class="small text-muted">({{ $completedPercent }}%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Recent Contracts Table -->
            <div class="table-container">
                <div class="table-header">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-file-signature text-primary me-2"></i>
                        Recent Contracts
                    </h5>
                    
                    <div class="d-flex gap-3">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search contracts..." id="searchInput">
                        </div>
                        <select class="filter-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Motorbike</th>
                                <th>Sponsor</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Start Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($recentContracts as $contract)
                            <tr class="contract-row" onclick="viewContract({{ $contract->id }})">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            {{ strtoupper(substr($contract->driver->user->name ?? 'N/A', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $contract->driver->user->name ?? 'N/A' }}</div>
                                            <div class="small text-muted">ID: {{ $contract->driver_id ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $contract->motorbike->model ?? 'N/A' }}</div>
                                    <div class="small text-muted">{{ $contract->motorbike->plate_number ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $contract->sponsor->name ?? 'N/A' }}</div>
                                    <div class="small text-muted">Sponsor</div>
                                </td>
                                <td>
                                    <span class="status-badge {{ $contract->status }}">
                                        <i class="fas fa-circle"></i>
                                        {{ ucfirst($contract->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="amount-positive">Tsh {{ number_format($contract->total_amount ?? 0, 0) }}</span>
                                </td>
                                <td>
                                    <div class="small">{{ $contract->start_date ? \Carbon\Carbon::parse($contract->start_date)->format('M d, Y') : 'N/A' }}</div>
                                    <div class="small text-muted">
                                        @if($contract->end_date)
                                            {{ \Carbon\Carbon::parse($contract->end_date)->diffForHumans() }}
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2" onclick="event.stopPropagation()">
                                        <button class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px;" onclick="viewContractDetails({{ $contract->id }})">
                                            <i class="fas fa-eye fa-xs"></i>
                                        </button>
                                        <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 32px; height: 32px;">
                                            <i class="fas fa-edit fa-xs"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-file-contract"></i>
                                        </div>
                                        <h5 class="fw-bold text-muted mb-2">No Contracts Found</h5>
                                        <p class="text-muted small mb-3">Start by creating your first contract</p>
                                        <a href="{{ route('contracts.create') }}" class="btn btn-gradient-primary">
                                            <i class="fas fa-plus-circle me-2"></i>New Contract
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-modern">
                    <div class="small text-muted">
                        Showing 1 to {{ min(10, count($recentContracts)) }} of {{ count($recentContracts) }} entries
                    </div>
                    <div class="d-flex gap-2">
                        <button class="page-link-modern"><i class="fas fa-chevron-left"></i></button>
                        <button class="page-link-modern active">1</button>
                        <button class="page-link-modern">2</button>
                        <button class="page-link-modern">3</button>
                        <button class="page-link-modern"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Payments Chart
    const ctx1 = document.getElementById('paymentsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Monthly Payments (Tsh)',
                data: {!! json_encode($paymentsMonthly) !!},
                borderColor: '#4f46e5',
                backgroundColor: 'rgba(79, 70, 229, 0.05)',
                borderWidth: 3,
                pointBackgroundColor: '#4f46e5',
                pointBorderColor: 'white',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Tsh ' + context.raw.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#e5e7eb' },
                    ticks: {
                        callback: function(value) {
                            return 'Tsh ' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Contract Status Chart
    const ctx2 = document.getElementById('contractsChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Pending', 'Completed'],
            datasets: [{
                data: [
                    {{ $activeContracts }},
                    {{ $pendingContracts }},
                    {{ $completedContracts }}
                ],
                backgroundColor: ['#22c55e', '#eab308', '#4f46e5'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = {{  $totalContracts }};
                            const percentage = ((context.raw / total) * 100).toFixed(1);
                            return `${context.label}: ${context.raw} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Search and Filter Functionality
    document.getElementById('searchInput').addEventListener('keyup', filterTable);
    document.getElementById('statusFilter').addEventListener('change', filterTable);

    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusTerm = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('.contract-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const status = row.querySelector('.status-badge')?.textContent.toLowerCase().trim() || '';
            
            const matchesSearch = text.includes(searchTerm);
            const matchesStatus = !statusTerm || status.includes(statusTerm);
            
            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    // View Contract Function
    window.viewContract = function(id) {
        window.location.href = `/contracts/${id}`;
    };

    window.viewContractDetails = function(id) {
        // You can open a modal or navigate to details
        console.log('View details for contract:', id);
    };

    // Chart buttons interaction
    document.querySelectorAll('.chart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.chart-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // Add your chart data update logic here
        });
    });
</script>

</body>
</html>