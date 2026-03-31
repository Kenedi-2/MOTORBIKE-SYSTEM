<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'motorbike_id',
        'contract_id',
        'description',
        'cost',
        'service_date'
    ];

    /**
     * Service belongs to a Motorbike
     */
    public function motorbike()
    {
        return $this->belongsTo(Motorbike::class);
    }

    /**
     * Service belongs to a Contract
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}