<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAnnsalesColumnInLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->decimal('Price', 15, 2)->change();
            $table->decimal('DownPay', 15, 2)->change();
            $table->decimal('REAsking', 15, 2)->change();
            $table->decimal('AnnSales', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->decimal('Price', 8, 2)->change();
            $table->decimal('DownPay', 8, 2)->change();
            $table->decimal('REAsking', 8, 2)->change();
            $table->decimal('AnnSales', 8, 2)->change();
        });
    }
}
