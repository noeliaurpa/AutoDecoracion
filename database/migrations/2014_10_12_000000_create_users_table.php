<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // id 
            $table->string('name'); // nombre
            $table->string('email')->unique(); // correo electronico
            $table->string('password'); // contraseña
            $table->rememberToken(); // token 
            $table->timestamps(); // fechas
            $table->string('tell'); // telefono
            $table->string('workstation'); // puesto de trabajo administrador/usuario
            $table->integer('salary')->unsigned()->nullable(); // salario
            $table->string('observation')->nullable(); // observacion-> Is optional
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
