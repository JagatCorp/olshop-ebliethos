<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'province';
    public $timestamps = false;
    protected $primaryKey = 'province_id';
    protected $fillable = [
        'province_name',
    ];

    public function city()
    {
        return $this->hasMany(City::class, 'province_id', 'province_id');
    }
    
    public function tripiel()
    {
        return $this->hasMany(Tripiel::class, 'province_id', 'province_id');
    }
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_province_id', 'customer_province_id');
    }
    
    
}
