<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('BuyerAttorney')->nullable()->after('AnticipationLetters');
            $table->string('SellerAttorney')->nullable()->after('BuyerAttorney');
            $table->string('BuyerAccountant')->nullable()->after('SellerAttorney');
            $table->string('SellerAccountant')->nullable()->after('BuyerAccountant');
            $table->string('Landlord')->nullable()->after('SellerAccountant');
            $table->string('Referral')->nullable()->after('Landlord');
            $table->string('ReferralFeePaid')->nullable()->after('Referral');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('BuyerAttorney');
            $table->dropColumn('SellerAttorney');
            $table->dropColumn('BuyerAccountant');
            $table->dropColumn('SellerAccountant');
            $table->dropColumn('Landlord');
            $table->dropColumn('Referral');
            $table->dropColumn('ReferralFeePaid');
        });
    }
}
