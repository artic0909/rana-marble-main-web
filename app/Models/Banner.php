<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'placement', 'image', 'status', 'sort_order'];

    const PLACEMENTS = [
        'homepage_hero'      => 'Homepage · Hero',
        'homepage_secondary' => 'Homepage · Secondary',
        'category_page'      => 'Category Page',
        'all_products'       => 'All Products',
        'checkout'           => 'Checkout',
    ];
}