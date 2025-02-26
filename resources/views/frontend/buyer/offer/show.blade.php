@extends('frontend.layout.buyer-master')
@section('content')
@php
$buyersImagePath = asset('assets/images/Buyers1.png');
@endphp
<div class="container">
    <div class="offer-details">
        <h2 class="offer-title">Offer Details</h2>
        <div class="bck-offer">
            <a href="{{ route('buyer.all.offer') }}" class="">Back to Offers</a>
        </div>
        <div class="offer-info">
            <div class="row">
                <!-- General Information Section -->
                <div class="col-md-6">
                    <div class="offer-card" style="background: url('{{ $buyersImagePath}}') center center;">
                        <h3 class="card-title">General Information</h3>
                        <div class="offer-item">
                            <span class="item-label">Offer ID:</span>
                            <span class="item-value">{{ $offer->OfferID }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Company Name:</span>
                            <span class="item-value">{{ $buyer_name[$offer->BuyerID] ?? 'N/A' }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Listing Agent:</span>
                            <span class="item-value">{{$offer->ListingAgent}}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Selling Agent:</span>
                            <span class="item-value">{{ $offer->SellingAgent }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Date of Offers:</span>
                            <span class="item-value">{{$offer->DateOfOffer}}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Exp. Date:</span>
                            <span class="item-value">{{ \Carbon\Carbon::parse($offer->ExpDate)->format('M d, Y') }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Acc. Date:</span>
                            <span class="item-value">{{ \Carbon\Carbon::parse($offer->AccDate)->format('M d, Y') }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Close Date:</span>
                            <span class="item-value">{{ \Carbon\Carbon::parse($offer->ClosingDate)->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Pricing Information Section -->
                <div class="col-md-6">
                    <div class="offer-card" style="background: url('{{ $buyersImagePath}}') center center;">
                        <h3 class="card-title">Pricing Information</h3>
                        <div class="offer-item">
                            <span class="item-label">Purchase Price:</span>
                            <span class="item-value">${{ number_format($offer->PurchasePrice, 2) }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Down Payment:</span>
                            <span class="item-value">${{ number_format($offer->DownPaymnt, 2) }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Comm. Amount:</span>
                            <span class="item-value">${{ number_format($offer->Commission, 2) }}</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Commission %:</span>
                            <span class="item-value">{{ $offer->CommissionPct }}%</span>
                        </div>
                        <div class="offer-item">
                            <span class="item-label">Balance Due:</span>
                            <span class="item-value">${{ number_format($offer->BalanceDue, 2) }}</span>
                        </div>
                    </div>
                </div>
                <!-- Offer Section -->
                <div class="col-md-6">
                    <div class="offer-card" style="background: url('{{ $buyersImagePath }}') center center;">
                        <h3 class="card-title">Offer Information</h3>

                        <!-- Price -->
                        <div class="offer-item">
                            <span class="item-label">Price:</span>
                            <span class="item-value">${{ number_format($offer->OfferPrice, 2) }}</span>
                        </div>

                        <!-- Deposit -->
                        <div class="offer-item">
                            <span class="item-label">Deposit:</span>
                            <span class="item-value">${{ number_format($offer->OffDeposit, 2) }}</span>
                        </div>

                        <!-- Add. Deposit -->
                        <div class="offer-item">
                            <span class="item-label">Add. Deposit:</span>
                            <span class="item-value">${{ number_format($offer->OffAddlDep, 2) }}</span>
                        </div>

                        <!-- Down Pay Balance -->
                        <div class="offer-item">
                            <span class="item-label">Down Pay. Bal:</span>
                            <span class="item-value">${{ number_format($offer->OffBalDownPay, 2) }}</span>
                        </div>
                        <!-- Assumption -->
                        <div class="offer-item">
                            <span class="item-label">Assumption:</span>
                            <span class="item-value">${{ number_format($offer->OffAssump, 2) }}</span>
                        </div>

                        <!-- Add. Assumption -->
                        <div class="offer-item">
                            <span class="item-label">Add. Assumption:</span>
                            <span class="item-value">${{ number_format($offer->OffAssump2, 2) }}</span>
                        </div>

                        <!-- Balance Due -->
                        <div class="offer-item">
                            <span class="item-label">Balance Due:</span>
                            <span class="item-value">${{ number_format($offer->OffBalDue, 2) }}</span>
                        </div>

                        <!-- Per Month -->
                        <div class="offer-item">
                            <span class="item-label">Per Month:</span>
                            <span class="item-value">${{ number_format($offer->OffPerMonth, 2) }}</span>
                        </div>

                        <!-- Interest -->
                        <div class="offer-item">
                            <span class="item-label">Interest:</span>
                            <span class="item-value">{{ $offer->OffInterest }}%</span>
                        </div>

                        <!-- Add. Term -->
                        <div class="offer-item">
                            <span class="item-label">Add. Term:</span>
                            <span class="item-value">{{ $offer->OffAddTerms }}</span>
                        </div>

                        <!-- Inventory -->
                        <div class="offer-item">
                            <span class="item-label">Inventory:</span>
                            <span class="item-value">{{ $offer->inventory }}</span>
                        </div>

                        <!-- Max. Inventory -->
                        <div class="offer-item">
                            <span class="item-label">Max. Inventory:</span>
                            <span class="item-value">{{ $offer->inventory }}</span>
                        </div>
                    </div>
                </div>

                <!-- Escrow Section -->
                <div class="col-md-6">
                    <div class="offer-card" style="background: url('{{ $buyersImagePath }}') center center;">
                        <h3 class="card-title">Escrow Information</h3>

                        <!-- Real Estate Transaction -->
                        <div class="offer-item">
                            <span class="item-label">Real Estate Transaction:</span>
                            <span class="item-value">{{ $offer->RealEstateTrans }}</span>
                        </div>

                        <!-- Deposit Check -->
                        <div class="offer-item">
                            <span class="item-label">Deposit Check:</span>
                            <span class="item-value">{{ $offer->DepositCheckNumber }}</span>
                        </div>

                        <!-- Bank -->
                        <div class="offer-item">
                            <span class="item-label">Bank:</span>
                            <span class="item-value">{{ $offer->BankDraw }}</span>
                        </div>

                        <!-- Date Deposited -->
                        <div class="offer-item">
                            <span class="item-label">Date Deposited:</span>
                            <span class="item-value">{{ $offer->DateDeposited }}</span>
                        </div>

                        <!-- Name on Check -->
                        <div class="offer-item">
                            <span class="item-label">Name on Check:</span>
                            <span class="item-value">{{ $offer->NameOnCheck }}</span>
                        </div>

                        <!-- Check on Hold -->
                        <div class="offer-item">
                            <span class="item-label">Check on Hold:</span>
                            <span class="item-value">{{ $offer->CheckOnHold }}</span>
                        </div>

                        <!-- Bounced -->
                        <div class="offer-item">
                            <span class="item-label">Bounced:</span>
                            <span class="item-value">{{ $offer->Bounced }}</span>
                        </div>

                        <!-- Reason -->
                        <div class="offer-item">
                            <span class="item-label">Reason:</span>
                            <span class="item-value">{{ $offer->BounceReason }}</span>
                        </div>

                        <!-- Amount -->
                        <div class="offer-item">
                            <span class="item-label">Amount:</span>
                            <span class="item-value">${{ number_format($offer->CheckAmt, 2) }}</span>
                        </div>

                        <!-- Date Returned -->
                        <div class="offer-item">
                            <span class="item-label">Date Returned:</span>
                            <span class="item-value">{{ $offer->CheckReturned }}</span>
                        </div>

                        <!-- Return Check -->
                        <div class="offer-item">
                            <span class="item-label">Return Check:</span>
                            <span class="item-value">{{ $offer->CheckEBBReturnNumber }}</span>
                        </div>

                        <!-- Check Returned To -->
                        <div class="offer-item">
                            <span class="item-label">Check Returned To:</span>
                            <span class="item-value">{{ $offer->CheckReturnedTo }}</span>
                        </div>

                        <!-- Relationship -->
                        <div class="offer-item">
                            <span class="item-label">Relationship:</span>
                            <span class="item-value">{{ $offer->ReturneeRelationship }}</span>
                        </div>

                        <!-- Address -->
                        <div class="offer-item">
                            <span class="item-label">Address:</span>
                            <span class="item-value">{{ $offer->ReturneeAddress }}</span>
                        </div>

                        <!-- City -->
                        <div class="offer-item">
                            <span class="item-label">City:</span>
                            <span class="item-value">{{ $offer->ReturneeCity }}</span>
                        </div>

                        <!-- Phone -->
                        <div class="offer-item">
                            <span class="item-label">Phone:</span>
                            <span class="item-value">{{ $offer->ReturneePhone }}</span>
                        </div>
                    </div>
                </div>

                <!-- Contacts Section -->
                <div class="col-md-6">
                    <div class="offer-card" style="background: url('{{ $buyersImagePath }}') center center;">
                        <h3 class="card-title">Contacts Information</h3>

                        <!-- Buyer Attorney -->
                        <div class="offer-item">
                            <span class="item-label">Buyer Attorney:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Seller Attorney -->
                        <div class="offer-item">
                            <span class="item-label">Seller Attorney:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Buyer Accountant -->
                        <div class="offer-item">
                            <span class="item-label">Buyer Accountant:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Seller Accountant -->
                        <div class="offer-item">
                            <span class="item-label">Seller Accountant:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Landlord -->
                        <div class="offer-item">
                            <span class="item-label">Landlord:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Referral -->
                        <div class="offer-item">
                            <span class="item-label">Referral:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Referral Fee Paid -->
                        <div class="offer-item">
                            <span class="item-label">Referral Fee Paid:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Scheduled Close Date -->
                        <div class="offer-item">
                            <span class="item-label">Scheduled Close Date:</span>
                            <span class="item-value">{{ $offer->SchedCloseDate }}</span>
                        </div>

                        <!-- Scheduled Close Time -->
                        <div class="offer-item">
                            <span class="item-label">Scheduled Close Time:</span>
                            <span class="item-value">{{ $offer->SchedCloseTime }}</span>
                        </div>

                        <!-- Closing Place -->
                        <div class="offer-item">
                            <span class="item-label">Closing Place:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Closing Anticipation -->
                        <div class="offer-item">
                            <span class="item-label">Closing Anticipation:</span>
                            <span class="item-value"></span>
                        </div>

                        <!-- Attorney Letters -->
                        <div class="offer-item">
                            <span class="item-label">Attorney Letters:</span>
                            <span class="item-value">{{ $offer->AttorneyLetters }}</span>
                        </div>

                        <!-- Letters Sent -->
                        <div class="offer-item">
                            <span class="item-label">Letters Sent:</span>
                            <span class="item-value"></span>
                        </div>
                    </div>
                </div>

                <!-- Property Section -->
                <div class="col-md-6">
                    <div class="offer-card" style="background: url('{{ $buyersImagePath }}') center center;">
                        <h3 class="card-title">Property Information</h3>

                        <!-- Price -->
                        <div class="offer-item">
                            <span class="item-label">Price:</span>
                            <span class="item-value">${{ number_format($offer->REPrice, 2) }}</span>
                        </div>

                        <!-- Terms -->
                        <div class="offer-item">
                            <span class="item-label">Terms:</span>
                            <span class="item-value">{{ $offer->RETerms }}</span>
                        </div>

                        <!-- Down Payment -->
                        <div class="offer-item">
                            <span class="item-label">Down Payment:</span>
                            <span class="item-value">${{ number_format($offer->REDownPay, 2) }}</span>
                        </div>

                        <!-- Balance -->
                        <div class="offer-item">
                            <span class="item-label">Balance:</span>
                            <span class="item-value">${{ number_format($offer->REBal, 2) }}</span>
                        </div>

                        <!-- Lease Terms -->
                        <div class="offer-item">
                            <span class="item-label">Lease Terms:</span>
                            <span class="item-value">{{ $offer->LeaseTerm }}</span>
                        </div>

                        <!-- Option Years -->
                        <div class="offer-item">
                            <span class="item-label">Option Years:</span>
                            <span class="item-value">{{ $offer->LeaseNoYears }}</span>
                        </div>

                        <!-- Dol Month -->
                        <div class="offer-item">
                            <span class="item-label">Dol Month:</span>
                            <span class="item-value">{{ $offer->LeaseDolMonth }}</span>
                        </div>

                        <!-- Options -->
                        <div class="offer-item">
                            <span class="item-label">Options:</span>
                            <span class="item-value">{{ $offer->LeaseOptions }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    /* General Layout */
    /* Offer Cards */
    .offer-card {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 1.6rem;
        margin-bottom: 20px;
        color: #5a102a;
        font-weight: bold;
    }

    /* Offer Items (Inline Structure) */
    .offer-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .offer-item .item-label {
        font-weight: bold;
        color: #555;
    }

    .offer-item .item-value {
        color: #333;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .offer-card {
            margin-bottom: 15px;
        }

        .offer-item {
            flex-direction: column;
        }

        .offer-item .item-label {
            margin-bottom: 5px;
        }
    }
</style>
@endsection