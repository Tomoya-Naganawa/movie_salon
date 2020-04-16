<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'name', 'profile_path'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
