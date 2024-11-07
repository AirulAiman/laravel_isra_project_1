<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    protected $fillable = [
        'asset_id',
        'personnel',
        'risk_level',
        'threat_group_id',
        'threat_id',
        'vulnerability_group_id',
        'vulnerability_id',
        'confidentiality',
        'integrity',
        'availability',
        'cia_score',
        'likelihood',
        'impact',
        'risk_owner',
        'mitigation_option',
        'treatment',
        'actions',
    ];

    public function assetRegister()
    {
        return $this->belongsTo(AssetRegister::class, 'asset_id');
    }

    public function threatGroup()
    {
        return $this->belongsTo(ThreatGroup::class);
    }

    public function threat()
    {
        return $this->belongsTo(Threat::class);
    }

    public function vulnerabilityGroup()
    {
        return $this->belongsTo(VulnerabilityGroup::class);
    }

    public function vulnerability()
    {
        return $this->belongsTo(Vulnerability::class);
    }
}