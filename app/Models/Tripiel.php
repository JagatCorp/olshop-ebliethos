<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tripiel extends Model
{
    use HasFactory;
    protected $table = 'tripiel';
    public $timestamps = false;
    protected $guarded = ['id'];
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
    public function courier()
    {
        return $this->belongsTo(Kurir::class, 'courier_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
}
