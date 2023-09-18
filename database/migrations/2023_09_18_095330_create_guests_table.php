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
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('guest_id')->primary();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email_address', 50)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('nationality', 50)->nullable();
            $table->string('document_number', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->string('vat_number', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
};
