<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Payment Management System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
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

        /* Modern Card Styles */
        .modern-card { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border:none; border-radius:20px; box-shadow:0 8px 32px rgba(0,0,0,0.08); transition: all 0.3s cubic-bezier(0.4,0,0.2,1); overflow:hidden; }
        .modern-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }

        /* Stat Cards */
        .stat-card { background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); border-radius:20px; padding:1.5rem; position:relative; overflow:hidden; transition: all 0.3s ease; border:1px solid rgba(0,0,0,0.05); }
        .stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg, #4f46e5, #7c3aed); }
        .stat-card:hover { transform: translateY(-5px); box-shadow:0 12px 24px rgba(0,0,0,0.1); }
        .stat-icon { width:48px; height:48px; border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; margin-bottom:1rem; }
        .stat-value { font-size:2rem; font-weight:800; margin-bottom:0.25rem; line-height:1.2; }
        .stat-label { color:#6c757d; font-size:0.875rem; font-weight:500; text-transform:uppercase; letter-spacing:0.5px; }

        /* Alert Styles */
        .modern-alert { border:none; border-radius:16px; padding:1rem 1.5rem; margin-bottom:1.5rem; animation: slideInDown 0.4s ease-out; }
        @keyframes slideInDown { from { opacity:0; transform:translateY(-20px); } to { opacity:1; transform:translateY(0); } }

        /* Contract Card */
        .contract-card { background:white; border-radius:24px; overflow:hidden; margin-bottom:2rem; transition: all 0.3s ease; box-shadow:0 4px 6px rgba(0,0,0,0.07); }
        .contract-card:hover { box-shadow:0 20px 40px rgba(0,0,0,0.1); }
        .contract-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding:1.5rem 2rem; color:white; }
        .contract-badge { background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); padding:0.5rem 1rem; border-radius:12px; font-size:0.875rem; font-weight:600; }

        /* Progress Bar */
        .progress-modern { background:#e9ecef; border-radius:12px; height:8px; overflow:hidden; }
        .progress-bar-modern { background: linear-gradient(90deg, #10b981, #059669); border-radius:12px; transition: width 0.6s ease; }

        /* Form Controls */
        .form-control-modern, .form-select-modern { border:2px solid #e9ecef; border-radius:12px; padding:0.75rem 1rem; font-size:0.875rem; transition: all 0.3s ease; width:100%; min-height:44px; }
        .form-control-modern:focus, .form-select-modern:focus { border-color:#667eea; box-shadow:0 0 0 4px rgba(102,126,234,0.1); outline:none; }

        /* Buttons */
        .btn-modern { border:none; border-radius:12px; padding:0.75rem 1.5rem; font-weight:600; transition: all 0.3s ease; position:relative; overflow:hidden; }
        .btn-modern::before { content:''; position:absolute; top:50%; left:50%; width:0; height:0; border-radius:50%; background: rgba(255,255,255,0.3); transform:translate(-50%,-50%); transition: width 0.6s, height 0.6s; pointer-events:none; }
        .btn-modern:hover::before { width:300px; height:300px; }
        .btn-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:white; }
        .btn-gradient-primary:hover { transform: translateY(-2px); box-shadow:0 8px 20px rgba(102,126,234,0.3); color:white; }

        /* Payment History Items */
        .payment-item { background:#f8f9fa; border-radius:16px; padding:1rem; transition: all 0.3s ease; border:1px solid #e9ecef; }
        .payment-item:hover { background:white; border-color:#667eea; transform:translateX(4px); box-shadow:0 4px 12px rgba(0,0,0,0.05); }

        /* Empty State */
        .empty-state { text-align:center; padding:4rem 2rem; background:#f8f9fa; border-radius:24px; }
        .empty-state-icon { width:80px; height:80px; background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:1.5rem; }
        .empty-state-icon i { font-size:2.5rem; color:#adb5bd; }

        /* Animations */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        .animate-fadeInUp { animation: fadeInUp 0.5s ease-out; }

        /* Scrollbar */
        ::-webkit-scrollbar { width:8px; height:8px; }
        ::-webkit-scrollbar-track { background:#f1f1f1; border-radius:10px; }
        ::-webkit-scrollbar-thumb { background:#cbd5e0; border-radius:10px; }
        ::-webkit-scrollbar-thumb:hover { background:#a0aec0; }

        /* Responsive */
        @media(max-width:768px) {
            .stat-value { font-size:1.5rem; }
            .contract-header { padding:1rem; }
            .btn-modern { padding:0.5rem 1rem; }
        }
    </style>
</head>
<body>
<x-app-layout>
    @php $contracts = $contracts ?? collect([]); @endphp

    <div class="container-fluid py-4 py-lg-5">
        <div class="container px-4 px-lg-5">

            <!-- Messages -->
            @if(session('success'))
            <div class="modern-alert bg-success bg-opacity-10 border-start border-4 border-success animate-fadeInUp">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle text-success fa-lg me-3"></i>
                    <p class="mb-0 text-success fw-semibold">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="modern-alert bg-danger bg-opacity-10 border-start border-4 border-danger animate-fadeInUp">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle text-danger fa-lg me-3"></i>
                    <p class="mb-0 text-danger fw-semibold">{{ $errors->first() }}</p>
                </div>
            </div>
            @endif

            @if(isset($message))
            <div class="modern-alert bg-warning bg-opacity-10 border-start border-4 border-warning animate-fadeInUp">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-warning fa-lg me-3"></i>
                    <p class="mb-0 text-warning fw-semibold">{{ $message }}</p>
                </div>
            </div>
            @endif

            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-6 col-lg-3 animate-fadeInUp" style="animation-delay:0.1s">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg,#e0e7ff 0%,#c7d2fe 100%);">
                            <i class="fas fa-file-contract text-primary"></i>
                        </div>
                        <div class="stat-value">{{ $contracts->count() }}</div>
                        <div class="stat-label">Total Contracts</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 animate-fadeInUp" style="animation-delay:0.2s">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg,#dcfce7 0%,#bbf7d0 100%);">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="stat-value text-success">{{ $contracts->where('status','finished')->count() }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 animate-fadeInUp" style="animation-delay:0.3s">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg,#dbeafe 0%,#bfdbfe 100%);">
                            <i class="fas fa-money-bill-wave text-info"></i>
                        </div>
                        <div class="stat-value text-info">TZS {{ number_format($contracts->sum('total_paid'),0) }}</div>
                        <div class="stat-label">Total Paid</div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 animate-fadeInUp" style="animation-delay:0.4s">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg,#fee2e2 0%,#fecaca 100%);">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div class="stat-value text-danger">{{ $contracts->where('overdue',true)->count() }}</div>
                        <div class="stat-label">Overdue</div>
                    </div>
                </div>
            </div>

            <!-- Contracts -->
          @forelse($contracts as $contract)
    <div class="contract-card animate-fadeInUp">
    <div class="contract-header">
             <div class="row align-items-center">
            <div class="col-md-8 mb-3 mb-md-0 d-flex align-items-center gap-3 flex-wrap">
                <i class="fas fa-motorcycle fa-2x"></i>
                <div>
                    <h3 class="fw-bold mb-1">{{ optional($contract->motorbike)->plate_number ?? 'No Plate' }}</h3>
                    <p class="mb-0 opacity-75"><i class="fas fa-tag me-1"></i> {{ optional($contract->motorbike)->model ?? 'Unknown Model' }}</p>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                @if($contract->status === 'completed')
                    <span class="contract-badge bg-success bg-opacity-25 text-success">
                        <i class="fas fa-check-circle me-1"></i> Completed
                    </span>
                @elseif(!empty($contract->overdue))
                    <span class="contract-badge bg-danger bg-opacity-25 text-danger">
                        <i class="fas fa-clock me-1"></i> Overdue
                    </span>
                @endif
            </div>
        </div>
    </div>

                <div class="p-4 p-lg-5">
                    <!-- Sponsor -->
                    <div class="mb-4 d-flex align-items-center gap-2">
                    <i class="fas fa-user-circle text-muted"></i>
                    <span class="text-muted">Sponsor:</span>
                    <span class="fw-semibold">{{ optional($contract->sponsor)->name ?? 'Not Assigned' }}</span>
                </div>

                    <!-- Payment Summary -->
            @php
            $paidAmount = $contract->payments->sum('amount');
            $progress = $contract->total_amount > 0 ? ($paidAmount / $contract->total_amount) * 100 : 0;
            @endphp
        <div class="row g-3 mb-4">
            <div class="col-md-4 text-center bg-light rounded-4 p-3">
                <p class="text-muted mb-1 small">Total Amount</p>
                <h4 class="fw-bold mb-0">TZS {{ number_format($contract->total_amount ?? 0,2) }}</h4>
            </div>
            <div class="col-md-4 text-center bg-success bg-opacity-10 rounded-4 p-3 border border-success border-opacity-25">
                <p class="text-success mb-1 small">Paid Amount</p>
                <h4 class="fw-bold text-success mb-0">
                    TZS {{ number_format($paidAmount, 2) }}
                </h4>
            </div>
            <div class="col-md-4 text-center bg-danger bg-opacity-10 rounded-4 p-3 border border-danger border-opacity-25">
                <p class="text-danger mb-1 small">Remaining</p>
                <h4 class="fw-bold text-danger mb-0">TZS {{ number_format(max($contract->total_amount - $paidAmount,0),2) }}</h4>
            </div>
        </div>

                    <!-- Progress Bar -->
                     <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-semibold text-muted">Payment Progress</span>
                            <span class="small fw-bold text-success">{{ round(min($progress,100),2) }}%</span>
                        </div>
                    <div class="progress-modern">
                <div class="progress-bar-modern" style="width: {{ min($progress,100) }}%"></div>
            </div>
        </div>

                    <!-- Contract Dates -->
                      <div class="d-flex flex-wrap gap-4 mb-4 p-3 bg-light rounded-4">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-calendar-alt text-primary"></i>
                <span class="small">Start: <strong>{{ $contract->start_date ?? 'N/A' }}</strong></span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-calendar-check text-primary"></i>
                <span class="small">End: <strong>{{ $contract->end_date ?? 'N/A' }}</strong></span>
            </div>
        </div>

                    <!-- Payment Form -->
                    @if(optional(auth()->user()->driver)->id)
                    <div class="border-top pt-4 mt-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-credit-card me-2 text-primary"></i> Submit New Payment</h5>
                        <form method="POST" action="{{ route('drivers.payment.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="contract_id" value="{{ $contract->id }}">
                            <input type="hidden" name="driver_id" value="{{ auth()->user()->driver->id }}">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0 rounded-3">TZS</span>
                                        <input type="number" name="amount" class="form-control-modern" placeholder="Enter amount" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-semibold">Payment Date</label>
                                    <input type="date" name="payment_date" class="form-control-modern" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Receipt Image</label>
                                    <input type="file" name="payment_image" class="form-control-modern" accept="image/*">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-modern btn-gradient-primary w-100">
                                        <i class="fas fa-paper-plane me-2"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Payment History -->
                    <div class="border-top pt-4 mt-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-history me-2 text-primary"></i> Payment History</h5>

                        @if($contract->payments->isEmpty())
                        <div class="empty-state py-4">
                            <div class="empty-state-icon">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <p class="text-muted mb-0">No payments recorded yet</p>
                        </div>
                        @else
                        <div class="row g-3">
                            @foreach($contract->payments as $payment)
                            <div class="col-12">
                                <div class="payment-item d-flex flex-wrap justify-content-between align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-white rounded-circle p-2 shadow-sm">
                                            <i class="fas fa-check-circle text-success fa-lg"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-0">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</p>
                                            <p class="small text-muted mb-0">TZS {{ number_format($payment->amount,2) }}</p>
                                        </div>
                                    </div>
                                    @if($payment->payment_image)
                                    <a href="{{ asset('storage/'.$payment->payment_image) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="fas fa-eye me-1"></i> View Receipt
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state animate-fadeInUp">
                <div class="empty-state-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h4 class="fw-bold text-muted mb-2">No Contracts Found</h4>
                <p class="text-muted mb-0">You don't have any active contracts at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = { threshold:0.1, rootMargin:'0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.style.opacity='1';
                entry.target.style.transform='translateY(0)';
                obs.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-fadeInUp').forEach(el => {
        el.style.opacity='0';
        el.style.transform='translateY(30px)';
        el.style.transition='opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });
});
</script>
</body>
</html>