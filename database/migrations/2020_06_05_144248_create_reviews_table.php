<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('toilet_id')->index();
            $table->string('name');
            $table->text('body')->nullable();
            $table->integer('rating_clean');
            $table->integer('rating_accessible');
            $table->boolean('payment')->default(false);
            $table->timestamps();

            $table->foreign('toilet_id')->references('id')->on('toilets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
