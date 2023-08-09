<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'phone',
        'city',
        'city_id',
        'quartier',
        'rue',
        'phone',
        'id_transfert',
        'user_id',
        'validator_id',
        'code',
        'token',
        'status',
        'pay_by'
    ];

    public function reservations()
    {
        return $this->belongsToMany('App\Models\Reservation');
    }

    public function scommissions()
    {
        return $this->hasMany('App\Models\Scommission');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User')->withPivot('role', 'token', 'created_at', 'updated_at');
    }
}
