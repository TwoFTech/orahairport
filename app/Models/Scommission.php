<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'reservation_id',
        'stand_id',
        'type',
        'status',
    ];

    public function stand()
    {
        return $this->belongsTo('App\Models\Stand');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }
}
