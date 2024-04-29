<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatans';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'city_id',

    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
    
    
    /**
     * Get all of the comments for the Warehouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripiel(): HasMany
    {
        return $this->hasMany(Tripiel::class, 'kecamatan_id', 'id');
    }
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_kecamatan_id', 'customer_kecamatan_id');
    }
    

}
