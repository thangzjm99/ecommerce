<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function order_details()
    {
        $this->hasMany(OrderDetail::class);
    }

    public function favorites()
    {
        $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        # code...
        $this->hasMany(Comment::class);
    }

    public function product_tags()
    {
        $this->hasMany(ProductTag::class);
    }

    public function images()
    {
        $this->hasMany(Image::class,'product_id');
    }
}
