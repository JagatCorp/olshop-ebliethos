<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalOrders()
    {
    return $this->where('product_id', $this->product_id)->count();
    }


    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
