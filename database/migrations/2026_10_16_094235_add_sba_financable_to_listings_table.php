<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSbaFinancableToListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->boolean('SBAFinancable')
                ->default(false)
                ->after('SoldEBB');
        });
    }

    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('SBAFinancable');
        });
    }
}
