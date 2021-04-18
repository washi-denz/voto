<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    function census()
    {
        return $this->BelongsTo(Census::class);
    }

    function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function getLogoAttribute($value)
    {
        if ($value != null)
            return 'storage/logos/' . $value;
        return 'images/logos/default.png';
    }

    public function getPhotoAttribute($value)
    {
        if ($value != null)
            return 'storage/photos/' . $value;
        return 'images/photos/default.png';
    }
}
