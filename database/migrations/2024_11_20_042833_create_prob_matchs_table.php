<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProbMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prob_matchs', function (Blueprint $table) {
            $table->id();
            $table->integer('BuyerID')->nullable();
            $table->integer('ListingID')->nullable();
            $table->decimal('BusInt', 15, 2)->nullable();
            $table->decimal('Location', 15, 2)->nullable();
            $table->decimal('Price', 15, 2)->nullable();
            $table->decimal('DownPay', 15, 2)->nullable();
            $table->decimal('Vol', 15, 2)->nullable();
            $table->decimal('Profit', 15, 2)->nullable();
            $table->decimal('Overall', 15, 2)->nullable(); 
            $table->timestamp('DateRank')->nullable();
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
        Schema::dropIfExists('prob_matchs');
    }
}
