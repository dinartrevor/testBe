<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    
    public function product()
    {
        return $this->hasOne(Product::class);
    }
    
    
    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    
}
