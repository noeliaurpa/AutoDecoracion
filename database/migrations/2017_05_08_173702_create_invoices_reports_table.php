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
            $table->string('license_plate_or_detail')->nullable(); //placa del vehiculo
            $table->string('brand')->nullable(); //marca del vehiculo
            $table->string('model')->nullable(); //modelo del vehiculo
            $table->string('number'); //numero de fatura
            $table->string('nameClient'); //nombre del cliente
            $table->float('total', 9, 2); //total de la factura
            $table->float('subtotal', 9, 2); //subtotal de la factura
            $table->float('iv'); // impuesto de venta de la factura
            $table->integer('state');//estado de la factura, activo/inactivo, activo 1, inactivo 0
            $table->integer('Client_or_Provider');//si es cliente o proveedor, cliente 2, proveedor 1
            $table->string('observation')->nullable(); //observacion
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
        Schema::dropIfExists('invoicesReports');
    }
}
