<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentListingViewByBuyer extends Model
{
    use HasFactory;
     // Define the table name (optional, if it's not the plural form of the model name)
     protected $table = 'agent_listing_view_by_buyers';

     // Define the fillable attributes (fields that can be mass-assigned)
     protected $fillable = [
         'listing_id',
         'buyer_id',
         'viewed_at',
     ];
 
     // Define relationships (assuming you have Listing, Buyer, and Agent models)
     public function listing()
     {
         return $this->belongsTo(Listing::class, 'listing_id', 'ListingID');
     }
 
     public function buyer()
     {
         return $this->belongsTo(Buyer::class, 'buyer_id', 'user_id');
     }
 
     public function agent()
     {
         return $this->belongsTo(Agent::class, 'agent_id', 'AgentUserRegisterId');
     }
}
