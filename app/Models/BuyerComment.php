<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerComment extends Model
{
    use HasFactory;
    protected $primaryKey = 'BuyerCommentID';
    protected $table = 'buyer_comments';
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    // Define the inverse relationship: a comment belongs to a post
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
