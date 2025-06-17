<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVolmaxColumnInBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->decimal('PPMin', 20, 2)->nullable()->change();
            $table->decimal('PPMax', 20, 2)->nullable()->change();
            $table->decimal('DownPmtMin', 20, 2)->nullable()->change();
            $table->decimal('DownPmtMax', 20, 2)->nullable()->change();
            $table->decimal('VolMin', 20, 2)->nullable()->change();
            $table->decimal('VolMax', 20, 2)->nullable()->change();
            $table->decimal('NetProfMin', 20, 2)->nullable()->change();
            $table->decimal('NetProfMax', 20, 2)->nullable()->change();
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
            $table->decimal('PPMin', 10, 2)->nullable()->change();
            $table->decimal('PPMax', 10, 2)->nullable()->change();
            $table->decimal('DownPmtMin', 10, 2)->nullable()->change();
            $table->decimal('DownPmtMax', 10, 2)->nullable()->change();
            $table->decimal('VolMin', 10, 2)->nullable()->change();
            $table->decimal('VolMax', 10, 2)->nullable()->change();
            $table->decimal('NetProfMin', 10, 2)->nullable()->change();
            $table->decimal('NetProfMax', 10, 2)->nullable()->change();
        });
    }
}
