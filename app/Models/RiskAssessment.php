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
        'likelihood',
        'likelihood_score',
        'cia_impact_score',
        'impact_level',
        'probability',
        'probability_score',
        'final_risk_score',
        'final_risk_level',
        'risk_owner',
        'mitigation_option',
        'treatment',
        'actions',
        'cia_score',  // Add this line
    ];

    // Add this method to calculate scores
    public function calculateScores()
    {
        // Calculate likelihood score
        $this->likelihood_score = match($this->likelihood) {
            'High' => 3,
            'Medium' => 2,
            'Low' => 1,
            default => 1
        };
    
        // Calculate CIA impact score (average of CIA values * likelihood score)
        $cia_average = ($this->confidentiality + $this->integrity + $this->availability) / 3;
        $this->cia_impact_score = $cia_average * $this->likelihood_score;
    
        // Set the cia_score (use cia_impact_score or any desired calculation)
        $this->cia_score = $this->cia_impact_score;  // Assign CIA score here
    
        // Determine impact level
        $this->impact_level = match(true) {
            $this->cia_impact_score >= 2.5 => 'High',
            $this->cia_impact_score >= 1.5 => 'Medium',
            default => 'Low'
        };
    
        // Calculate probability score
        $this->probability_score = match($this->probability) {
            'Most likely' => 3,
            'Once in a while' => 2,
            'No probability' => 1,
            default => 1
        };
    
        // Calculate final risk score (probability score * impact score)
        $this->final_risk_score = $this->probability_score * $this->cia_impact_score;
    
        // Determine final risk level
        $this->final_risk_level = match(true) {
            $this->final_risk_score >= 5 => 'High',
            $this->final_risk_score >= 3 => 'Medium',
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