<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAgentIdNullableInAgentListingViewByBuyers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_listing_view_by_buyers', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_listing_view_by_buyers', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->nullable(false)->change();
        });
    }
}
