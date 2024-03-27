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

}
