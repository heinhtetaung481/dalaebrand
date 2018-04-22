<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOItempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Oitemps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->char('remarks')->default('-');
            $table->integer('design_id')->default(1);
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
        Schema::dropIfExists('OItemp');
    }
}
