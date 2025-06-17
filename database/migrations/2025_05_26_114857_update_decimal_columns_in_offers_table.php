<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDecimalColumnsInOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->decimal('OfferPrice', 20, 2)->nullable()->change();
            $table->decimal('OffDeposit', 20, 2)->nullable()->change();
            $table->decimal('OffAddlDep', 20, 2)->nullable()->change();
            $table->decimal('OffBalDownPay', 20, 2)->nullable()->change();
            $table->decimal('OffDownPay', 20, 2)->nullable()->change();
            $table->decimal('OffBalDue', 20, 2)->nullable()->change();
            $table->decimal('OffPerMonth', 20, 2)->nullable()->change();
            $table->decimal('OffInterest', 20, 2)->nullable()->change();

            $table->decimal('OffMaxInv', 20, 2)->nullable()->change();
            $table->decimal('AccPrice', 20, 2)->nullable()->change();
            $table->decimal('AccDeposit', 20, 2)->nullable()->change();
            $table->decimal('AccAddlDep', 20, 2)->nullable()->change();
            $table->decimal('AccBalDownPay', 20, 2)->nullable()->change();
            $table->decimal('AccDownPay', 20, 2)->nullable()->change();
            $table->decimal('AccBalDue', 20, 2)->nullable()->change();
            $table->decimal('AccPerMonth', 20, 2)->nullable()->change();
            $table->decimal('AccInt', 20, 2)->nullable()->change();

            $table->decimal('COfferPrice', 20, 2)->nullable()->change();
            $table->decimal('COffDeposit', 20, 2)->nullable()->change();
            $table->decimal('COffAddlDep', 20, 2)->nullable()->change();
            $table->decimal('COffBalDownPay', 20, 2)->nullable()->change();
            $table->decimal('COffDownPay', 20, 2)->nullable()->change();
            $table->decimal('COffBalDue', 20, 2)->nullable()->change();

            $table->decimal('REPrice', 20, 2)->nullable()->change();
            $table->decimal('REDownPay', 20, 2)->nullable()->change();
            $table->decimal('REBal', 20, 2)->nullable()->change();

            $table->decimal('OpPrice', 20, 2)->nullable()->change();
            $table->decimal('OpDownPay', 20, 2)->nullable()->change();
            $table->decimal('OpBal', 20, 2)->nullable()->change();

            $table->decimal('LeaseDolMonth', 20, 2)->nullable()->change();
            $table->decimal('Commission', 20, 2)->nullable()->change();
            $table->string('CommissionPct', 100)->nullable()->change();

            $table->decimal('PurchasePrice', 20, 2)->nullable()->change();
            $table->decimal('DownPaymnt', 20, 2)->nullable()->change();
            $table->decimal('BalanceDue', 20, 2)->nullable()->change();

            $table->decimal('RefFee', 20, 2)->nullable()->change();
            $table->decimal('TransAmt', 20, 2)->nullable()->change();
            $table->decimal('CheckAmt', 20, 2)->nullable()->change();
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
            $table->decimal('OfferPrice', 8, 2)->nullable()->change();
            $table->decimal('OffDeposit', 8, 2)->nullable()->change();
            $table->decimal('OffAddlDep', 8, 2)->nullable()->change();
            $table->decimal('OffBalDownPay', 8, 2)->nullable()->change();
            $table->decimal('OffDownPay', 8, 2)->nullable()->change();
            $table->decimal('OffBalDue', 8, 2)->nullable()->change();
            $table->decimal('OffPerMonth', 8, 2)->nullable()->change();
            $table->decimal('OffInterest', 8, 2)->nullable()->change();

            $table->decimal('OffMaxInv', 8, 2)->nullable()->change();
            $table->decimal('AccPrice', 8, 2)->nullable()->change();
            $table->decimal('AccDeposit', 8, 2)->nullable()->change();
            $table->decimal('AccAddlDep', 8, 2)->nullable()->change();
            $table->decimal('AccBalDownPay', 8, 2)->nullable()->change();
            $table->decimal('AccDownPay', 8, 2)->nullable()->change();
            $table->decimal('AccBalDue', 8, 2)->nullable()->change();
            $table->decimal('AccPerMonth', 8, 2)->nullable()->change();
            $table->decimal('AccInt', 8, 2)->nullable()->change();

            $table->decimal('COfferPrice', 8, 2)->nullable()->change();
            $table->decimal('COffDeposit', 8, 2)->nullable()->change();
            $table->decimal('COffAddlDep', 8, 2)->nullable()->change();
            $table->decimal('COffBalDownPay', 8, 2)->nullable()->change();
            $table->decimal('COffDownPay', 8, 2)->nullable()->change();
            $table->decimal('COffBalDue', 8, 2)->nullable()->change();

            $table->decimal('REPrice', 8, 2)->nullable()->change();
            $table->decimal('REDownPay', 8, 2)->nullable()->change();
            $table->decimal('REBal', 8, 2)->nullable()->change();

            $table->decimal('OpPrice', 8, 2)->nullable()->change();
            $table->decimal('OpDownPay', 8, 2)->nullable()->change();
            $table->decimal('OpBal', 8, 2)->nullable()->change();

            $table->decimal('LeaseDolMonth', 8, 2)->nullable()->change();
            $table->decimal('Commission', 8, 2)->nullable()->change();
            $table->decimal('CommissionPct', 8, 2)->nullable()->change();

            $table->decimal('PurchasePrice', 8, 2)->nullable()->change();
            $table->decimal('DownPaymnt', 8, 2)->nullable()->change();
            $table->decimal('BalanceDue', 8, 2)->nullable()->change();

            $table->decimal('RefFee', 8, 2)->nullable()->change();
            $table->decimal('TransAmt', 8, 2)->nullable()->change();
            $table->decimal('CheckAmt', 8, 2)->nullable()->change();
        });
    }
}
