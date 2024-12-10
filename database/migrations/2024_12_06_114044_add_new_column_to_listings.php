<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToListings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->string('Motivation')->nullable()->after('YrsPresentOwner');
            $table->string('CostOfSale')->nullable()->after('AnnualSales');
            $table->string('GrossProfit')->nullable()->after('CostOfSale');
            $table->string('TotalExpenses')->nullable()->after('GrossProfit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('Motivation');
            $table->dropColumn('CostOfSale');
            $table->dropColumn('GrossProfit');
            $table->dropColumn('TotalExpenses');
        });
    }
}
