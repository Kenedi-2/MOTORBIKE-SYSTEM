<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contract extends Model
{
    protected $fillable = [
        'driver_id',
        'motorbike_id',
        'sponsor_id',
        'total_amount',
        'status',
        'start_date',
        'end_date',
        'daily_amount',
        'remaining_amount',
    
    ];

    // Relationships
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function motorbike()
    {
        return $this->belongsTo(Motorbike::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
   
public function services()
{
    return $this->hasMany(Service::class); // or belongsToMany if pivot table exists
}

    // ✅ Calculate total paid
    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    // ✅ Remaining balance
    public function getRemainingAmountAttribute()
    {
        return max($this->total_amount - $this->total_paid, 0);
    }

    // ✅ Progress %
    public function getProgressAttribute()
    {
        return $this->total_amount > 0
            ? ($this->total_paid / $this->total_amount) * 100
            : 100;
    }

    // ✅ Overdue check
    public function getOverdueAttribute()
    {
        return $this->status === 'active'
            && Carbon::parse($this->end_date)->lt(Carbon::today());
    }

    // ✅ MAIN LOGIC: Auto update contract
    public function updateStatusAutomatically()
    {
        $totalPaid = $this->payments()->sum('amount');

        if ($totalPaid >= $this->total_amount && $this->status !== 'completed') {
            $this->status = 'completed';
            $this->end_date = Carbon::now();
        

            if ($this->motorbike) {
                $this->motorbike->status = 'own';
            }
        }
    }
}