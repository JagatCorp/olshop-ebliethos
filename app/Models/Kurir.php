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
}
