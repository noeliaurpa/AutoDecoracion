<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicesarticles', function (Blueprint $table) {
            $table->increments('id'); //id
            $table->integer('invoice_id')->unsigned(); //id del reporte de factura
            $table->string('codeArticle');
            $table->string('nameArticle');
            $table->integer('quantity'); //cantidad de articulos
            $table->float('price', 9, 2); // precio del producto
            $table->float('total', 9, 2); //suma de los productos
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoicesreports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoicesarticles');
    }
}
