<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table= 'orders';

    protected $fillable = [
            'user_id',
            'fname',
            'lname',
            'phone',
            'email',
            'address',
            'city',
            'district',
            'division',
            'status',
            'total_price',
            'tracking_no',
            
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id','user_id');
    }
}