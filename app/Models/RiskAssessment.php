<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'threat_group_id',
        'threat_id',
        'vulnerability_group_id',
        'vulnerability_id',
        'confidentiality',
        'integrity',
        'availability',
        'personnel',
        'start_time',
        'end_time',
        'likelihood',
        'impact',
        'risk_level',
        'risk_owner',
        'mitigation_option',
        'treatment',
    ];

    public function asset()
    {
        return $this->belongsTo(AssetRegister::class, 'asset_id');
    }

    public function threatGroup()
    {
        return $this->belongsTo(ThreatGroup::class, 'threat_group_id');
    }
    
    public function vulnerabilityGroup()
    {
        return $this->belongsTo(VulnerabilityGroup::class, 'vulnerability_group_id');
    }
    
    public function threat()
    {
        return $this->belongsTo(Threat::class, 'threat_id');
    }
    
    public function vulnerability()
    {
        return $this->belongsTo(Vulnerability::class, 'vulnerability_id');
    }
}
