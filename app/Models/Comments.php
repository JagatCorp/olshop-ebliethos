<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'artikel_id',
        'comment',
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

}
