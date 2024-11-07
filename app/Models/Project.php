<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'projects';
    
    protected $primaryKey = 'prj_id';

    protected $fillable = [
        'prj_id',
        'prj_name',
        'prj_desc',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'org_id',
    ];
}
