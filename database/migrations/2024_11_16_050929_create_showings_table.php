<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showings', function (Blueprint $table) {
            $table->bigIncrements('ShowingID');
            $table->string('AgentID')->nullable();
            $table->string('Date')->nullable();
            $table->integer('BuyerID')->nullable();
            $table->integer('ListingID')->nullable();
            $table->integer('OfferMade')->default(0);
            $table->string('FollowUp')->nullable();
            $table->text('Notes')->nullable();
            $table->string('Verbal')->nullable();
            $table->date('DateEntered')->nullable();
            $table->integer('EnteredBy')->nullable();
            $table->string('Dup')->nullable();
            $table->string('Display')->nullable();
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
        Schema::dropIfExists('showings');
    }
}
