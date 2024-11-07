<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    // Specify custom primary key field
    protected $primaryKey = 'org_id';

    // Remove any assumption about org_id, let Laravel handle it automatically
    public $incrementing = true;

    // Fillable attributes
    protected $fillable = ['org_name', 'org_logo'];
}
