<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBuyersName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->string('TypeBus')->nullable()->after('NetProfMax');
            $table->string('NetWorth')->nullable()->after('TypeBus');
            $table->string('CashAvailable')->nullable()->after('NetWorth');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->dropColumn('TypeBus');
            $table->dropColumn('NetWorth');
            $table->dropColumn('CashAvailable');
        });
    }
}
