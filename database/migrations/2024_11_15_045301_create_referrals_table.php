<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->bigIncrements('RefID');
            $table->string('RefCompany', 100)->nullable();
            $table->string('BrokOfRec',100)->nullable();
            $table->string('AgentName',100)->nullable();
            $table->text('Address1')->nullable();
            $table->text('Address2')->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->string('Zip', 100)->nullable();
            $table->string('Phone', 100)->nullable();
            $table->integer('RefFee')->nullable();
            $table->integer('RefFeePer')->nullable();
            $table->integer('RefAmt')->nullable();
            $table->string('FlatFee',100)->nullable();
            $table->integer('RefSource')->default(0);
            $table->integer('RefDir')->default(0);
            $table->integer('RefType')->default(0);
            $table->text('Comments')->nullable();
            $table->string('Fax', 100)->nullable();
            $table->string('ReferredName', 100)->nullable();
            $table->string('ReferredAdd1', 100)->nullable();
            $table->string('ReferredAdd2', 100)->nullable();
            $table->string('ReferredCity', 100)->nullable();
            $table->string('ReferredState', 100)->nullable();
            $table->string('ReferredZip', 100)->nullable();
            $table->string('ReferredPhone', 100)->nullable();
            $table->string('ReferredInterest', 100)->nullable();
            $table->string('ReferredDBA', 100)->nullable();
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
        Schema::dropIfExists('referrals');
    }
}
