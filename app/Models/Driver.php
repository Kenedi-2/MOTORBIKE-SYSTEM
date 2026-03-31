<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

protected $fillable=[
'user_id','phone','license_number','address'
];

public function user(){
return $this->belongsTo(User::class);
}

public function contracts(){
return $this->hasMany(Contract::class);
}

}