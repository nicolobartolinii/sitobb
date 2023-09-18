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

        DB::table('prenotaziones')->insert([
            [
                'nome_cliente' => 'Mario Rossi',
                'email_cliente' => 'mario.rossi@example.com',
                'telefono_cliente' => '1234567890',
                'data_inizio' => '2023-09-20',
                'data_fine' => '2023-09-25',
                'numero_persone' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome_cliente' => 'Luca Verdi',
                'email_cliente' => 'luca.verdi@example.com',
                'telefono_cliente' => '0987654321',
                'data_inizio' => '2023-09-26',
                'data_fine' => '2023-09-30',
                'numero_persone' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // ... aggiungi altre prenotazioni di prova se necessario
        ]);

    }
}
