<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'price'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }


}
