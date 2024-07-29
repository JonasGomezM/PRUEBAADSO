<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'is_on_offer',
        'image_url',  // Añadido aquí
    ];

    public function offerProduct()
    {
        return $this->hasOne(OfferProduct::class);
    }
}
