<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the comments for the Warehouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripiel(): HasMany
    {
        return $this->hasMany(Tripiel::class, 'warehouse_id', 'id');
    }
    
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'warehouse_id', 'warehouse_id');
    }

}
