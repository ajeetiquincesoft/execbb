<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_comments', function (Blueprint $table) {
            $table->bigIncrements('BuyerCommentID');
            $table->unsignedBigInteger('BuyerID')->nullable();
            $table->string('CommentDate')->nullable();
            $table->string('AgentID')->nullable();
            $table->integer('AgentTableID')->nullable();
            $table->text('Comment')->nullable();
            $table->string('Name')->nullable();
            $table->string('Email')->nullable();
            $table->unsignedBigInteger('ListingID')->nullable();
            $table->string('Dup')->nullable();
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
        Schema::dropIfExists('buyer_comments');
    }
}
