<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id'); //id
            $table-> integer('client_id')->unsigned(); //id del cliente
            $table->string('license_plate_or_detail')->unique(); // placa del vehículo o detalle brand
            $table->string('brand'); // marca del vehículo
            $table->string('model'); // modelo del vehículo
            $table->string('observation')->nullable(); //observacion
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('customers');
            // onDelete it should not be used because it deletes all associated records
            //$table->foreign('client_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
