<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToiletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toilets', function (Blueprint $table) {
            $table->id();
            $table->integer('business_product_id')->nullable();
            $table->string('name')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('box_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city_name')->nullable();
            $table->string('main_city_name')->nullable();
            $table->double('lat')->nullable();
            $table->double('long')->nullable();
            $table->text('product_description')->nullable();
            $table->integer('rating')->nullable();
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
        Schema::dropIfExists('toilets');
    }
}
