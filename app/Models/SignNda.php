<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignNda extends Model
{
    use HasFactory;
    protected $table = 'sign_ndas';
    protected $fillable = [
        'full_name',
        'business_interest',
        'home_address',
        'home_phone',
        'cell_phone',
        'email',
        'date',
        'nda_form_sign',
        'signature',
    ];
}
