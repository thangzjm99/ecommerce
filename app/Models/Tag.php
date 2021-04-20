<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';

    public function product_tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    
}
