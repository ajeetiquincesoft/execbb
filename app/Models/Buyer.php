<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $primaryKey = 'BuyerID';
    protected $table = 'buyers';
    protected $guarded = ['step'];
    public function comments()
    {
        return $this->hasMany(BuyerComment::class,'BuyerID');
    }
}
