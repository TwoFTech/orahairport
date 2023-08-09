<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'stand_amount',
        'dev_commission_on_point',
        'dev_commission_on_reservation',
        'currency',
        'tva_tax',
    ];
}
