<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('ContactID');
            $table->string('LName', 100)->nullable();
            $table->string('FName',100)->nullable();
            $table->string('CompanyName',100)->nullable();
            $table->string('AddRep', 100)->nullable();
            $table->text('Address1')->nullable();
            $table->text('Address2')->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->string('Zip', 100)->nullable();
            $table->string('Phone', 100)->nullable();
            $table->string('Fax', 100)->nullable();
            $table->string('Pager', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->integer('Type')->default(0);
            $table->text('Comments')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
