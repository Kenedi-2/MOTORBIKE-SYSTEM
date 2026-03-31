<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motorbike;
use App\Models\Driver;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Sponsor;
use App\Models\Service;
use Carbon\Carbon;
use DB;
use PDF;

class DashboardController extends Controller
{
   public function index()
{
    // Counts
    $bikes = Motorbike::count();
    $drivers = Driver::count();
    $contracts = Contract::count();
    $paymentsCount = Payment::count();
    $paymentsTotal = Payment::sum('amount');
    $sponsors = Sponsor::count();
    $services = Service::count();

    // Recent contracts
    $recentContracts = Contract::with(['driver.user','motorbike','sponsor','payments'])
        ->latest()
        ->take(5)
        ->get();

    // ✅ Ensure status is always correct
    foreach ($recentContracts as $contract) {
        $contract->updateStatusAutomatically();
    }

    // Monthly payments (last 6 months)
    $months = [];
    $paymentsMonthly = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i);

        $months[] = $month->format('M');

        $paymentsMonthly[] = Payment::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->sum('amount');
    }

    // Status counts
    $activeContracts = Contract::where('status','active')->count();
    $pendingContracts = Contract::where('status','pending')->count();
    $completedContracts = Contract::where('status','completed')->count();

    return view('dashboard', compact(
        'bikes',
        'drivers',
        'contracts',
        'paymentsCount',
        'paymentsTotal',
        'sponsors',
        'services',
        'recentContracts',
        'months',
        'paymentsMonthly',
        'activeContracts',
        'pendingContracts',
        'completedContracts'
    ));
}

    // PRINT CONTRACT
    public function printContract($id)
    {
        $contract = Contract::with('driver', 'sponsor', 'motorbike','payments')->findOrFail($id);

        // Calculate progress and remaining amount
        $totalPaid = $contract->payments->sum('amount');
        $contract->remaining_amount = max($contract->total_amount - $totalPaid, 0);
        $contract->progress = $contract->total_amount > 0 ? ($totalPaid / $contract->total_amount) * 100 : 100;

        if($totalPaid >= $contract->total_amount && $contract->status !== 'completed'){
            $contract->status = 'completed';
            $contract->end_date = Carbon::now();
            if($contract->motorbike){
                $contract->motorbike->status = 'own';
            }
        }

        return view('contracts.print', compact('contract'));
    }

    // DOWNLOAD PDF
    public function pdfContract($id)
    {
        $contract = Contract::with('driver', 'sponsor', 'motorbike','payments')->findOrFail($id);

        // Calculate progress and remaining amount
        $totalPaid = $contract->payments->sum('amount');
        $contract->remaining_amount = max($contract->total_amount - $totalPaid, 0);
        $contract->progress = $contract->total_amount > 0 ? ($totalPaid / $contract->total_amount) * 100 : 100;

        if($totalPaid >= $contract->total_amount && $contract->status !== 'completed'){
            $contract->status = 'completed';
            $contract->end_date = Carbon::now();
            if($contract->motorbike){
                $contract->motorbike->status = 'own';
            }
        }

        $pdf = PDF::loadView('contracts.print', compact('contract'));
        return $pdf->download('contract_'.$contract->id.'.pdf');
    }
}