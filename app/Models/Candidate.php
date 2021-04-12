<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected  $fillable = [
        'census_id',
        'party_name',
        'logo',
        'users_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
