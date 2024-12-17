<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsInBuyers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            // Add a new foreign key column 'user_id' referencing the 'id' column in the 'users' table
            $table->unsignedBigInteger('user_id')->nullable(); // Make it nullable or required based on your needs

            // Add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // You can change the 'onDelete' action

            // Modify the existing 'Dup' column to make it nullable
            $table->integer('Group')->nullable()->change();
            $table->integer('Signed')->nullable()->change();
            $table->integer('Interest')->nullable()->change();
            $table->integer('Active')->nullable()->change();
            $table->integer('OptOut')->nullable()->change();
            $table->integer('ValidEmail')->nullable()->change();
            $table->integer('Dup')->nullable()->change();
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
            // Drop the foreign key constraint before removing the column
            $table->dropForeign(['user_id']);

            // Drop the foreign key column 'user_id'
            $table->dropColumn('user_id');

            // Revert the 'Dup' column back to its original state
            $table->integer('Group')->default(0)->change();
            $table->integer('Signed')->default(0)->change();
            $table->integer('Interest')->default(0)->change();
            $table->integer('Active')->default(0)->change();
            $table->integer('OptOut')->default(0)->change();
            $table->integer('ValidEmail')->default(0)->change();
            $table->integer('Dup')->default(0)->change();
        });
    }
}
