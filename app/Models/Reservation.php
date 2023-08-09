<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'token',
        'description',
        'stand_id',
        'user_id',
        'study_id',
        'pnr',
        'amount',
        'status',
        'purchase',
        'transaction_id',
        'pay_by',
        'transaction_mode',
        'for',
        'departure_city',
        'destination_city',
        'departure_date',
        // 'return_date',
        'company',
        'passenger_number',
        'fidelity_code',
    ];

    public function stand()
    {
        return $this->belongsTo('App\Models\Stand');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function passengers()
    {
        return $this->hasMany('App\Models\Passenger');
    }
}
