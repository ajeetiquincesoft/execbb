<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('AgentTableID');
            $table->index(array("AgentTableID"));
            $table->dropPrimary();
            $table->string('AgentID', 32)->primary();
            $table->string('LName', 50)->nullable();
            $table->string('FName', 50)->nullable();
            $table->string('Spouse', 32)->nullable();
            $table->string('SpLName', 50)->nullable();
            $table->string('SpFName', 50)->nullable();
            $table->text('Address1')->nullable();
            $table->text('Address2')->nullable();
            $table->string('City', 50)->nullable();
            $table->string('State', 50)->nullable();
            $table->string('Zip', 100)->nullable();
            $table->string('Telephone', 100)->nullable();
            $table->string('Pager', 100)->nullable();
            $table->string('CellPhone', 100)->nullable();
            $table->string('Fax', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->string('SocSecNum', 100)->nullable();
            $table->date('DOB')->nullable();
            $table->date('HireDate')->nullable();
            $table->string('License', 100)->nullable();
            $table->date('Termination', 100)->nullable();
            $table->tinyInteger('Active')->default('0')->change();
            $table->longText('Comments')->nullable();
            $table->string('Extension', 100)->nullable();
            $table->string('Display', 50)->nullable();
            $table->string('image', 255)->nullable();
            $table->longText('Profile')->nullable();
            $table->string('EmailFlag', 50)->nullable();
            $table->string('Renewal', 100)->nullable();
            $table->string('EmailPW', 100)->nullable();
            $table->unsignedBigInteger('AgentUserRegisterId')->nullable();
            $table->foreign('AgentUserRegisterId')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('agents');
    }
}
