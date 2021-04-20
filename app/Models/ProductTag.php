<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    //
    protected $table = 'product_tags';
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
