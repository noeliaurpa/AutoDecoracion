<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicesReports', function (Blueprint $table) {
            $table->increments('id'); //id
            $table-> integer('vehicle_id')->unsigned(); //id del vehiculo
            $table->string('number'); //numero de fatura
            $table->string('name')->nullable(); //nombre
            $table->float('total'); //total de la factura
            $table->integer('discount'); //descuento
            $table->time('hour'); // hora de la realizacion de la factura
            $table->string('observation')->nullable(); //observacion
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoicesReports');
    }
}
