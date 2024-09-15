<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name', 'attribute_type'];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }

   
    public function attributeGroups()
    {
        return $this->hasMany(AttributeGroup::class, 'attribute_id');
    }
    

   
}
