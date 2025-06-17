<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNdaPdfPathToSignNdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sign_ndas', function (Blueprint $table) {
            $table->string('nda_pdf_path')->nullable()->after('nda_form_sign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sign_ndas', function (Blueprint $table) {
            $table->dropColumn('nda_pdf_path');
        });
    }
}
