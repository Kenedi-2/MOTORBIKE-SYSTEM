<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Management - Payment System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
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
        
        .modern-card:hover {
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.12);
        }
        
        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 2rem 2rem;
        }
        
        /* Button Styles */
        .btn-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 0.75rem 1.75rem;
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
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-gradient-primary:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        /* Table Styles */
        .modern-table {
            margin: 0;
        }
        
        .modern-table thead {
            background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        }
        
        .modern-table thead th {
            padding: 1.25rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6c757d;
            border-bottom: 2px solid #e9ecef;
        }
        
        .modern-table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f3f5;
        }
        
        .modern-table tbody tr:hover {
            background: linear-gradient(90deg, #f8f9fa 0%, #ffffff 100%);
            transform: translateX(4px);
        }
        
        .modern-table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            font-size: 0.875rem;
        }
        
        /* Driver Avatar */
        .driver-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            margin-right: 0.75rem;
        }
        
        /* Amount Badge */
        .amount-badge {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-weight: 700;
            display: inline-block;
            font-size: 0.875rem;
        }
        
        /* Date Badge */
        .date-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.875rem;
            display: inline-block;
        }
        
        /* Receipt Image */
        .receipt-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .receipt-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }
        
        .empty-state-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            animation: float 3s ease-in-out infinite;
        }
        
        .empty-state-icon i {
            font-size: 3rem;
            color: #94a3b8;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        /* Search and Filter Section */
        .search-section {
            background: white;
            padding: 1.25rem 2rem;
            border-bottom: 1px solid #e9ecef;
        }
        
        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 14px;
            padding: 0.625rem 1rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        .filter-select {
            border: 2px solid #e9ecef;
            border-radius: 14px;
            padding: 0.625rem 2rem 0.625rem 1rem;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        /* Pagination */
        .pagination-modern {
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .pagination-modern .page-link {
            border: none;
            border-radius: 12px;
            margin: 0 0.25rem;
            padding: 0.5rem 1rem;
            color: #4b5563;
            transition: all 0.2s ease;
        }
        
        .pagination-modern .page-link:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        
        .pagination-modern .active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        /* Animations */
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
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.25rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .modern-table thead th {
                padding: 0.75rem 1rem;
                font-size: 0.7rem;
            }
            
            .modern-table tbody td {
                padding: 0.75rem 1rem;
            }
            
            .driver-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
</head>
<body>

<x-app-layout>
    <div class="container-fluid py-4 py-lg-5">
        <div class="container px-4 px-lg-5">
            
            <!-- Statistics Cards -->
            <div class="row g-4 mb-5 animate-fadeInUp">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-chart-line text-primary fa-lg"></i>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Total</span>
                        </div>
                        <h3 class="fw-bold mb-0">{{ $payments->count() }}</h3>
                        <p class="text-muted small mb-0">Total Payments</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-success bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-money-bill-wave text-success fa-lg"></i>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Amount</span>
                        </div>
                        <h3 class="fw-bold text-success mb-0">TZS {{ number_format($payments->sum('amount'), 0) }}</h3>
                        <p class="text-muted small mb-0">Total Amount</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-chart-simple text-info fa-lg"></i>
                            </div>
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1">Average</span>
                        </div>
                        <h3 class="fw-bold text-info mb-0">TZS {{ number_format($payments->avg('amount') ?? 0, 0) }}</h3>
                        <p class="text-muted small mb-0">Average Payment</p>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-calendar-week text-warning fa-lg"></i>
                            </div>
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-1">This Month</span>
                        </div>
                        <h3 class="fw-bold text-warning mb-0">{{ $payments->whereBetween('payment_date', [now()->startOfMonth(), now()->endOfMonth()])->count() }}</h3>
                        <p class="text-muted small mb-0">Payments This Month</p>
                    </div>
                </div>
            </div>
            
            <!-- Main Card -->
            <div class="modern-card animate-fadeInUp">
                <!-- Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-gradient-primary bg-opacity-10 rounded-3 p-3" style="background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%);">
                                    <i class="fas fa-money-bill-wave text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h2 class="fw-bold mb-1" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                        Payments Management
                                    </h2>
                                    <p class="text-muted mb-0">Track and manage all payment transactions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <a href="{{ route('payments.create') }}" class="btn btn-gradient-primary">
                                <i class="fas fa-plus-circle me-2"></i>
                                Add New Payment
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Search and Filter Section -->
                <div class="search-section">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input type="text" 
                                       id="searchInput"
                                       placeholder="Search by driver, motorbike or amount..." 
                                       class="search-input w-100 ps-5">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="filterDate" class="filter-select w-100">
                                <option value="all">All Time</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="sortBy" class="filter-select w-100">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="highest">Highest Amount</option>
                                <option value="lowest">Lowest Amount</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Table -->
                <div class="table-responsive">
                    <table class="modern-table table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>Driver</th>
                                <th><i class="fas fa-motorcycle me-2"></i>Motorbike</th>
                                <th><i class="fas fa-coins me-2"></i>Amount</th>
                                <th><i class="fas fa-calendar me-2"></i>Payment Date</th>
                                <th class="text-center"><i class="fas fa-receipt me-2"></i>Receipt</th>
                            </tr>
                        </thead>
                        <tbody id="paymentsTableBody">
                            @forelse($payments as $payment)
                            <tr class="payment-row" data-date="{{ $payment->payment_date }}" data-amount="{{ $payment->amount }}">
                                <!-- Driver -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="driver-avatar">
                                            {{ strtoupper(substr($payment->driver->user->name ?? 'N', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-gray-800">
                                                {{ $payment->driver->user->name ?? 'N/A' }}
                                            </div>
                                            <div class="small text-muted">
                                                ID: {{ $payment->driver->id ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Motorbike -->
                                <td>
                                    <div>
                                        <div class="fw-semibold">
                                            {{ $payment->contract->motorbike->plate_number ?? 'N/A' }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ $payment->contract->motorbike->model ?? '' }}
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Amount -->
                                <td>
                                    <span class="amount-badge">
                                        <i class="fas fa-taka me-1"></i>
                                        TZS {{ number_format($payment->amount, 2) }}
                                    </span>
                                </td>
                                
                                <!-- Date -->
                                <td>
                                    <span class="date-badge">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}
                                    </span>
                                    <div class="small text-muted mt-1">
                                        {{ \Carbon\Carbon::parse($payment->payment_date)->diffForHumans() }}
                                    </div>
                                </td>
                                
                                <!-- Receipt -->
                                <td class="text-center">
                                    @if($payment->payment_image)
                                        <a href="{{ asset('storage/'.$payment->payment_image) }}" 
                                           target="_blank"
                                           class="d-inline-block">
                                            <img src="{{ asset('storage/'.$payment->payment_image) }}"
                                                 class="receipt-thumb"
                                                 alt="Receipt">
                                        </a>
                                    @else
                                        <span class="text-muted">
                                            <i class="far fa-image fa-lg"></i>
                                            <div class="small">No receipt</div>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                        <h4 class="fw-bold text-muted mb-2">No Payments Found</h4>
                                        <p class="text-muted mb-3">Start by adding your first payment record</p>
                                        <a href="{{ route('payments.create') }}" class="btn btn-gradient-primary">
                                            <i class="fas fa-plus-circle me-2"></i>
                                            Add Payment
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($payments->hasPages())
                <div class="pagination-modern">
                    {{ $payments->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const filterDate = document.getElementById('filterDate');
        const sortBy = document.getElementById('sortBy');
        const tbody = document.getElementById('paymentsTableBody');
        let rows = Array.from(document.querySelectorAll('.payment-row'));
        
        function filterAndSort() {
            const searchTerm = searchInput?.value.toLowerCase() || '';
            const dateFilter = filterDate?.value || 'all';
            const sortOption = sortBy?.value || 'newest';
            
            // Filter rows
            let filteredRows = rows.filter(row => {
                const text = row.textContent.toLowerCase();
                const dateText = row.querySelector('td:nth-child(4) .date-badge')?.textContent || '';
                const paymentDate = new Date(dateText);
                const today = new Date();
                const currentMonth = today.getMonth();
                const currentYear = today.getFullYear();
                
                let showByDate = true;
                switch(dateFilter) {
                    case 'today':
                        showByDate = paymentDate.toDateString() === today.toDateString();
                        break;
                    case 'week':
                        const weekAgo = new Date();
                        weekAgo.setDate(today.getDate() - 7);
                        showByDate = paymentDate >= weekAgo;
                        break;
                    case 'month':
                        showByDate = paymentDate.getMonth() === currentMonth && paymentDate.getFullYear() === currentYear;
                        break;
                    case 'year':
                        showByDate = paymentDate.getFullYear() === currentYear;
                        break;
                    default:
                        showByDate = true;
                }
                
                return text.includes(searchTerm) && showByDate;
            });
            
            // Sort rows
            filteredRows.sort((a, b) => {
                const aAmount = parseFloat(a.getAttribute('data-amount') || 0);
                const bAmount = parseFloat(b.getAttribute('data-amount') || 0);
                const aDate = new Date(a.getAttribute('data-date') || 0);
                const bDate = new Date(b.getAttribute('data-date') || 0);
                
                switch(sortOption) {
                    case 'oldest':
                        return aDate - bDate;
                    case 'highest':
                        return bAmount - aAmount;
                    case 'lowest':
                        return aAmount - bAmount;
                    default: // newest
                        return bDate - aDate;
                }
            });
            
            // Update table
            tbody.innerHTML = '';
            if (filteredRows.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5">
                            <div class="empty-state py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="fas fa-search"></i>
                                </div>
                                <p class="text-muted mb-0">No payments match your search criteria</p>
                            </div>
                        </td>
                    </tr>
                `;
            } else {
                filteredRows.forEach(row => tbody.appendChild(row));
            }
        }
        
        // Add event listeners
        if (searchInput) searchInput.addEventListener('keyup', filterAndSort);
        if (filterDate) filterDate.addEventListener('change', filterAndSort);
        if (sortBy) sortBy.addEventListener('change', filterAndSort);
        
        // Add fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-fadeInUp').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    });
</script>

</body>
</html>