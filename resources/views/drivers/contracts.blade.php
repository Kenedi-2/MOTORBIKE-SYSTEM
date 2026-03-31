<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>FleetPulse | Driver Contract Dashboard</title>
    
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

        /* Header Styles */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
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

        .status-badge.overdue {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #b91c1c;
        }

        .status-badge.completed {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        /* Progress Bar */
        .progress-modern {
            background: var(--gray-200);
            border-radius: 12px;
            height: 6px;
            overflow: hidden;
        }

        .progress-bar-modern {
            background: linear-gradient(90deg, var(--success-500), var(--success-600));
            border-radius: 12px;
            transition: width 0.6s ease;
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

        /* Buttons */
        .btn-gradient-primary {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: white;
            border: none;
            border-radius: 16px;
            padding: 0.625rem 1.5rem;
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
            padding: 0.625rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            background: white;
        }

        .btn-outline-modern:hover {
            border-color: var(--primary-500);
            background: var(--primary-50);
            transform: translateY(-2px);
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

    <!-- Modern Navbar -->
    <nav class="navbar-modern sticky-top">
        <div class="container py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('drivers.dashboard') }}" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>             
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4 py-lg-5">
        <div class="container px-4 px-lg-5">
            
            @php
                $contractsCollection = collect($contracts ?? []);
                $totalContracts = $contractsCollection->count();
                $totalAmountSum = $contractsCollection->sum('total_amount');
                $totalPaidSum = 0;
                $overdueCount = 0;
                $activeCount = 0;
                foreach($contractsCollection as $c) {
                    $paid = optional($c->payments)->sum('amount') ?? 0;
                    $totalPaidSum += $paid;
                    $remainingContract = max($c->total_amount - $paid, 0);
                    $daily = $c->daily_amount ?? 0;
                    $expectedDaysPaid = $daily > 0 ? intval($paid / $daily) : 0;
                    $actualDays = \Carbon\Carbon::now()->diffInDays($c->start_date);
                    if($actualDays > $expectedDaysPaid && $c->status != 'finished') $overdueCount++;
                    if($c->status == 'active') $activeCount++;
                }
                $completionRate = $totalAmountSum > 0 ? ($totalPaidSum / $totalAmountSum) * 100 : 0;
            @endphp

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Total Contracts</p>
                                <h3 class="stat-value mb-0">{{ $totalContracts }}</h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe);">
                                <i class="fas fa-file-signature text-primary fa-2x"></i>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="fas fa-check-circle me-1"></i>{{ $activeCount }} active
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Total Financed</p>
                                <h3 class="stat-value mb-0">Tsh {{ number_format($totalAmountSum, 0) }}</h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0);">
                                <i class="fas fa-chart-line text-success fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Contract value</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Total Paid</p>
                                <h3 class="stat-value text-primary mb-0">Tsh {{ number_format($totalPaidSum, 0) }}</h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                                <i class="fas fa-wallet text-primary fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Cumulative payments</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted small mb-1">Overdue Alerts</p>
                                <h3 class="stat-value text-danger mb-0">{{ $overdueCount }}</h3>
                            </div>
                            <div class="stat-icon" style="background: linear-gradient(135deg, #fee2e2, #fecaca);">
                                <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">Requires attention</p>
                    </div>
                </div>
            </div>

            <!-- Contracts Table -->
            <div class="modern-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 p-4 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-table-list text-primary"></i>
                        <h5 class="fw-bold mb-0">Active & Completed Contracts</h5>
                        <span class="badge bg-secondary rounded-pill">{{ $totalContracts }} records</span>
                    </div>
                    <div class="search-box" style="width: 280px;">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search plate or sponsor...">
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="modern-table table" id="contractsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Motorbike</th>
                                    <th>Sponsor</th>
                                    <th>Timeline</th>
                                    <th class="text-end">Amount / Paid</th>
                                    <th>Progress</th>
                                    <th class="text-center">Status</th>
                              
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contracts as $contract)
                                    @php
                                        $totalPaid = optional($contract->payments)->sum('amount') ?? 0;
                                        $remaining = max($contract->total_amount - $totalPaid, 0);
                                        $progress = $contract->total_amount > 0 ? ($totalPaid / $contract->total_amount) * 100 : 0;
                                        $expectedDaysPaid = ($contract->daily_amount ?? 0) > 0 ? intval($totalPaid / $contract->daily_amount) : 0;
                                        $actualDays = \Carbon\Carbon::now()->diffInDays($contract->start_date);
                                        $overdue = ($actualDays > $expectedDaysPaid) && $contract->status !== 'finished';
                                        $statusBadge = $contract->status == 'finished' ? 'completed' : ($overdue ? 'overdue' : 'active');
                                        $progressRounded = round($progress, 1);
                                    @endphp
                                    <tr data-searchable="{{ strtolower($contract->motorbike->plate_number ?? '') }} {{ strtolower($contract->motorbike->model ?? '') }} {{ strtolower($contract->sponsor->name ?? '') }}">
                                        <td class="text-muted small font-monospace">#{{ $contract->id }}</td>
                                        <td>
                                            <div>
                                                <div class="fw-semibold">{{ $contract->motorbike->plate_number ?? '—' }}</div>
                                                <div class="small text-muted">{{ $contract->motorbike->model ?? 'Unknown model' }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class="fas fa-user-tie text-muted small"></i>
                                                <span>{{ $contract->sponsor->name ?? 'Not assigned' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="small"><i class="far fa-calendar-alt me-1 text-muted"></i> {{ $contract->start_date }}</div>
                                                <div class="small text-muted">{{ $contract->end_date ? '→ '.$contract->end_date : 'Ongoing' }}</div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="fw-bold">Tsh {{ number_format($contract->total_amount, 0) }}</div>
                                            <div class="small text-success">Paid: Tsh {{ number_format($totalPaid, 0) }}</div>
                                            <div class="small text-warning">Remaining: Tsh {{ number_format($remaining, 0) }}</div>
                                        </td>
                                        <td style="min-width: 120px;">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="flex-grow-1">
                                                    <div class="progress-modern">
                                                        <div class="progress-bar-modern" style="width: {{ $progressRounded }}%"></div>
                                                    </div>
                                                </div>
                                                <span class="small fw-medium text-muted">{{ $progressRounded }}%</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($contract->status == 'finished')
                                                <span class="status-badge completed">
                                                    <i class="fas fa-check-circle"></i> Completed
                                                </span>
                                            @elseif($overdue)
                                                <span class="status-badge overdue">
                                                    <i class="fas fa-hourglass-half"></i> Overdue
                                                </span>
                                            @else
                                                <span class="status-badge active">
                                                    <i class="fas fa-play"></i> Active
                                                </span>
                                            @endif
                                        </td>
                                       
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="empty-state-icon mx-auto mb-3">
                                                    <i class="fas fa-file-contract fa-3x text-muted"></i>
                                                </div>
                                                <h6 class="fw-bold text-muted mb-2">No Contracts Assigned</h6>
                                                <p class="small text-muted mb-0">Once contracts are linked, they will appear here.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-light bg-opacity-50 px-4 py-3 border-top d-flex justify-content-between align-items-center">
                    <span class="small text-muted">
                        <i class="fas fa-chart-simple me-1"></i> Real-time payment tracking
                    </span>
                    <span class="small text-muted">
                        <i class="fas fa-shield-alt me-1"></i> Secure uploads
                    </span>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center text-muted small border-top bg-white bg-opacity-50">
        <div class="container">
            &copy; {{ date('Y') }} FleetPulse — Intelligent driver contract hub • payments & compliance
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Payment Modal -->
    <div class="modal fade modal-modern" id="paymentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-receipt text-primary me-2"></i>Submit Payment
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="paymentForm" method="POST" action="{{ route('drivers.payment.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="contract_id" id="modalContractId">
                        <input type="hidden" name="driver_id" value="{{ optional(auth()->user()->driver)->id ?? '' }}">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Contract Reference</label>
                            <div class="bg-light rounded-3 p-3 small font-monospace" id="contractLabel">-</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Amount *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">Tsh</span>
                                <input type="number" step="0.01" name="amount" required class="form-control rounded-3" placeholder="0.00">
                            </div>
                            <div class="form-text small text-muted">Remaining balance will be updated after approval</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Payment Date *</label>
                            <input type="date" name="payment_date" required class="form-control rounded-3">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Payment Proof</label>
                            <input type="file" name="payment_image" accept="image/*" class="form-control rounded-3">
                            <div class="form-text small text-muted">Upload receipt or payment confirmation</div>
                        </div>
                        
                        <div class="d-flex gap-3 mt-4">
                            <button type="button" class="btn btn-outline-secondary flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-gradient-primary flex-grow-1">
                                <i class="fas fa-paper-plane me-2"></i>Confirm Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let paymentModal = null;
        
        document.addEventListener('DOMContentLoaded', function() {
            paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            
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
            const rows = document.querySelectorAll('#contractsTable tbody tr');
            
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    let visibleCount = 0;
                    
                    rows.forEach(row => {
                        const searchableText = row.getAttribute('data-searchable') || row.textContent.toLowerCase();
                        if (searchableText.includes(searchTerm)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Show empty state if no results
                    const tbody = document.querySelector('#contractsTable tbody');
                    const existingEmptyRow = tbody.querySelector('.empty-search-row');
                    
                    if (visibleCount === 0 && rows.length > 0 && !existingEmptyRow) {
                        const emptyRow = document.createElement('tr');
                        emptyRow.className = 'empty-search-row';
                        emptyRow.innerHTML = `
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <h6 class="fw-bold text-muted mb-2">No Results Found</h6>
                                    <p class="small text-muted mb-0">No contracts match your search criteria</p>
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
        
        // Open Payment Modal
        window.openPaymentModal = function(contractId, bikeLabel, remaining) {
            document.getElementById('modalContractId').value = contractId;
            document.getElementById('contractLabel').innerHTML = `
                <i class="fas fa-motorcycle me-2 text-primary"></i>
                ${bikeLabel} (ID: ${contractId})<br>
                <span class="small text-muted">Remaining: Tsh ${parseFloat(remaining).toFixed(2)}</span>
            `;
            paymentModal.show();
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
        @if(session('success'))
        showToast('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
        showToast('{{ session('error') }}', 'error');
        @endif
        
        // Keyboard Shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('searchInput')?.focus();
            }
        });
    </script>
</body>
</html>