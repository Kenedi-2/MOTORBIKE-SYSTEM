<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Motorbike;
use App\Models\Contract;

class ServiceController extends Controller
{
    // Admin: Show all services
    public function index()
    {
        $services = Service::with('motorbike', 'contract')->orderBy('service_date', 'desc')->get();
        return view('services.index', compact('services'));
    }

    // Admin: Show create form
    public function create()
    {
        $motorbikes = Motorbike::all();
        $contracts = Contract::all();
        return view('services.create', compact('motorbikes', 'contracts'));
    }

    // Admin: Store service
    public function store(Request $request)
    {
        $request->validate([
            'motorbike_id' => 'required|exists:motorbikes,id',
            'contract_id' => 'required|exists:contracts,id',
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'service_date' => 'required|date',
        ]);

        $service = Service::create([
            'motorbike_id' => $request->motorbike_id,
            'contract_id' => $request->contract_id,
            'description' => $request->description,
            'cost' => $request->cost,
            'service_date' => $request->service_date,
        ]);

        // Update contract total amount and remaining amount
        $contract = Contract::findOrFail($request->contract_id);
        $contract->total_amount += $request->cost;
        $contract->remaining_amount += $request->cost;

        // Recalculate end date based on new total and daily amount
        $totalPaid = $contract->payments()->sum('amount');
        $daysPaid = ceil($totalPaid / $contract->daily_amount);
        $contract->end_date = \Carbon\Carbon::parse($contract->start_date)->addDays($daysPaid);

        $contract->save();

        return redirect()->route('services.index')->with('success', 'Service added and contract updated.');
    }

    // Admin: Delete service
    public function destroy(Service $service)
    {
        $contract = $service->contract;

        // Deduct service cost from contract
        $contract->total_amount -= $service->cost;
        $contract->remaining_amount = max($contract->total_amount - $contract->payments()->sum('amount'), 0);

        // Recalculate end date
        $totalPaid = $contract->payments()->sum('amount');
        $daysPaid = ceil($totalPaid / $contract->daily_amount);
        $contract->end_date = \Carbon\Carbon::parse($contract->start_date)->addDays($daysPaid);
        $contract->save();

        $service->delete();

        return back()->with('success', 'Service deleted and contract updated.');
    }
}