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
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('arrival_date'); // data arrivo
            $table->date('departure_date'); // data partenza
            $table->integer('number_of_guests'); // numero persone
            $table->integer('under_14'); // under 14
            $table->decimal('amount_per_night', 8, 2); // importo a notte
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
        Schema::dropIfExists('reservations');
    }
};
