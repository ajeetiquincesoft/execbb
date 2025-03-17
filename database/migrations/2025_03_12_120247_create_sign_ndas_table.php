<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignNdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_ndas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Make user_id nullable
            $table->string('full_name')->nullable();
            $table->string('business_interest')->nullable();
            $table->string('home_address')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('date')->nullable();
            $table->string('nda_form_sign')->default('no')->nullable();
            $table->text('signature')->nullable();
            $table->timestamps();

            // Foreign key constraint with nullable column
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null'); // Instead of onDelete('cascade'), use onDelete('set null')

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sign_ndas');
    }
}
