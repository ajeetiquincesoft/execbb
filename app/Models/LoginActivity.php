<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_info',
        'logged_in_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
