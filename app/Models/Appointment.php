<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_name',
        'owner_name',
        'contact_number',
        'email',
        'appointment_date',
        'appointment_time',
        'vet',
        'notes',
        'status',
    ];
}
