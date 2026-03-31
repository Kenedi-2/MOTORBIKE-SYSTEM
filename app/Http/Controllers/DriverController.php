<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\User;
use App\Models\Contract;
use Carbon\Carbon;

class DriverController extends Controller
{
    // ===============================
    // Admin: View all drivers
    // ===============================
    public function index()
    {
        $drivers = Driver::with('user')->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    // ===============================
    // Admin: Create driver
    // ===============================
    public function create()
    {
        $users = User::where('role', 'driver')->get();
        return view('drivers.create', compact('users'));
    }

    // ===============================
    // Admin: Store driver
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:drivers',
            'phone' => 'required',
            'license_number' => 'required|unique:drivers',
        ]);

        Driver::create([
            'user_id' => $request->user_id,
            'phone' => $request->phone,
            'license_number' => $request->license_number,
        ]);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver added successfully');
    }

    // ===============================
    // Admin: Edit driver
    // ===============================
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    // ===============================
    // Admin: Update driver
    // ===============================
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'phone' => 'required',
            'license_number' => "required|unique:drivers,license_number,{$driver->id}",
        ]);

        $driver->update([
            'phone' => $request->phone,
            'license_number' => $request->license_number,
        ]);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver updated successfully');
    }

    // ===============================
    // Admin: Delete driver
    // ===============================
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return back()->with('success', 'Driver deleted successfully');
    }

    // ===============================
    // Driver: View contracts
    // ===============================
    public function contract()
    {
        $driver = auth()->user()->driver;

        $contracts = Contract::with([
            'motorbike',
            'sponsor',
            'payments',
            'services'
        ]);

        if ($driver) {
            $contracts = $contracts->where('driver_id', $driver->id);
        }

        $contracts = $contracts->get();

        $message = $driver ? null : 'Your driver profile has not been created yet.';

        return view('drivers.contracts', compact('contracts', 'message'));
    }

    // ===============================
    // Driver Dashboard
    // ===============================
    public function dashboard()
    {
        $driver = auth()->user()->driver;

        if (!$driver) {
            return view('drivers.dashboard', [
                'contracts' => collect(),
                'message' => 'Your driver profile has not been created yet.'
            ]);
        }

        $contracts = Contract::with([
                'motorbike',
                'sponsor',
                'payments',
                'services'
            ])
            ->where('driver_id', $driver->id)
            ->get();

        foreach ($contracts as $contract) {
            $paidAmount = $contract->payments->sum('amount') ?? 0;

            // Remaining balance
            $contract->remaining_amount = max($contract->total_amount - $paidAmount, 0);

            // Automatically mark as finished if fully paid
            if ($contract->remaining_amount == 0 && $contract->status !== 'finished') {
                $contract->status = 'finished';
                $contract->save();
            }

            // Payment progress %
            $contract->progress = $contract->total_amount > 0
                ? ($paidAmount / $contract->total_amount) * 100
                : 0;

            // Overdue detection
            if ($contract->daily_amount > 0) {
                $expectedDaysPaid = intval($paidAmount / $contract->daily_amount);
                $actualDays = Carbon::now()->diffInDays($contract->start_date);
                $contract->overdue = $actualDays > $expectedDaysPaid && $contract->status !== 'finished';
            } else {
                $contract->overdue = false;
            }
        }

        return view('drivers.dashboard', compact('contracts'));
    }
}