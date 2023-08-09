<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'status',
        'label',
        'created_at',
        'updated_at',
    ];

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function centers()
    {
        return $this->hasMany('App\Models\Center');
    }
}
