<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $fillable = [
        'process_id',
        'name',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($process) {
            $latestProcess = static::latest()->first();
            
            if (!$latestProcess) {
                $number = 1;
            } else {
                $number = intval(substr($latestProcess->process_id, 2)) + 1;
            }
            
            $process->process_id = 'RR' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }
}