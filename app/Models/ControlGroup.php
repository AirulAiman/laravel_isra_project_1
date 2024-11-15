<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'description'
    ];

    public function controls()
    {
        return $this->hasMany(ExistingControl::class);
    }
}