<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['guest_id', 'room_id', 'arrival_date', 'departure_date', 'number_of_guests', 'under_14', 'amount_per_night','note', 'from_booking', 'tassa_soggiorno'];


    protected $dates = ['arrival_date', 'departure_date'];
    public $timestamps = false;

    public function guest() {
        return $this->belongsTo(Guest::class, 'guest_id', 'guest_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
    public function getArrivalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDepartureDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

}
