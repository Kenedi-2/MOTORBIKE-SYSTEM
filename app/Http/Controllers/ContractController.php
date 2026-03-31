<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Motorbike;
use Carbon\Carbon;

class ContractController extends Controller
{
    // List all contracts
    public function index()
    {
        $contracts = Contract::with('motorbike','driver','sponsor','payments')->get();
        return view('contracts.index', compact('contracts'));
    }

    // Show create contract form
    public function create()
    {
        $motorbikes = Motorbike::where('status','available')->get();
        $drivers = \App\Models\Driver::all();
        $sponsors = \App\Models\Sponsor::all();
        return view('contracts.create', compact('motorbikes','drivers','sponsors'));
    }

    // Store new contract
    public function store(Request $request)
{
    $request->validate([
        'motorbike_id' => 'required|exists:motorbikes,id',
        'driver_id' => 'required|exists:drivers,id',
        'sponsor_id' => 'required|exists:sponsors,id',
        'start_date' => 'required|date',
        'daily_amount' => 'required|numeric|min:1',
        'total_amount' => 'required|numeric|min:0',
    ]);

    // Sum of service amounts if any (optional: services may be added later)
    $serviceTotal = 0; // initially 0

    // New total including services
    $totalAmount = $request->total_amount + $serviceTotal;

    $days = $totalAmount / $request->daily_amount;
    $endDate = Carbon::parse($request->start_date)->addDays($days);

    $status = 'active';
    $motorbikeStatus = 'contracted';
    $remainingAmount = $totalAmount;

    if ($totalAmount <= 0) {
        $status = 'completed';
        $motorbikeStatus = 'own';
        $remainingAmount = 0;
        $endDate = Carbon::now();
    }

    $contract = Contract::create([
        'motorbike_id' => $request->motorbike_id,
        'driver_id' => $request->driver_id,
        'sponsor_id' => $request->sponsor_id,
        'start_date' => $request->start_date,
        'end_date' => $endDate,
        'daily_amount' => $request->daily_amount,
        'total_amount' => $totalAmount, // now includes service
        'remaining_amount' => $remainingAmount,
        'status' => $status
    ]);

    Motorbike::where('id', $request->motorbike_id)->update(['status' => $motorbikeStatus]);

    return redirect()->route('contracts.index')->with('success','Contract created successfully.');
}

    // Show edit contract form
    public function edit(Contract $contract)
    {
        $drivers = \App\Models\Driver::all();
        $motorbikes = \App\Models\Motorbike::all();
        $sponsors = \App\Models\Sponsor::all();

        return view('contracts.edit', compact('contract','drivers','motorbikes','sponsors'));
    }

    // Update contract
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'motorbike_id' => 'required|exists:motorbikes,id',
            'sponsor_id' => 'required|exists:sponsors,id',
            'start_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'daily_amount' => 'required|numeric|min:1',
        ]);

        // Update contract basic info
        $contract->update([
            'driver_id' => $request->driver_id,
            'motorbike_id' => $request->motorbike_id,
            'sponsor_id' => $request->sponsor_id,
            'start_date' => $request->start_date,
            'total_amount' => $request->total_amount,
            'daily_amount' => $request->daily_amount,
        ]);

        // Update contract status and remaining amount
        $this->updateContractStatus($contract);

        return redirect()->route('contracts.index')->with('success','Contract updated successfully.');
    }

    // Delete contract
    public function destroy(Contract $contract)
    {
        if ($contract->motorbike) {
            $contract->motorbike->update(['status' => 'available', 'owner_id' => null]);
        }

        $contract->delete();

        return back()->with('success','Contract deleted');
    }

    /**
     * Update contract status and motorbike
     */
    private function updateContractStatus(Contract $contract)
    {
        $totalPaid = $contract->payments()->sum('amount');
        $contract->remaining_amount = max($contract->total_amount - $totalPaid, 0);

        if ($contract->remaining_amount === 0) {
            $contract->status = 'completed';
            $contract->end_date = Carbon::now();
            if ($contract->motorbike) {
                $contract->motorbike->status = 'own';
                $contract->motorbike->owner_id = $contract->driver_id;
                $contract->motorbike->save();
            }
        } else {
            $contract->status = 'active';
            $daysPaid = ceil($totalPaid / $contract->daily_amount);
            $contract->end_date = Carbon::parse($contract->start_date)->addDays($daysPaid);
            if ($contract->motorbike) {
                $contract->motorbike->status = 'available';
                $contract->motorbike->owner_id = null;
                $contract->motorbike->save();
            }
        }

        $contract->save();
    }
}