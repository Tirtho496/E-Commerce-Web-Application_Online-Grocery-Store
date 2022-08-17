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
            'paystatus',
            'coupon_id',
            'total_price',
            'tracking_no',
            
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id','id');
    }
}
