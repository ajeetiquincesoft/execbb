<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('BuyerID')->nullable();
            $table->unsignedBigInteger('ListingID')->nullable();
            $table->boolean('liked')->default(0);
            $table->timestamps();
            $table->foreign('BuyerID')->references('BuyerID')->on('buyers')->onDelete('cascade');
            $table->foreign('ListingID')->references('ListingID')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
