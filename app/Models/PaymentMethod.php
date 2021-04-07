<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
    protected $table = 'payment_methods';
     
    public function orders()
    {
        $this->hasMany(Order::class);
    }
}
