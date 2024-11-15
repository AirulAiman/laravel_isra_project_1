<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExistingControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'control_id',
        'name',
        'description',
        'control_group_id',
        // 'status'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($control) {
            $latestControl = static::latest()->first();
            
            if (!$latestControl) {
                $number = 1;
            } else {
                $number = intval(substr($latestControl->control_id, 2)) + 1;
            }
            
            $control->control_id = 'EC' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function controlGroup()
    {
        return $this->belongsTo(ControlGroup::class);
    }
}