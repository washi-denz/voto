<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $guarded = [];
    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoAttribute($value)
    {
        if ($value != null)
            return url('storage/photos/' . $value);
        return url('images/logos/default.png');
    }
}
