<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlist';
    protected $fillabe = [
        'user_id',
        'product_id',
        'product_qty',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
