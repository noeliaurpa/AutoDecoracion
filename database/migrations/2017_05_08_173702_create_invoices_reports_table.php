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
            $table-> integer('client_id')->unsigned(); //nombre del cliente
            $table->float('total', 9, 2); //total de la factura
            $table->float('subtotal', 9, 2); //subtotal de la factura
            $table->float('iv'); // impuesto de venta de la factura
            $table->string('observation')->nullable(); //observacion
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('client_id')->references('id')->on('customers');
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
