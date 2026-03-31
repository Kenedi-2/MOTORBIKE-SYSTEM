<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorbike extends Model
{

protected $fillable=[
'plate_number','model','engine_number','status'
];

public function contract()
{
return $this->hasOne(Contract::class);
}

}