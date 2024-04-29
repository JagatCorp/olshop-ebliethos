<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';
    protected $primaryKey = 'city_id';
    public $timestamps = false;
    protected $fillable = [
        'city_name',
        'type',
        'province_id',
        'postal_code',

    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
    
    
    /**
     * Get all of the comments for the Warehouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripiel(): HasMany
    {
        return $this->hasMany(Tripiel::class, 'city_id', 'city_id');
    }
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_city_id', 'customer_city_id');
    }
    
    

}
