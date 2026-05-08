<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    protected $primaryKey = 'SubCatID';

    protected $fillable = [
        'SubCategory',
        'CatID'
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'CatID', 'CategoryID');
    }
}
