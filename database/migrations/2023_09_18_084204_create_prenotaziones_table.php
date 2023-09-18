<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenotaziones', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('email_cliente');
            $table->string('telefono_cliente');
            $table->date('data_inizio');
            $table->date('data_fine'); // Assicurati di avere questa linea
            $table->integer('numero_persone');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prenotaziones');
    }
};
