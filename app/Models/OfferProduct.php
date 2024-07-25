<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock'];
    // Si necesitas agregar propiedades o métodos específicos, hazlo aquí
}
