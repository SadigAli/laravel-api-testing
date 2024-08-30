<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'slug_az',
        'slug_en',
        'slug_ru',
        'description_az',
        'description_en',
        'description_ru',
        'cost_price',
        'sale_price',
        'discount',
        'image',
        'category_id',
    ];


    // get relational data
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // get language data
    public function getTitleAttribute()
    {
        return $this->getAttribute('title_' . app()->getLocale());
    }

    public function getSlugAttribute()
    {
        return $this->getAttribute('slug_' . app()->getLocale());
    }

    public function getDescriptionAttribute()
    {
        return $this->getAttribute('description_' . app()->getLocale());
    }


    // custom functions

    public function price()
    {
        return $this->sale_price - $this->discount;
    }
}
