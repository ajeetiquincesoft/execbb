<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('OfferID');
            $table->unsignedBigInteger('BuyerID')->nullable();
            $table->unsignedBigInteger('ListingID')->nullable();
            $table->string('ListingAgent', 100)->nullable();
            $table->string('SellingAgent',100)->nullable();
             // Foreign key constraints
            $table->foreign('BuyerID')->references('BuyerID')->on('buyers')->onDelete('set null');
            $table->foreign('ListingID')->references('ListingID')->on('listings')->onDelete('set null');

            $table->string('ResidListingAgent',100)->nullable();
            $table->string('ResidBuyerAgent', 100)->nullable();
            $table->string('DateOfOffer', 100)->nullable();
            $table->string('UnderContract', 100)->nullable();
            $table->float('OfferPrice', 8, 2)->nullable();
            $table->float('OffDeposit', 8, 2)->nullable();
            $table->float('OffAddlDep', 8, 2)->nullable();
            $table->float('OffBalDownPay', 8, 2)->nullable();
            $table->float('OffDownPay', 8, 2)->nullable();

            $table->string('OffAssump', 100)->nullable();
            $table->string('OffAssump2', 100)->nullable();
            $table->float('OffBalDue', 8, 2)->nullable();
            $table->float('OffPerMonth', 8, 2)->nullable();
            $table->float('OffInterest', 8, 2)->nullable();
            $table->string('OffAddTerms', 100)->nullable();
            $table->string('OffInvInc', 100)->nullable();
            $table->float('OffMaxInv', 8, 2)->nullable();

            $table->float('AccPrice', 8, 2)->nullable();
            $table->float('AccDeposit', 8, 2)->nullable();
            $table->float('AccAddlDep', 8, 2)->nullable();
            $table->float('AccBalDownPay', 8, 2)->nullable();
            $table->float('AccDownPay', 8, 2)->nullable();
            $table->string('AccAssump',100)->nullable();
            $table->string('AccAssump2', 100)->nullable();
            $table->float('AccBalDue', 8, 2)->nullable();
            $table->float('AccPerMonth', 8, 2)->nullable();
            $table->float('AccInt', 8, 2)->nullable();
            $table->string('AccAddTerm', 100)->nullable();
            
            $table->string('AccInvInc',100)->nullable();
            $table->string('AccMaxInv', 100)->nullable();
            $table->float('COfferPrice', 8, 2)->nullable();
            $table->float('COffDeposit', 8, 2)->nullable();
            $table->float('COffAddlDep', 8, 2)->nullable();
            $table->float('COffBalDownPay', 8, 2)->nullable();
            $table->float('COffDownPay', 8, 2)->nullable();
            $table->string('COffAssump',100)->nullable();
            $table->string('COffAssump2',100)->nullable();

            $table->float('COffBalDue', 8, 2)->nullable();
            $table->string('COffPerMonth',100)->nullable();
            $table->string('COffInterest',100)->nullable(); 
    
            $table->string('COffAddTerms', 100)->nullable();
            $table->string('COffInvInc', 100)->nullable();
            $table->string('COffMaxInv', 100)->nullable();
            $table->string('CloseDate',100)->nullable();
            $table->string('RealEstateInc', 100)->nullable();

            $table->float('REPrice',8, 2)->nullable();
            $table->string('RETerms', 100)->nullable();
            $table->float('REDownPay',8, 2)->nullable();
            $table->float('REBal', 8, 2)->nullable();
            $table->string('OpToBuy', 100)->nullable();
            $table->float('OpPrice', 8, 2)->nullable();
            $table->string('OpTerms', 100)->nullable();
            $table->float('OpDownPay', 8, 2)->nullable();
            $table->float('OpBal', 8, 2)->nullable();

            $table->string('LeaseTerm',100)->nullable();
            $table->string('LeaseNoYears', 100)->nullable();
            $table->string('LeaseDolMonth', 100)->nullable();
            $table->string('LeaseOptions', 100)->nullable();
            $table->string('AddAdj', 100)->nullable();


            $table->text('Contingencies')->nullable();
            $table->text('Comments')->nullable();
            $table->string('Commission', 100)->nullable();
            $table->string('CommissionPct', 100)->nullable();
            $table->string('Status', 100)->nullable();
            $table->string('ExpDate', 100)->nullable();
            $table->string('AccDate', 100)->nullable();
            $table->string('DateEntered', 100)->nullable();
            $table->string('EnteredBy', 100)->nullable();
            $table->string('SAttnID', 100)->nullable();
            $table->string('BAttnID', 100)->nullable();
            $table->string('PartID', 100)->nullable();
            $table->string('ClosingDate', 100)->nullable();

            $table->float('PurchasePrice', 8, 2)->nullable();
            $table->float('DownPaymnt', 8, 2)->nullable();
            $table->float('BalanceDue', 8, 2)->nullable();


            $table->integer('BAcctID')->default(0);
            $table->integer('SAcctID')->default(0);
            $table->integer('RefID')->default(0);
            $table->float('RefFee', 8, 2)->nullable();
            $table->integer('LLID')->default(0);


            $table->float('TransAmt', 8, 2)->nullable();
            $table->string('DepositCheckNumber', 100)->nullable();
            $table->float('CheckAmt', 8, 2)->nullable();
            $table->string('BankDraw', 100)->nullable();
            $table->string('DateDeposited', 100)->nullable();
            $table->string('RealEstateTrans', 100)->nullable();
            $table->string('CheckReturned', 100)->nullable();
            $table->string('CheckEBBReturnNumber', 100)->nullable();
            $table->string('CheckReturnedTo', 100)->nullable();
            $table->string('ReturneeRelationship', 100)->nullable();
            $table->string('ReturneeName', 100)->nullable();
            $table->string('ReturneeAddress', 100)->nullable();
            $table->string('ReturneeCity', 100)->nullable();
            $table->string('ReturneeState', 100)->nullable();
            $table->string('ReturneeZip', 100)->nullable();
            $table->string('ReturneePhone', 100)->nullable();
            $table->string('DBA', 100)->nullable();
            $table->string('Bounced', 100)->nullable();
            $table->string('BounceReason', 100)->nullable();
            $table->string('CheckOnHold', 100)->nullable();
            $table->string('NameOnCheck', 100)->nullable();
            $table->string('SchedCloseDate', 100)->nullable();
            $table->string('SchedCloseTime', 100)->nullable();
            $table->string('SchedClosePlace', 100)->nullable();
            $table->string('AttorneyLetters', 100)->nullable();
            $table->string('AnticipationLetters', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
