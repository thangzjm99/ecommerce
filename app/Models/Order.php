<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
