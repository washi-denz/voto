<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    public function getLogoAttribute($value)
    {
        if ($value != null)
            return 'logo-school/' . $value;
        return 'images/default/logo_school.png';
    }
}
