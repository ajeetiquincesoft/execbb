<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('LeadID');
            $table->integer('Status')->nullable();
            $table->string('BusName', 100)->nullable();
            $table->string('Address', 100)->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->integer('Zip')->nullable();
            $table->string('County', 100)->nullable();
            $table->integer('Category')->nullable();
            $table->integer('SubCategory')->nullable();
            $table->string('Source', 100)->nullable();
            $table->float('Price', 8, 2)->nullable();
            $table->float('DownPay', 8, 2)->nullable();
            $table->text('AdCopy', 100)->nullable();
            $table->string('AdDate', 100)->nullable();
            $table->bigInteger('Phone')->nullable();
            $table->text('Comments', 100)->nullable();
            $table->string('AgentID', 100)->nullable();
            $table->string('LDate', 100)->nullable();
            $table->integer('Listed')->nullable();
            $table->string('SellerFName', 100)->nullable();
            $table->string('SellerLName', 100)->nullable();
            $table->string('AppointmentDate', 100)->nullable();
            $table->dateTime('AppointmentTime')->nullable();
            $table->integer('FSBO')->nullable();
            $table->string('HomePhone', 100)->nullable();
            $table->string('CellPhone', 100)->nullable();
            $table->integer('RealEstateInc')->nullable();
            $table->float('REAsking', 8,2)->nullable();
            $table->float('AnnSales', 8, 2)->nullable();
            $table->integer('YearsInBus')->nullable();
            $table->string('PresentOwner', 100)->nullable();
            $table->string('SizeOfFacility', 100)->nullable();
            $table->integer('EnteredBy')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
