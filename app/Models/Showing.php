<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showing extends Model
{
    use HasFactory;
    protected $primaryKey = 'ShowingID';
    protected $fillable = [
        'AgentID',
        'Date',
        'BuyerID',
        'ListingID',
        'OfferMade',
        'follow_up',
    ];    
}
