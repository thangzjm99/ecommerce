<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        # code...
        return $this->hasMany(Comment::class);
    }

    public function product_tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
