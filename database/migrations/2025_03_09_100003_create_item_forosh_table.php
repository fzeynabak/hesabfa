<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemForoshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_forosh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forosh_id');
            $table->unsignedBigInteger('kala_id')->nullable();
            $table->unsignedBigInteger('khadamat_id')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('forosh_id')->references('id')->on('forosh')->onDelete('cascade');
            $table->foreign('kala_id')->references('id')->on('kala')->onDelete('cascade');
            $table->foreign('khadamat_id')->references('id')->on('khadamat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_forosh');
    }
}