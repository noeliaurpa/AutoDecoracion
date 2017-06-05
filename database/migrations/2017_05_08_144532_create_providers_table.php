<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id'); // id 
            $table->string('name'); // nombre
            $table->string('number_provider'); //numero del proveedor
            $table->string('address_provider'); //direccion del proveedor
            $table->string('email')->unique(); // correo electronico
            $table->string('fax_provider')->nullable(); //fax del proveedor
            $table->string('observation')->nullable(); // observacion-> Is optional
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
        Schema::dropIfExists('providers');
    }
}
