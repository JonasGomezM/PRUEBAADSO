<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Product.php
    protected $fillable = ['name', 'description', 'price', 'stock', 'is_on_offer'];


    public function offerProduct()
    {
        return $this->hasOne(OfferProduct::class);
    }
}
