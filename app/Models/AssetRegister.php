<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    use HasFactory;

    protected $table = 'asset_register'; // Ensure this matches your table name
    protected $primaryKey = 'id'; // Change 'asset_id' to your actual primary key
    public $timestamps = true; // Set to true if you have timestamps (created_at, updated_at)

    protected $fillable = [
        'asset_name',
        'organization_id',
        'project_id',
        'user_id',
        'asset_desc',
        'asset_serial_no',
        'asset_category',
        'asset_qty',
        'asset_owner',
        'asset_location',
    ];
}
