<?php

namespace App\Models;

use App\Models\User;
use Chatify\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ChChannel extends Model
{
    use UUID;

    protected $fillable = [
        'avatar',
    ];

    protected $connection = 'mysql_second'; // Menetapkan koneksi database

    public function users()
    {
        return $this->belongsToMany(User::class, 'ch_channel_user', 'channel_id', 'user_id');
    }
}
