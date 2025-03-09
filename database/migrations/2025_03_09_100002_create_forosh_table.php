<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForoshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forosh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ashkhas_id');
            $table->date('date');
            $table->decimal('total_price', 15, 2);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('ashkhas_id')->references('id')->on('ashkhas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forosh');
    }
}