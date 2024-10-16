<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('ListingID');
            $table->string('SellerCorpName', 100)->nullable();
            $table->string('SellerLName', 100)->nullable();
            $table->string('SellerFName', 100)->nullable();
            $table->text('SHomeAdd1')->nullable();
            $table->text('SHomeAdd2')->nullable();
            $table->string('SCity', 100)->nullable();
            $table->string('SState', 100)->nullable();
            $table->string('SZip', 100)->nullable();
            $table->string('SHomePh', 100)->nullable();
            $table->string('SHomeFax', 100)->nullable();
            $table->string('Pager', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->integer('BusCategory');
            $table->string('BusType', 100)->nullable();
            $table->integer('SubCat');
            $table->string('Address1', 100)->nullable();
            $table->string('Address2', 100)->nullable();
            $table->string('City', 100)->nullable();
            $table->string('State', 100)->nullable();
            $table->integer('Zip')->nullable();
            $table->string('County', 100)->nullable();
            $table->string('Group', 100)->nullable();
            $table->bigInteger('Phone')->nullable();
            $table->bigInteger('Fax')->nullable();
            $table->string('CorpName', 100)->nullable();
            $table->string('DBA', 100)->nullable();
            $table->string('BldgSize', 100)->nullable();
            $table->string('Seats', 100)->nullable();
            $table->string('FTEmp', 100)->nullable();
            $table->string('PTEmp', 100)->nullable();
            $table->string('AnnPayroll', 100)->nullable();
            $table->string('LicenseReq', 100)->nullable();
            $table->string('Parking', 100)->nullable();
            $table->string('NoDaysOpen', 100)->nullable();
            $table->string('HoursOfOp', 100)->nullable();
            $table->string('BaseMonthRent', 100)->nullable();
            $table->string('AnnRent', 100)->nullable();
            $table->string('LeaseTerms', 100)->nullable();
            $table->string('LeaseOpt', 100)->nullable();
            $table->string('Basement', 100)->nullable();
            $table->string('BaseSize', 100)->nullable();
            $table->string('MgtAgentName', 100)->nullable();
            $table->string('MgtAgentPh', 100)->nullable();
            $table->string('RefAgentID', 100)->nullable();
            $table->string('RefAgentPh', 100)->nullable();
            $table->string('YrsEstablished')->nullable();
            $table->string('YrsPresentOwner', 100)->nullable();
            $table->string('Inventory', 100)->nullable();
            $table->string('AnnualSales', 100)->nullable();
            $table->string('AnnualNetProfit', 100)->nullable();
            $table->string('PurPrice', 100)->nullable();
            $table->string('DownPay', 100)->nullable();
            $table->string('ListPrice', 100)->nullable();
            $table->string('Balance', 100)->nullable();
            $table->string('Interest', 100)->nullable();
            $table->string('AddTerm', 100)->nullable();
            $table->string('SaleReas', 100)->nullable();
            $table->string('Highlights', 100)->nullable();
            $table->string('Comments', 100)->nullable();
            $table->string('Directions', 100)->nullable();
            $table->string('AgentID', 100)->nullable();
            $table->string('ListDate', 100)->nullable();
            $table->string('ExpDate', 100)->nullable();
            $table->string('Commission', 100)->nullable();
            $table->string('FlatFee', 100)->nullable();
            $table->string('ListType', 100)->nullable();
            $table->string('SoldEBB', 100)->nullable();
            $table->tinyInteger('Active')->default('0')->change();
            $table->string('COGFood', 100)->nullable();
            $table->string('COGBeverage', 100)->nullable();
            $table->string('COGOther', 100)->nullable();
            $table->string('COG1Label', 100)->nullable();
            $table->string('COG1', 100)->nullable();
            $table->string('COG2Label', 100)->nullable();
            $table->string('COG2', 100)->nullable();
            $table->string('COG3Label', 100)->nullable();
            $table->string('COG3', 100)->nullable();
            $table->string('CommonAreaMaint', 100)->nullable();
            $table->string('Advertising', 100)->nullable();
            $table->string('LicFee', 100)->nullable();
            $table->string('Telephone', 100)->nullable();
            $table->string('Utilities', 100)->nullable();
            $table->string('PayrollTax', 100)->nullable();
            $table->string('RealEstateTax', 100)->nullable();
            $table->string('Insurance', 100)->nullable();
            $table->string('AcctLeg', 100)->nullable();
            $table->string('Opt2', 100)->nullable();
            $table->string('Opt2Label', 100)->nullable();
            $table->string('Maintenance', 100)->nullable();
            $table->string('Opt1', 100)->nullable();
            $table->string('Opt1Label', 100)->nullable();
            $table->string('Trash', 100)->nullable();
            $table->string('Other', 100)->nullable();
            $table->string('OtherInc', 100)->nullable();
            $table->string('Product', 100)->nullable();
            $table->string('RealEstate', 100)->nullable();
            $table->string('REAskingPrice', 100)->nullable();
            $table->string('ToBuy', 100)->nullable();
            $table->string('InvInPrice', 100)->nullable();
            $table->string('InvNot', 100)->nullable();
            $table->string('DateEntered', 100)->nullable();
            $table->string('EnteredBy', 100)->nullable();
            $table->string('DateModified', 100)->nullable();
            $table->string('ModType', 100)->nullable();
            $table->string('Franchise', 100)->nullable();
            $table->string('UntilSold', 100)->nullable();
            $table->string('IntSell', 100)->nullable();
            $table->string('BestBuy', 100)->nullable();
            $table->string('SIC', 100)->nullable();
            $table->string('FedID', 100)->nullable();
            $table->string('YearInc', 100)->nullable();
            $table->string('fsbo', 100)->nullable();
            $table->string('featured', 100)->nullable();
            $table->string('imagepath', 100)->nullable();
            $table->string('LeadID', 100)->nullable();
            $table->string('Welcome', 100)->nullable();
            $table->string('CoBrokID', 100)->nullable();
            $table->string('Review', 100)->nullable();
            $table->string('DisplayImage', 100)->nullable();
            $table->string('DisplayID', 100)->nullable();
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
        Schema::dropIfExists('listings');
    }
}
