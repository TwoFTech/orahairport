<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'firstname',
        'lastname',
        'phone',
        'email',
        'sex',
        'nationality',
        'birthdate',
        'formula',
        'passport_number',
        'passport_file',
        'ticket_number',
        'ticket_file',
        // 'departure_city',
        // 'destination_city',
        // 'departure_date',
        'return_date',
        'amount',
        // 'company',
        'category_id',
        'category',
        'cabin_id',
        'cabin',
        'reservation_id',
        'created_at',
        'updated_at',
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }
}
