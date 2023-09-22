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
                'phone_number' => +393331234567,
            ],
            [
                'first_name' => 'Luca',
                'last_name' => 'Verdi',
                'email_address' => null,
                'phone_number' => +390031234567,
            ]
        ]);
        DB::table('rooms')->insert([
            [
                'name' => 'Camera doppia',
                'capacity' => 2,
            ],
            [
                'name' => 'Camera tripla',
                'capacity' => 3,
            ],
            [
            'name' => 'Camera quadrupla',
            'capacity' => 4,
            ],
            [
            'name' => 'Appartamento',
            'capacity' => 4,
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
                ],
                [
                'guest_id' => 2,
                'room_id' => 2,
                'arrival_date' => '2023-10-26',
                'departure_date' => '2023-10-30',
                'number_of_guests' => 2,
                'under_14' => 0,
                'amount_per_night' => 150.00,
            ]
                ]);
        DB::table('users')->insert([
            [
                'name' => "Monica",
                'surname' => "Sforza",
                'email' => "ilgelsonero.an@gmail.com",
                'username' => 'MonicaMonica',
                'password' => Hash::make('NicolaNicola'),
                'role' => "staff",
                'telefono' => "+39 3358049344",
            ],
            [
                'name' => "Riccardo",
                'surname' => "Picciafuoco",
                'email' => "r.picciafuoco@libero.it",
                'username' => 'RiccardoRiccardo',
                'password' => Hash::make('NicolaNicola'),
                'role' => "staff",
                'telefono' => "+39 3487086076",
            ],
            [
                'name' => "Nicolo",
                'surname' => "Bartolini",
                'email' => "",
                'username' => 'NicoloNicolo',
                'password' => Hash::make('NicolaNicola'),
                'role' => "staff",
                'telefono' => "",
            ],
            [
                'name' => "Nicola",
                'surname' => "Picciafuoco",
                'email' => "nicola.picciafoco@gmail.com",
                'username' => 'NicolaNicola',
                'password' => Hash::make('NicolaNicola'),
                'role' => "Staff",
                'telefono' => "",
            ],
            [
                'name' => "admin",
                'surname' => "admin",
                'email' => "",
                'username' => 'adminadmin',
                'password' => Hash::make('adminadmin'),
                'role' => "admin",
                'telefono' => "+39 3358049344",
            ],
        ]);
    }
}
