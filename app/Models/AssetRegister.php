<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    use HasFactory;

    protected $table = 'asset_register';

    protected $fillable = [
        'project_id',
        'user_id',
        'asset_name',
        'asset_desc',
        'asset_serial_no',
        'asset_category',
        'asset_qty',
        'asset_owner',
        'asset_location',
    ];

    protected static function booted()
    {
        static::created(function ($assetRegister) {
            // Create a default risk assessment for the new asset
            RiskAssessment::create([
                'asset_id' => $assetRegister->id,
                'personnel' => 'N/A', // default value or dynamic value
                'risk_level' => 'Low', // default risk level
                'threat_group_id' => null, // Set based on default logic or input
                'threat_id' => null,
                'vulnerability_group_id' => null,
                'vulnera_id' => null,
                'confidentiality' => 1,
                'integrity' => 1,
                'availability' => 1,
                'likelihood' => 'Low',
                'business_loss' => 'Low',
                'impact' => 'Low',
                'risk_owner' => 'Unassigned', // default or assigned user
                'mitigation_option' => 'None',
                'treatment' => 'None',
                'actions' => 'No actions assigned',
            ]);
        });
    }

    // Relationship with RiskAssessment
    public function riskAssessments()
    {
        return $this->hasMany(RiskAssessment::class, 'asset_id');
    }
}
