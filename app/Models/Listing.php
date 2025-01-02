<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $primaryKey = 'ListingID';
    protected $table = 'listings';
    public function offers()
    {
        return $this->hasMany(Offer::class, 'ListingID');
    }
    public function comments()
    {
        return $this->hasMany(BuyerComment::class,'ListingID');
    }
}
