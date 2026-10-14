<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $primaryKey = 'LeadID';
    protected $table = 'leads';
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'ListingID', 'ListingID');
    }
}
