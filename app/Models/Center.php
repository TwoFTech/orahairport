<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'phone',
        'email',
        'headquarters',
        'status',
        'country_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
