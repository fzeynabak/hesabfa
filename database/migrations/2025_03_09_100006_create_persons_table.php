<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('code_hesabdari')->unique();
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('family');
            $table->string('nickname')->nullable();
            $table->string('category')->nullable();
            $table->boolean('type_customer')->default(0);
            $table->boolean('type_supplier')->default(0);
            $table->boolean('type_shareholder')->default(0);
            $table->boolean('type_employee')->default(0);
            $table->decimal('credit', 20, 2)->default(0.00);
            $table->string('price_list')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax_registration')->nullable();
            $table->string('shenase_meli')->nullable();
            $table->string('code_eghtesadi')->nullable();
            $table->string('shomare_sabt')->nullable();
            $table->string('code_shobe')->nullable();
            $table->text('tozihat')->nullable();
            $table->text('address_text')->nullable();
            $table->string('country')->default('ایران');
            $table->string('ostan')->nullable();
            $table->string('shahr')->nullable();
            $table->string('codeposti')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('telephone1')->nullable();
            $table->string('telephone2')->nullable();
            $table->string('telephone3')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('marriage_date')->nullable();
            $table->date('membership_date')->nullable();
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
        Schema::dropIfExists('persons');
    }
}