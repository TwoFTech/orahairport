<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'label',
        'country_id',
        'created_at',
        'updated_at',
    ];

    public function stands()
    {
        return $this->hasMany('App\Models\Stand');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
