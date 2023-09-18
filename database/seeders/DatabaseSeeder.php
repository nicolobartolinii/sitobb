<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        // Elimina gli altri seeder se non ti servono
        // Ho mantenuto il seeder per 'users' perché potrebbe essere utile per creare account di test

        DB::table('guests')->insert([
            [
                'first_name' => 'Mario',
                'last_name' => 'Rossi',
                'email_address' => null,
                'phone_number' => null,
            ],
            [
                'first_name' => 'Luca',
                'last_name' => 'Verdi',
                'email_address' => null,
                'phone_number' => null,
            ]
        ]);
        DB::table('rooms')->insert([
            [
                'name' => 'Camera 1',
                'capacity' => 2,
            ],
            [
                'name' => 'Camera 2',
                'capacity' => 1,
            ]
            ]);
            DB::table('reservations')->insert([
                [
                    'guest_id' => 1,
                    'room_id' => 1,
                    'arrival_date' => '2023-09-20',
                    'departure_date' => '2023-09-25',
                    'number_of_guests' => 2,
                    'under_14' => 0,
                    'amount_per_night' => 100.00,
                ],
                [
                    'guest_id' => 2,
                    'room_id' => 2,
                    'arrival_date' => '2023-09-26',
                    'departure_date' => '2023-09-30',
                    'number_of_guests' => 1,
                    'under_14' => 0,
                    'amount_per_night' => 100.00,
                ]
                ]);
    }
}
