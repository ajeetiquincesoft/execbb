@extends('admin.layout.master')
@section('content')
    {{-- <div class="container-fluid content nextPreviousButtons">
        <div class="next-back-page d-flex justify-content-between align-items-center">

         
            <div>
                @if ($previous)
                    <a href="{{ route('show.offer', $previous->OfferID) }}" class="record-nav-btn previous-btn">
                        <span class="nav-icon">
                            <i class="fa fa-chevron-left"></i>
                        </span>
                        <span class="nav-text">
                            <small>Navigate</small>
                            <strong>Previous Record</strong>
                        </span>
                    </a>
                @endif
            </div>

        
            <div>
                @if ($next)
                    <a href="{{ route('show.offer', $next->OfferID) }}" class="record-nav-btn next-btn">
                        <span class="nav-text text-end">
                            <small>Navigate</small>
                            <strong>Next Record</strong>
                        </span>
                        <span class="nav-icon">
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>
                @endif
            </div>

        </div>
    </div> --}}
    {{--   <div class="container-fluid content bg-light">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="text-end">
                                <a href="{{ route('edit.offer.form', $offer->OfferID) }}"><i
                                        class="fa fa-edit edit-icon"></i></a>
                            </div>
                            <div class="text-center">
                                <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview"
                                    width="100">
                                <h5>{{ $company_name[$offer->ListingID] ?? 'N/A' }}</h5>
                                <h6>Offer ID: {{ $offer->OfferID }}</h6>
                            </div>
                            <div class="table-responsive">
                                <div>
                                    <h6>General Info</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/Hashtag.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Listing ID</span></td>
                                            <td class="text-end">{{ $offer->listing->ListingID ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/company.png') }}" alt=""><span
                                                    class="ml-2 fw-600">DBA</span></td>
                                            <td class="text-end">{{ $offer->listing->DBA ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/buyer.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Buyer</span></td>
                                            <td class="text-end">{{ $buyer_name[$offer->BuyerID] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/seller.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Seller</span></td>
                                            <td class="text-end"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/listing_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Listing Agent</span></td>
                                            <td class="text-end">{{ $offer->ListingAgent }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/email.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Selling Agent</span></td>
                                            <td class="text-end">{{ $offer->SellingAgent }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Date of Offers</span></td>
                                            <td class="text-end">{{ $offer->DateOfOffer }}</td>
                                        </tr>


                                        <tr>
                                            <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Exp. Date</span></td>
                                            <td class="text-end">{{ $offer->ExpDate }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Acc Date</span></td>
                                            <td class="text-end">{{ $offer->AccDate }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Close Date</span></td>
                                            <td class="text-end">{{ $offer->ClosingDate }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Purchase Price</span></td>
                                            <td class="text-end">{{ $offer->PurchasePrice }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Down Payment</span></td>
                                            <td class="text-end">{{ $offer->DownPaymnt }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Comm. Amount</span></td>
                                            <td class="text-end">{{ $offer->Commission }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Commission</span></td>
                                            <td class="text-end">{{ $offer->CommissionPct }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Balance Due</span></td>
                                            <td class="text-end">{{ $offer->BalanceDue }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <h6>Escrow</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                      
                                        <tr>
                                            <td>
                                                <img src="{{ url('assets/images/buyer.png') }}" alt="">
                                                <span class="ml-2 fw-600">Escrow Attorney</span>
                                            </td>

                                            <td class="text-end">
                                                {{ $offer->escrow_attorney == 1 ? 'Yes' : 'No' }}
                                            </td>
                                        </tr>

                                    
                                        @if ($offer->escrow_attorney == 1)
                                            <tr>
                                                <td>
                                                    <img src="{{ url('assets/images/buyer.png') }}" alt="">
                                                    <span class="ml-2 fw-600">Attorney</span>
                                                </td>

                                                <td class="text-end">
                                                    @if ($escrowAttorney)
                                                        {{ $escrowAttorney->FName }} {{ $escrowAttorney->LName }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td><img src="{{ url('assets/images/real_state.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Real Estate Transaction</span></td>
                                            <td class="text-end">{{ $offer->RealEstateTrans }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Deposit Check</span></td>
                                            <td class="text-end">{{ $offer->DepositCheckNumber }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/bank.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Bank</span></td>
                                            <td class="text-end">{{ $offer->BankDraw }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Date Deposited</span></td>
                                            <td class="text-end">{{ $offer->DateDeposited }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Name on Check</span></td>
                                            <td class="text-end">{{ $offer->NameOnCheck }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Check on Hold</span></td>
                                            <td class="text-end">{{ $offer->CheckOnHold }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Bounced</span></td>
                                            <td class="text-end">{{ $offer->Bounced }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Reason</span></td>
                                            <td class="text-end">{{ $offer->BounceReason }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/annual_net_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Ammount</span></td>
                                            <td class="text-end">{{ $offer->CheckAmt }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Date Returned</span></td>
                                            <td class="text-end">{{ $offer->CheckReturned }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Return Check</span></td>
                                            <td class="text-end">{{ $offer->CheckEBBReturnNumber }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Check Returned To</span></td>
                                            <td class="text-end">{{ $offer->CheckReturnedTo }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/Vector.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Relationship</span></td>
                                            <td class="text-end">{{ $offer->ReturneeRelationship }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Address</span></td>
                                            <td class="text-end">{{ $offer->ReturneeAddress }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span
                                                    class="ml-2 fw-600">City</span></td>
                                            <td class="text-end">{{ $offer->ReturneeCity }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Phone</span></td>
                                            <td class="text-end">{{ $offer->ReturneePhone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <h6>Contacts</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/buyer.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Buyer Attorney</span></td>
                                            <td class="text-end">{{ $offer->BuyerAttorney }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/seller.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Seller Attorney</span></td>
                                            <td class="text-end">{{ $offer->SellerAttorney }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/accountant.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Buyer Accountant</span></td>
                                            <td class="text-end">{{ $offer->BuyerAccountant }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/accountant.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Seller Accountant</span></td>
                                            <td class="text-end">{{ $offer->SellerAccountant }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/landlord.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Landlord</span></td>
                                            <td class="text-end">{{ $offer->Landlord }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/referral.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Referral</span></td>
                                            <td class="text-end">{{ $offer->Referral }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/referral.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Referral Fee Paid</span></td>
                                            <td class="text-end">{{ $offer->ReferralFeePaid }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/annual_net_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Sched. Close Date</span></td>
                                            <td class="text-end">{{ $offer->SchedCloseDate }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/time.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Sched. Close Time</span></td>
                                            <td class="text-end">{{ $offer->SchedCloseTime }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Closing Place</span></td>
                                            <td class="text-end"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Closing Anticipation</span></td>
                                            <td class="text-end"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Attorney Letters</span></td>
                                            <td class="text-end">{{ $offer->AttorneyLetters }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/Vector.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Letters Sent</span></td>
                                            <td class="text-end"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <h6>Property</h6>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Price</span></td>
                                            <td class="text-end">{{ $offer->REPrice }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/term.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Terms</span></td>
                                            <td class="text-end">{{ $offer->RETerms }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Down Pay</span></td>
                                            <td class="text-end">{{ $offer->REDownPay }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span
                                                    class="ml-2 fw-600">Balance</span></td>
                                            <td class="text-end">{{ $offer->REBal }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/lease_term.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Lease Terms</span></td>
                                            <td class="text-end">{{ $offer->LeaseTerm }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/annual_net_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Option Years</span></td>
                                            <td class="text-end">{{ $offer->LeaseNoYears }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/annual_net_profit.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Dol Month</span></td>
                                            <td class="text-end">{{ $offer->LeaseDolMonth }}</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ url('assets/images/lease_option.png') }}"
                                                    alt=""><span class="ml-2 fw-600">Options</span></td>
                                            <td class="text-end">{{ $offer->LeaseOptions }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-7">

             
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Offer Information</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/off_price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Price</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OfferPrice ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/deposit.png') }}" alt="">
                                            <span class="ml-2 fw-600">Deposit</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffDeposit ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/add_deposit.png') }}" alt="">
                                            <span class="ml-2 fw-600">Add. Deposit</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffAddlDep ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Down. Pay. Bal</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffBalDownPay ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/assumation.png') }}" alt="">
                                            <span class="ml-2 fw-600">Assumption</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffAssump ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/assumation.png') }}" alt="">
                                            <span class="ml-2 fw-600">Add. Assumption</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffAssump2 ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Balance Due</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffBalDue ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/annual_net_profit.png') }}" alt="">
                                            <span class="ml-2 fw-600">Per Month</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffPerMonth ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Interest</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffInterest ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Add. Term</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->OffAddTerms ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/inventory.png') }}" alt="">
                                            <span class="ml-2 fw-600">Inventory</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->inventory ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/inventory.png') }}" alt="">
                                            <span class="ml-2 fw-600">Max. Inventory</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->MaxInventory ?? 'N/A' }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


              
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Counter Offer Information</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/off_price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Price</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COfferPrice ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/deposit.png') }}" alt="">
                                            <span class="ml-2 fw-600">Deposit</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffDeposit ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/add_deposit.png') }}" alt="">
                                            <span class="ml-2 fw-600">Add. Deposit</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffAddlDep ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Down. Pay. Bal</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffBalDownPay ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/assumation.png') }}" alt="">
                                            <span class="ml-2 fw-600">Assumption</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffAssump ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/assumation.png') }}" alt="">
                                            <span class="ml-2 fw-600">Add. Assumption</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffAssump2 ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Balance Due</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffBalDue ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/annual_net_profit.png') }}" alt="">
                                            <span class="ml-2 fw-600">Per Month</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffPerMonth ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Interest</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffInterest ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/price.png') }}" alt="">
                                            <span class="ml-2 fw-600">Add. Term</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffAddTerms ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/inventory.png') }}" alt="">
                                            <span class="ml-2 fw-600">Inventory</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffInvInc ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ url('assets/images/inventory.png') }}" alt="">
                                            <span class="ml-2 fw-600">Max. Inventory</span>
                                        </td>
                                        <td class="text-end">
                                            {{ $offer->COffMaxInv ?? 'N/A' }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
    {{--   <script>
        function previewImage(event) {
            const preview = document.getElementById('avatar-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    $('.avatar_img_upload').show();
                }
                reader.readAsDataURL(file);
            }
        }
    </script> --}}

    <style>
        .listing-page {
            --lp-maroon: #790b32;
            --lp-maroon-dark: #5e0826;
            --lp-ink: #17243a;
            --lp-muted: #718096;
            --lp-border: #dfe5ee;
            --lp-bg: #f4f6fa;
            /*  background: var(--lp-bg); */
            padding: 22px 28px 36px;
            color: var(--lp-ink);
            min-height: calc(100vh - 80px)
        }

        .listing-page * {
            box-sizing: border-box
        }

        .listing-page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin: 0 auto 24px;
            max-width: 1600px
        }

        .back-link {
            font-size: 13px;
            color: #667b98;
            text-decoration: none;
            display: inline-flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 10px
        }

        .back-link:hover {
            color: var(--lp-maroon)
        }

        .listing-page-header h1 {
            font-size: 25px;
            line-height: 1.25;
            font-weight: 750;
            margin: 0 0 6px;
            color: var(--lp-ink)
        }

        .listing-page-header p {
            font-size: 13px;
            color: var(--lp-muted);
            margin: 0
        }

        .header-dot {
            padding: 0 5px;
            color: #a4adba
        }

        .btn-outline-maroon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid var(--lp-maroon);
            border-radius: 7px;
            padding: 10px 15px;
            background: transparent;
            color: var(--lp-maroon);
            text-decoration: none;
            font-size: 14px;
            line-height: 1.25;
            white-space: nowrap;
            transition: background .2s, color .2s, border-color .2s;
            cursor: pointer
        }

        .btn-outline-maroon:hover {
            background: var(--lp-maroon);
            color: #fff;
            border-color: var(--lp-maroon)
        }

        .btn-small {
            padding: 8px 11px;
            font-size: 12px
        }

        .listing-layout {
            max-width: 1600px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(290px, 1fr);
            gap: 16px;
            align-items: start
        }

        .listing-main-column,
        .listing-side-column {
            display: grid;
            gap: 16px;
            min-width: 0
        }

        .listing-card {
            background: #fff;
            border: 1px solid var(--lp-border);
            border-radius: 13px;
            padding: 24px;
            box-shadow: 0 2px 5px rgba(22, 34, 55, .025);
            min-width: 0
        }

        .listing-card h2 {
            font-size: 17px;
            line-height: 1.35;
            font-weight: 750;
            color: var(--lp-ink);
            margin: 0 0 15px
        }

        .asking-topline {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px
        }

        .eyebrow,
        .financial-item span,
        .side-info-item span {
            display: block;
            font-size: 12px;
            color: var(--lp-muted);
            margin-bottom: 5px
        }

        .asking-price {
            font-size: 38px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.7px;
            color: #101d32
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            border-radius: 6px;
            background: #f8edf1;
            color: var(--lp-maroon);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 9px;
            margin-top: 1px
        }

        .card-rule {
            height: 1px;
            background: #e1e5eb;
            margin: 18px 0
        }

        .asking-card h2 {
            margin-bottom: 7px
        }

        .overview-copy {
            font-size: 13px;
            line-height: 1.7;
            color: #667b98;
            margin: 0
        }

        .document-link {
            display: inline-flex;
            gap: 7px;
            align-items: center;
            margin-top: 14px;
            color: var(--lp-maroon);
            font-size: 13px;
            text-decoration: none
        }

        .document-link:hover {
            text-decoration: underline
        }

        .financial-card h2 {
            margin-bottom: 20px
        }

        .financial-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px
        }

        .financial-item {
            min-width: 0
        }

        .financial-item strong {
            font-size: 19px;
            font-weight: 750;
            line-height: 1.35;
            color: #101d32;
            overflow-wrap: anywhere
        }

        .side-card h2 {
            font-size: 16px;
            margin-bottom: 18px
        }

        .side-info-item {
            margin-bottom: 17px
        }

        .side-info-item:last-child {
            margin-bottom: 0
        }

        .side-info-item strong {
            display: block;
            font-size: 13px;
            font-weight: 650;
            color: #152238;
            overflow-wrap: anywhere
        }

        .section-heading-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 4px
        }

        .section-heading-row h2 {
            margin-bottom: 14px
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 28px
        }

        .detail-group h3 {
            font-size: 14px;
            font-weight: 750;
            padding-bottom: 10px;
            margin: 0 0 3px;
            border-bottom: 1px solid #edf0f4;
            color: #24334a
        }

        .detail-list {
            margin: 0
        }

        .detail-list>div {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f2f6
        }

        .detail-list>div:last-child {
            border-bottom: 0
        }

        .detail-list dt {
            font-size: 12px;
            font-weight: 500;
            color: var(--lp-muted);
            margin: 0
        }

        .detail-list dd {
            font-size: 12px;
            font-weight: 650;
            color: #1b2940;
            text-align: right;
            margin: 0;
            max-width: 60%;
            overflow-wrap: anywhere
        }

        .image-card form {
            display: flex;
            flex-direction: column;
            align-items: stretch
        }

        .listing-image-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 170px;
            border: 1px dashed #d7deea;
            border-radius: 10px;
            background: #f8f9fc;
            overflow: hidden;
            cursor: pointer;
            margin: 0 0 12px
        }

        .listing-image-preview img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain
        }

        .image-card input[type=file] {
            font-size: 12px;
            max-width: 100%;
            margin: 0 0 8px;
            color: #58677c
        }

        .listing-image-error {
            font-size: 12px;
            color: #dc3545;
            margin: 0 0 8px
        }

        .upload-button {
            width: 100%
        }

        .image-help {
            font-size: 11px;
            color: var(--lp-muted);
            margin: 10px 0 0;
            text-align: center
        }

        .workflow-copy {
            font-size: 12px;
            line-height: 1.6;
            color: var(--lp-muted);
            margin: -7px 0 14px
        }

        .workflow-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 39px;
            padding: 9px 12px;
            margin-top: 8px;
            border: 1px solid var(--lp-maroon);
            border-radius: 7px;
            color: var(--lp-maroon);
            text-decoration: none;
            font-size: 13px;
            background: #fff;
            transition: background .2s, color .2s
        }

        .workflow-button:hover {
            background: var(--lp-maroon);
            color: #fff
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 0;
            border-top: 1px solid #edf0f4;
            color: #26354b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600
        }

        .quick-action:first-of-type {
            border-top: 0;
            padding-top: 0
        }

        .quick-action>span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 31px;
            height: 31px;
            border-radius: 8px;
            background: #f8edf1;
            color: var(--lp-maroon)
        }

        .quick-action>.fa-chevron-right {
            margin-left: auto;
            font-size: 11px;
            color: #9aa5b5
        }

        .quick-action:hover {
            color: var(--lp-maroon)
        }

        @media(max-width:1100px) {
            .listing-layout {
                grid-template-columns: minmax(0, 1.5fr) minmax(260px, 1fr)
            }

            .financial-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                row-gap: 18px
            }
        }

        @media(max-width:767px) {
            .listing-page {
                padding: 16px 12px 26px
            }

            .listing-page-header {
                margin-bottom: 18px
            }

            .listing-page-header h1 {
                font-size: 21px
            }

            .listing-page-header>.btn-outline-maroon {
                padding: 9px 10px;
                font-size: 12px
            }

            .listing-layout {
                grid-template-columns: 1fr
            }

            .listing-main-column {
                order: 1
            }

            .listing-side-column {
                order: 2
            }

            .listing-card {
                padding: 18px
            }

            .asking-price {
                font-size: 32px
            }

            .financial-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 20px
            }

            .section-heading-row {
                align-items: flex-start;
                flex-wrap: wrap
            }
        }

        @media(max-width:420px) {
            .listing-page-header {
                gap: 10px
            }

            .listing-page-header h1 {
                font-size: 19px
            }

            .listing-page-header>.btn-outline-maroon {
                font-size: 11px;
                padding: 8px
            }

            .financial-item strong {
                font-size: 17px
            }
        }
    </style>
    <div class="listing-page container-fluid">
        <div class="listing-page-header">
            <div>
                <h1>Offer details</h1>
                <p>
                    Offer #{{ $offer->OfferID }}
                    <span class="header-dot">·</span>
                    {{ $company_name[$offer->ListingID] ?? ($offer->listing->DBA ?? 'Offer information') }}
                </p>
            </div>
            <a href="{{ route('edit.offer.form', $offer->OfferID) }}" class="btn-outline-maroon">
                <i class="fa fa-pencil"></i> Edit offer
            </a>
        </div>

        <div class="d-flex justify-content-between align-items-center gap-3 mb-4 flex-wrap">
            <div>
                @if ($previous)
                    <a href="{{ route('show.offer', $previous->OfferID) }}" class="btn-outline-maroon btn-small">
                        <i class="fa fa-chevron-left"></i> Previous offer
                    </a>
                @endif
            </div>
            <div>
                @if ($next)
                    <a href="{{ route('show.offer', $next->OfferID) }}" class="btn-outline-maroon btn-small">
                        Next offer <i class="fa fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        </div>

        <div class="listing-layout">
            <main class="listing-main-column">
                <section class="listing-card asking-card">
                    <div class="asking-topline">
                        <div>
                            <span class="eyebrow">Offer overview</span>
                            <div class="asking-price">
                                {{ $company_name[$offer->ListingID] ?? ($offer->listing->DBA ?? 'Offer details') }}
                            </div>
                        </div>
                        <span class="status-pill">Offer #{{ $offer->OfferID }}</span>
                    </div>
                    <div class="card-rule"></div>
                    <h2>Transaction overview</h2>
                    <p class="overview-copy">
                        This offer is associated with listing
                        {{ $offer->listing->ListingID ?? 'N/A' }} and buyer
                        {{ $buyer_name[$offer->BuyerID] ?? 'N/A' }}.
                    </p>
                </section>

                <section class="listing-card details-card">
                    <h2>General information</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Listing and transaction</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Listing ID</dt>
                                    <dd>{{ $offer->listing->ListingID ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>DBA</dt>
                                    <dd>{{ $offer->listing->DBA ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Buyer</dt>
                                    <dd>{{ $buyer_name[$offer->BuyerID] ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt>Seller</dt>
                                    <dd>{{ '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Listing agent</dt>
                                    <dd>{{ $offer->ListingAgent ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Selling agent</dt>
                                    <dd>{{ $offer->SellingAgent ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Date of offer</dt>
                                    <dd>{{ $offer->DateOfOffer ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Expiration date</dt>
                                    <dd>{{ $offer->ExpDate ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Acceptance date</dt>
                                    <dd>{{ $offer->AccDate ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Closing date</dt>
                                    <dd>{{ $offer->ClosingDate ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Financial summary</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Purchase price</dt>
                                    <dd>{{ $offer->PurchasePrice ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Down payment</dt>
                                    <dd>{{ $offer->DownPaymnt ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Commission amount</dt>
                                    <dd>{{ $offer->Commission ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Commission</dt>
                                    <dd>{{ $offer->CommissionPct ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Balance due</dt>
                                    <dd>{{ $offer->BalanceDue ?? '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <h2>Escrow information</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Escrow and deposit</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Escrow attorney</dt>
                                    <dd>{{ $offer->escrow_attorney == 1 ? 'Yes' : 'No' }}</dd>
                                </div>
                                <div>
                                    <dt>Attorney</dt>
                                    <dd>{{ $offer->escrow_attorney == 1 ? (isset($escrowAttorney) && $escrowAttorney ? trim($escrowAttorney->FName . ' ' . $escrowAttorney->LName) : 'N/A') : '—' }}
                                    </dd>
                                </div>
                                <div>
                                    <dt>Real estate transaction</dt>
                                    <dd>{{ $offer->RealEstateTrans ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Deposit check number</dt>
                                    <dd>{{ $offer->DepositCheckNumber ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Bank</dt>
                                    <dd>{{ $offer->BankDraw ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Date deposited</dt>
                                    <dd>{{ $offer->DateDeposited ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Name on check</dt>
                                    <dd>{{ $offer->NameOnCheck ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Check on hold</dt>
                                    <dd>{{ $offer->CheckOnHold ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Bounced</dt>
                                    <dd>{{ $offer->Bounced ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Bounce reason</dt>
                                    <dd>{{ $offer->BounceReason ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Returned check details</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Amount</dt>
                                    <dd>{{ $offer->CheckAmt ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Date returned</dt>
                                    <dd>{{ $offer->CheckReturned ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Return check number</dt>
                                    <dd>{{ $offer->CheckEBBReturnNumber ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Check returned to</dt>
                                    <dd>{{ $offer->CheckReturnedTo ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Relationship</dt>
                                    <dd>{{ $offer->ReturneeRelationship ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Address</dt>
                                    <dd>{{ $offer->ReturneeAddress ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>City</dt>
                                    <dd>{{ $offer->ReturneeCity ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Phone</dt>
                                    <dd>{{ $offer->ReturneePhone ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <h2>Contact information</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Professional contacts</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Buyer attorney</dt>
                                    <dd>{{ $offer->BuyerAttorney ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Seller attorney</dt>
                                    <dd>{{ $offer->SellerAttorney ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Buyer accountant</dt>
                                    <dd>{{ $offer->BuyerAccountant ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Seller accountant</dt>
                                    <dd>{{ $offer->SellerAccountant ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Landlord</dt>
                                    <dd>{{ $offer->Landlord ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Referral</dt>
                                    <dd>{{ $offer->Referral ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Closing details</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Referral fee paid</dt>
                                    <dd>{{ $offer->ReferralFeePaid ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Scheduled close date</dt>
                                    <dd>{{ $offer->SchedCloseDate ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Scheduled close time</dt>
                                    <dd>{{ $offer->SchedCloseTime ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Closing place</dt>
                                    <dd>{{ '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Closing anticipation</dt>
                                    <dd>{{ '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Attorney letters</dt>
                                    <dd>{{ $offer->AttorneyLetters ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Letters sent</dt>
                                    <dd>{{ '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <section class="listing-card details-card">
                    <h2>Property information</h2>
                    <div class="details-grid">
                        <div class="detail-group">
                            <h3>Real estate terms</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Price</dt>
                                    <dd>{{ $offer->REPrice ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Terms</dt>
                                    <dd>{{ $offer->RETerms ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Down payment</dt>
                                    <dd>{{ $offer->REDownPay ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Balance</dt>
                                    <dd>{{ $offer->REBal ?? '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="detail-group">
                            <h3>Lease information</h3>
                            <dl class="detail-list">
                                <div>
                                    <dt>Lease terms</dt>
                                    <dd>{{ $offer->LeaseTerm ?: '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Option years</dt>
                                    <dd>{{ $offer->LeaseNoYears ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Dollars per month</dt>
                                    <dd>{{ $offer->LeaseDolMonth ?? '—' }}</dd>
                                </div>
                                <div>
                                    <dt>Options</dt>
                                    <dd>{{ $offer->LeaseOptions ?: '—' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="listing-side-column">
                <section class="listing-card financial-card">
                    <h2>Offer information</h2>
                    <div class="financial-grid">
                        <div class="financial-item">
                            <span>Price</span>
                            <strong>{{ $offer->OfferPrice ?? 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Deposit</span>
                            <strong>{{ $offer->OffDeposit ?? 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Additional deposit</span>
                            <strong>{{ $offer->OffAddlDep ?? 'N/A' }}</strong>
                        </div>
                        <div class="financial-item">
                            <span>Down payment balance</span>
                            <strong>{{ $offer->OffBalDownPay ?? 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="card-rule"></div>
                    <dl class="detail-list">
                        <div>
                            <dt>Assumption</dt>
                            <dd>{{ $offer->OffAssump ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Additional assumption</dt>
                            <dd>{{ $offer->OffAssump2 ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Balance due</dt>
                            <dd>{{ $offer->OffBalDue ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Per month</dt>
                            <dd>{{ $offer->OffPerMonth ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Interest</dt>
                            <dd>{{ $offer->OffInterest ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Additional terms</dt>
                            <dd>{{ $offer->OffAddTerms ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Inventory</dt>
                            <dd>{{ $offer->inventory ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Maximum inventory</dt>
                            <dd>{{ $offer->MaxInventory ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="listing-card side-card">
                    <h2>Counter offer information</h2>
                    <dl class="detail-list">
                        <div>
                            <dt>Price</dt>
                            <dd>{{ $offer->COfferPrice ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Deposit</dt>
                            <dd>{{ $offer->COffDeposit ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Additional deposit</dt>
                            <dd>{{ $offer->COffAddlDep ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Down payment balance</dt>
                            <dd>{{ $offer->COffBalDownPay ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Assumption</dt>
                            <dd>{{ $offer->COffAssump ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Additional assumption</dt>
                            <dd>{{ $offer->COffAssump2 ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Balance due</dt>
                            <dd>{{ $offer->COffBalDue ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Per month</dt>
                            <dd>{{ $offer->COffPerMonth ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Interest</dt>
                            <dd>{{ $offer->COffInterest ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Additional terms</dt>
                            <dd>{{ $offer->COffAddTerms ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Inventory</dt>
                            <dd>{{ $offer->COffInvInc ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt>Maximum inventory</dt>
                            <dd>{{ $offer->COffMaxInv ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="listing-card side-card">
                    <h2>Quick actions</h2>
                    <a href="{{ route('edit.offer.form', $offer->OfferID) }}" class="quick-action">
                        <span><i class="fa fa-pencil"></i></span>
                        Edit offer
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </section>
            </aside>
        </div>
    </div>
@endsection
