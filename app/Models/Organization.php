<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $primaryKey = 'org_id';

    protected $fillable = [
        'org_name',
        'org_desc',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'org_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'org_id');
    }
}
