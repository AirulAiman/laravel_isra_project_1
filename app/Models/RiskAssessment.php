<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    protected $fillable = [
        'asset_id',
        'personnel',
        'threat_group_id',
        'threat_id',
        'vulnerability_group_id',
        'vulnerability_id',
        'confidentiality',
        'integrity',
        'availability',
        'business_loss',
        'business_score',
        'cia_impact_score',
        'impact_level',
        'likelihood',
        'likelihood_score',
        'final_risk_score',
        'final_risk_level',
        'risk_owner',
        'mitigation_option',
        'treatment',
        'actions',
        'cia_score',
    ];

    public function calculateScores()
    {
        // Calculate business score
        $this->business_score = match($this->business_loss) {
            'High' => 3,
            'Medium' => 2,
            'Low' => 1,
            default => 1
        };
    
        // Calculate CIA impact score (average of CIA values)
        $cia_average = ($this->confidentiality + $this->integrity + $this->availability) / 3;
        $this->cia_impact_score = floor($cia_average * $this->business_score);
    
        // Set the cia_score (whole number)
        $this->cia_score = floor($this->cia_impact_score);
    
        // Determine impact level based on CIA score
        $this->impact_level = match(true) {
            $this->cia_score >= 4 => 'High',
            $this->cia_score > 2 => 'Medium',
            default => 'Low'
        };
    
        // Calculate likelihood score
        $this->likelihood_score = match($this->likelihood) {
            'High' => 3,
            'Medium' => 2,
            'Low' => 1,
            default => 1
        };
    
        // Calculate final risk score (likelihood score * impact score)
        $this->final_risk_score = floor($this->likelihood_score * $this->cia_impact_score);
    
        // Determine final risk level based on final risk score
        $this->final_risk_level = match(true) {
            $this->final_risk_score >= 4 => 'High',
            $this->final_risk_score > 2 => 'Medium',
            default => 'Low'
        };
    }

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