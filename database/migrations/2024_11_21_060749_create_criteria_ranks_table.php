<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriaRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria_ranks', function (Blueprint $table) {
            $table->id();
            $table->decimal('BusInt', 15, 2)->nullable();
            $table->decimal('Location', 15, 2)->nullable();
            $table->decimal('Price', 15, 2)->nullable();
            $table->decimal('DownPay', 15, 2)->nullable();
            $table->decimal('Vol', 15, 2)->nullable();
            $table->decimal('Profit', 15, 2)->nullable();
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
        Schema::dropIfExists('criteria_ranks');
    }
}
