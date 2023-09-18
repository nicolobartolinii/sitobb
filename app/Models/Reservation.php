<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['guest_id', 'room_id', 'arrival_date', 'departure_date', 'number_of_guests', 'under_14', 'amount_per_night'];

    protected $dates = ['arrival_date', 'departure_date'];
    public $timestamps = false;

}

