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
        Schema::create('invoicesArticles', function (Blueprint $table) {
            $table->increments('id'); //id
            $table->integer('invoice_id')->unsigned(); //id del reporte de factura
            $table->integer('article_id')->unsigned(); //id del articulo
            $table->integer('quantity'); //cantidad de articulos
            $table->float('price'); // precio del producto
            $table->float('total'); //suma de los productos
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoicesReports');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoicesArticles');
    }
}
