<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\Driver;
use App\Models\Motorbike;
use Carbon\Carbon;

class PaymentController extends Controller
{
    // Admin: List all payments
    public function index()
    {
        $payments = Payment::with('driver', 'contract')->orderBy('payment_date', 'desc')->paginate(100);
        return view('payments.index', compact('payments'));
    }

    // Admin: Show form to create payment
    public function create()
    {
        $contracts = Contract::with('driver')->get();
        $drivers = Driver::all();
        return view('payments.create', compact('contracts', 'drivers'));
    }

    // Admin: Store payment
    public function store(Request $request)
    {
        $request->validate([
            'contract_id'=>'required|exists:contracts,id',
            'driver_id'=>'required|exists:drivers,id',
            'amount'=>'required|numeric|min:0',
            'payment_date'=>'required|date',
            'payment_image'=>'nullable|image'
        ]);

        $image = $request->file('payment_image') ? $request->file('payment_image')->store('payments','public') : null;

        $payment = Payment::create([
            'contract_id'=>$request->contract_id,
            'driver_id'=>$request->driver_id,
            'amount'=>$request->amount,
            'payment_date'=>$request->payment_date,
            'payment_image'=>$image
        ]);

        // Update contract
        $contract = Contract::findOrFail($request->contract_id);
        $totalPaid = $contract->payments()->sum('amount') + $request->amount;
        $contract->remaining_amount = max($contract->total_amount - $totalPaid, 0);

        // Adjust contract end date dynamically
        $daysPaid = ceil($totalPaid / $contract->daily_amount);
        $contract->end_date = Carbon::parse($contract->start_date)->addDays($daysPaid);

        // Mark contract finished if fully paid
        if ($contract->remaining_amount <= 0) {
            $contract->status = 'completed';
            // Update motorbike status
            $motorbike = Motorbike::find($contract->motorbike_id);
            $motorbike->status = 'own';
            $motorbike->save();
        }

      

        return back()->with('success','Payment added and contract updated');
    }

    // Driver: Store payment (calls store method)
    public function storeDriverPayment(Request $request)
    {
        $request->validate([
            'contract_id'=>'required|exists:contracts,id',
            'amount'=>'required|numeric|min:0',
            'payment_date'=>'required|date',
            'payment_image'=>'nullable|image'
        ]);

        $driver = auth()->user()->driver;
        $request->merge(['driver_id' => $driver->id]);

        return $this->store($request);
    }

    // Admin: Delete payment
    public function destroy(Payment $payment)
    {
        $contract = $payment->contract;
        $motorbike = $contract->motorbike;

        $payment->delete();

        // Recalculate contract after deletion
        $totalPaid = $contract->payments()->sum('amount');
        $contract->remaining_amount = max($contract->total_amount - $totalPaid, 0);
        $daysPaid = ceil($totalPaid / $contract->daily_amount);
        $contract->end_date = Carbon::parse($contract->start_date)->addDays($daysPaid);

        // Update contract and motorbike status
       $totalPaid = $contract->payments()->sum('amount');

        $contract->status = $totalPaid == $contract->total_amount ? 'completed' : 'active';
        $motorbike->status = $totalPaid >= $contract->total_amount ? 'own' : 'contracted';

        $motorbike->save();
        $contract->save();

        return back()->with('success','Payment deleted and contract updated');
    }
}