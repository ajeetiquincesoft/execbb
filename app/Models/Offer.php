<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';
    protected $primaryKey = 'OfferID';
    
    public function listing()
    {
        return $this->belongsTo(Listing::class,'ListingID');
    }
}
