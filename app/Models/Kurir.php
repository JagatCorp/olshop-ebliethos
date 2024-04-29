<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;

    protected $table = 'courier';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'type',
    ];
    
    
    /**
     * Get all of the comments for the Warehouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripiel(): HasMany
    {
        return $this->hasMany(Comment::class, 'courier_id', 'id');
    }
}
