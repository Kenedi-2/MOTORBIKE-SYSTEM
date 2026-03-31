<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    /**
     * A sponsor can have many contracts
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}