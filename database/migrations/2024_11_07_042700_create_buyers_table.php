<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->bigIncrements('BuyerID');
            $table->string('BDate', 100)->nullable();
            $table->string('AgentID', 100)->nullable();
            $table->string('LName', 100)->nullable();
            $table->string('FName',100)->nullable();
            $table->string('Honorific',100)->nullable();
            $table->string('NName', 100)->nullable();
            $table->string('Corp', 100)->nullable();
            $table->string('Address1', 100)->nullable();
            $table->string('Address2', 100)->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->string('Zip', 100)->nullable();
            $table->string('County', 100)->nullable();
            $table->string('DLNo', 100)->nullable();
            $table->string('SocSecNo', 100)->nullable();
            $table->string('BusPhone', 100)->nullable();
            $table->string('HomePhone', 100)->nullable();
            $table->string('Pager', 100)->nullable();
            $table->string('Fax', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->string('CallWhen', 100)->nullable();
            $table->string('PartnerName', 100)->nullable();
            $table->string('PartnerPhone', 100)->nullable();
            $table->integer('BusType1')->nullable();
            $table->integer('BusType2')->nullable();
            $table->integer('BusType3')->nullable();
            $table->integer('BusType4')->nullable();
            $table->string('BusLocation', 100)->nullable();
            $table->string('BusCounty1', 100)->nullable();
            $table->string('BusCounty2', 100)->nullable();
            $table->string('BusCounty3', 100)->nullable();
            $table->string('BusCounty4', 100)->nullable();
            
            // These columns need to be defined correctly without using `change()`
            $table->tinyInteger('Group')->default(0);
            $table->float('PPMin', 8, 2)->nullable();
            $table->float('PPMax', 8, 2)->nullable();
            $table->float('DownPmtMin', 8, 2)->nullable();
            $table->float('DownPmtMax', 8, 2)->nullable();
            $table->float('VolMin', 8, 2)->nullable();
            $table->float('VolMax', 8, 2)->nullable();
            $table->float('NetProfMin', 8, 2)->nullable();
            $table->float('NetProfMax', 8, 2)->nullable();
            $table->string('CurrentEmploy', 100)->nullable();
    
            // Now properly define the 'Interest' and 'Active' columns without `change()`
            $table->integer('Interest')->default(0); // Default value set to 0
            $table->tinyInteger('Active')->default(0); // Default value set to 0
    
            $table->text('Comments')->nullable();
            $table->string('DateEntered', 100)->nullable();
            $table->string('EnteredBy', 100)->nullable();
            $table->tinyInteger('Signed')->default(0);
            $table->string('BuyerType', 100)->nullable();
            $table->tinyInteger('OptOut')->default(0);
            $table->string('ExpDate', 100)->nullable();
            $table->tinyInteger('ValidEmail')->default(0);
            $table->string('BusInt', 100)->nullable();
            $table->string('Location', 100)->nullable();
            $table->string('Price', 100)->nullable();
            $table->string('DownPay', 100)->nullable();
            $table->string('Profit', 100)->nullable();
            $table->string('SalesVol', 100)->nullable();
            $table->tinyInteger('Dup')->default(0);
            $table->string('MasterID', 100)->nullable();
            $table->string('Welcome', 100)->nullable();
            $table->string('emailmatch', 100)->nullable();
            $table->string('phonematch', 100)->nullable();
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
        Schema::dropIfExists('buyers');
    }
}
