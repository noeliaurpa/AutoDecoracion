<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxSmallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smallboxes', function (Blueprint $table) {
            $table->increments('id'); //id
            $table-> integer('article_id')->unsigned(); //id del cliente
            $table->string('nameArticle');//nombre del articulo
            $table->string('observation')->nullable(); //observacion
            $table->timestamps();
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
        Schema::dropIfExists('smallboxes');
    }
}
