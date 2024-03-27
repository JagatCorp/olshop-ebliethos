<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierWarehousePrices extends Model
{
    use HasFactory;
    protected $table = 'courier_warehouse_price';
    public $timestamps = false;
    protected $guarded = [];

    public function courier()
    {
        return $this->belongsTo(Kurir::class, 'courier_id', 'id');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}
