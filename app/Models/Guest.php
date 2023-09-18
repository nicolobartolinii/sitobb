<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'phone_number',
        'nationality',
        'document_number',
        'city',
        'state',
        'zip_code',
        'address',
        'tax_id',
        'vat_number',
    ];
    public static function findGuestByLastName($last_name)
    {
        return self::where('last_name', $last_name)->get();
    }
}
