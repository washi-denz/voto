<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected  $fillable = [
        'candidate_id',
        'hash'
    ];

    function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    function checkTmpSession($request, $value)
    {
        if ($request->session()->has($value)) {
            return false;
        }
        return true;
    }

    function checkTmpSessionDelete($request, $value)
    {
        $request->session()->forget($value);
        return true;
    }
}
