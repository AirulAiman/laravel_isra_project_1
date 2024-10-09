<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreatGroup extends Model
{
    protected $fillable = ['name'];

    // A ThreatGroup has many Threats
    public function threats()
    {
        return $this->hasMany(Threat::class);
    }
}
