<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'room_id';
    protected $fillable = ['name', 'capacity'];

// Metodo per ottenere tutte le stanze
    public static function getAllRooms()
    {
        return self::all();
    }
}
