<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tripiel extends Model
{
    use HasFactory;
    protected $table = 'tripiel';
    public $timestamps = false;
    protected $guarded = [];
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function couriers()
    {
        return $this->hasMany(Kurir::class, 'courier_id', 'id');
    }
}
