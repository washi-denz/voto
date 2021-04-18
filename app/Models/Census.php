<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Census extends Model
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
            return 'storage/photos/' . $value;
        return 'images/photos/default.png';
    }

    //Query Scope

    public function ScopeNameLastName($query, $name)
    {
        if ($name)
            return $query->where('name', 'LIKE', "%$name%");
    }

    public function ScopeSearchDni($query, $dni)
    {
        if ($dni)
            return $query->where('document', 'LIKE', "%$dni%");
    }
}
