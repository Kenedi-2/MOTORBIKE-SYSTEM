<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'driver_id',
        'amount',
        'payment_date',
        'payment_image',
        // 'status' removed, as payment table does not need it
    ];

    /*
    |-----------------------------------------
    | Relationships
    |-----------------------------------------
    */

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /*
    |-----------------------------------------
    | Model Events
    |-----------------------------------------
    */

    protected static function booted()
    {
        // Automatically update contract status whenever a payment is created or deleted
        static::created(function ($payment) {
            $payment->contract->updateStatusAutomatically();
        });

        static::deleted(function ($payment) {
            $payment->contract->updateStatusAutomatically();
        });

        // Optional: handle updates in case payment amount changes
        static::updated(function ($payment) {
            $payment->contract->updateStatusAutomatically();
        });
    }
}