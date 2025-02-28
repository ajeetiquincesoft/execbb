<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentListingViewByBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_listing_view_by_buyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');  
            $table->unsignedBigInteger('buyer_id');    
            $table->unsignedBigInteger('agent_id');
            $table->timestamp('viewed_at');             
            $table->timestamps();                       
            $table->foreign('listing_id')->references('ListingID')->on('listings')->onDelete('cascade');
            $table->foreign('buyer_id')->references('user_id')->on('buyers')->onDelete('cascade');
            $table->foreign('agent_id')->references('AgentUserRegisterId')->on('agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_listing_view_by_buyers');
    }
}
