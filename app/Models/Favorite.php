<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['buyer_id', 'listing_id'];
    public function favoriteListing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
