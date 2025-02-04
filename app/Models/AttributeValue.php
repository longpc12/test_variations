<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = ['attribute_id', 'value'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }






    // Quan hệ với ProductVariationSize (Kích thước của biến thể)
    public function variationValues()
    {
        return $this->hasMany(ProductVariationValue::class, 'attribute_value_id');
    }
    


    // Quan hệ với ProductVariation (Màu sắc của biến thể)
    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class, 'attribute_value_id');
    }
}
