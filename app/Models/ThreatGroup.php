<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreatGroup extends Model
{
    protected $fillable = ['name'];

    public function threats()
{
    return $this->hasMany(Threat::class, 'threat_group_id');
}

    public function riskAssessments()
    {
        return $this->hasMany(RiskAssessment::class, 'threat_group_id');
    }
}
