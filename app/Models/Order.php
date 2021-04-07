<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    //

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function order_details()
    {
        $this->hasMany(OrderDetail::class);
    }

    public function payment_method()
    {
        $this->belongsTo(PaymentMethod::class);
    }
}
