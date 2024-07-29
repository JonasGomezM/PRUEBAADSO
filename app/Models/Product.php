<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Agrega 'category' al array $fillable
    protected $fillable = ['name', 'description', 'price', 'stock', 'is_on_offer', 'category'];

    public function offerProduct()
    {
        return $this->hasOne(OfferProduct::class);
    }
}
