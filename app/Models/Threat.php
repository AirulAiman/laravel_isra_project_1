<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Threat extends Model
{
    protected $fillable = ['threat_group_id', 'name', 'description'];

    public function threatGroup()
    {
        return $this->belongsTo(ThreatGroup::class);
    }
}

