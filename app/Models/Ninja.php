<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ninja extends Model
{
    use HasFactory;

    protected $table = 'ninjas';
    // public $timestamps = false;
    // protected $fillable = ['kecamatan', 'kota', 'prov', 'region', 'cilacap', 'jakarta', 'surabaya', 'medan'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
