@extends('admin.layout.master')
@section('content')
<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
    <div class="next-back-page d-flex justify-content-between">
        @if ($previous)
            <a href="{{ route('show.offer', $previous->OfferID) }}"><button><i class="fa fa-chevron-left"></i>Back</button></a>
        @endif

        @if ($next)
            <a href="{{ route('show.offer', $next->OfferID) }}"><button>Next <i class="fa fa-chevron-right"></i></button></a>
        @endif
        
        
    </div>
</div>
<div class="container-fluid content bg-light">
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="profile-info">
                <div class="text-end">
                  <a href="{{route('edit.offer.form',$offer->OfferID)}}"><i  class="fa fa-edit edit-icon"></i></a>
                </div>
                <div class="text-center">
                <img id="avatar-preview" src="{{ asset('assets/images/user.png') }}" alt="Avatar Preview" width="100">
                  <h5>{{ $company_name[$offer->ListingID] ?? 'N/A' }}</h5>
                  <h6>Offer ID: {{$offer->OfferID}}</h6>
                </div>
                <div class="table-responsive">
                  <div>
                    <h6>General Info</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/buyer.png') }}" alt=""><span class="ml-2 fw-600">Buyer</span></td>
                        <td class="text-end">{{ $buyer_name[$offer->BuyerID] ?? 'N/A' }}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/seller.png') }}" alt=""><span class="ml-2 fw-600">Seller</span></td>
                        <td class="text-end"></td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/listing_date.png') }}" alt=""><span class="ml-2 fw-600">Listing Agent</span></td>
                        <td class="text-end">{{$offer->ListingAgent}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Selling Agent</span></td>
                        <td class="text-end">{{$offer->SellingAgent}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span class="ml-2 fw-600">Date of Offers</span></td>
                        <td class="text-end">{{$offer->DateOfOffer}}</td>
                      </tr>


                      <tr>
                        <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span class="ml-2 fw-600">Exp. Date</span></td>
                        <td class="text-end">{{$offer->ExpDate}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span class="ml-2 fw-600">Acc Date</span></td>
                        <td class="text-end">{{$offer->AccDate}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/ad_date.png') }}" alt=""><span class="ml-2 fw-600">Close Date</span></td>
                        <td class="text-end">{{$offer->ClosingDate}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Purchase Price</span></td>
                        <td class="text-end">{{$offer->PurchasePrice}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Down Payment</span></td>
                        <td class="text-end">{{$offer->DownPaymnt}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Comm. Amount</span></td>
                        <td class="text-end">{{$offer->Commission}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Commission</span></td>
                        <td class="text-end">{{$offer->CommissionPct}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Balance Due</span></td>
                        <td class="text-end">{{$offer->BalanceDue}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Offer</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><img src="{{ url('assets/images/off_price.png') }}" alt=""><span class="ml-2 fw-600">Price</span></td>
                            <td class="text-end">{{$offer->OfferPrice}}</td>
                        </tr>
                        <tr>
                        <td><img src="{{ url('assets/images/deposit.png') }}" alt=""><span class="ml-2 fw-600">Deposit</span></td>
                        <td class="text-end">{{$offer->OffDeposit}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/add_deposit.png') }}" alt=""><span class="ml-2 fw-600">Add. Deposit</span></td>
                        <td class="text-end">{{$offer->OffAddlDep}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Down. Pay. Bal</span></td>
                        <td class="text-end">{{$offer->OffBalDownPay}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Total Down Pay</span></td>
                        <td class="text-end">{{$offer->BuyerID}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/assumation.png') }}" alt=""><span class="ml-2 fw-600">Assumption</span></td>
                        <td class="text-end">{{$offer->OffAssump}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/assumation.png') }}" alt=""><span class="ml-2 fw-600">Add. Assumption</span></td>
                        <td class="text-end">{{$offer->OffAssump2}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Balance Due</span></td>
                        <td class="text-end">{{$offer->OffBalDue}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""><span class="ml-2 fw-600">Per Month</span></td>
                        <td class="text-end">{{$offer->OffPerMonth}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Interest</span></td>
                        <td class="text-end">{{$offer->OffInterest}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Add. Term</span></td>
                        <td class="text-end">{{$offer->OffAddTerms}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/inventory.png') }}" alt=""><span class="ml-2 fw-600">Inventory</span></td>
                        <td class="text-end">{{$offer->inventory}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/inventory.png') }}" alt=""><span class="ml-2 fw-600">Max. Inventory</span></td>
                        <td class="text-end">{{$offer->inventory}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Escrow</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><img src="{{ url('assets/images/real_state.png') }}" alt=""><span class="ml-2 fw-600">Real Estate Transaction</span></td>
                            <td class="text-end">{{$offer->RealEstateTrans}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Deposit Check</span></td>
                            <td class="text-end">{{$offer->DepositCheckNumber}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/bank.png') }}" alt=""><span class="ml-2 fw-600">Bank</span></td>
                            <td class="text-end">{{$offer->BankDraw}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Date Deposited</span></td>
                            <td class="text-end">{{$offer->DateDeposited}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Name on Check</span></td>
                            <td class="text-end">{{$offer->NameOnCheck}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Check on Hold</span></td>
                            <td class="text-end">{{$offer->CheckOnHold}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Bounced</span></td>
                            <td class="text-end">{{$offer->Bounced}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Reason</span></td>
                            <td class="text-end">{{$offer->BounceReason}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""><span class="ml-2 fw-600">Ammount</span></td>
                            <td class="text-end">{{$offer->CheckAmt}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Date Returned</span></td>
                            <td class="text-end">{{$offer->CheckReturned}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Return Check</span></td>
                            <td class="text-end">{{$offer->CheckEBBReturnNumber}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Check Returned To</span></td>
                            <td class="text-end">{{$offer->CheckReturnedTo}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/Vector.png') }}" alt=""><span class="ml-2 fw-600">Relationship</span></td>
                            <td class="text-end">{{$offer->ReturneeRelationship}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                            <td class="text-end">{{$offer->ReturneeAddress}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">City</span></td>
                            <td class="text-end">{{$offer->ReturneeCity}}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                            <td class="text-end">{{$offer->ReturneePhone}}</td>
                        </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Contacts</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td><img src="{{ url('assets/images/buyer.png') }}" alt=""><span class="ml-2 fw-600">Buyer Attorney</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/seller.png') }}" alt=""><span class="ml-2 fw-600">Seller Attorney</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/accountant.png') }}" alt=""><span class="ml-2 fw-600">Buyer Accountant</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/accountant.png') }}" alt=""><span class="ml-2 fw-600">Seller Accountant</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/landlord.png') }}" alt=""><span class="ml-2 fw-600">Landlord</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/referral.png') }}" alt=""><span class="ml-2 fw-600">Referral</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/referral.png') }}" alt=""><span class="ml-2 fw-600">Referral Fee Paid</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""><span class="ml-2 fw-600">Sched. Close Date</span></td>
                        <td class="text-end">{{$offer->SchedCloseDate}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/time.png') }}" alt=""><span class="ml-2 fw-600">Sched. Close Time</span></td>
                        <td class="text-end">{{$offer->SchedCloseTime}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Closing Place</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Closing Anticipation</span></td>
                        <td class="text-end"></td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/check.png') }}" alt=""><span class="ml-2 fw-600">Attorney Letters</span></td>
                        <td class="text-end">{{$offer->AttorneyLetters}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/Vector.png') }}" alt=""><span class="ml-2 fw-600">Letters Sent</span></td>
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
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Price</span></td>
                        <td class="text-end">{{$offer->REPrice}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/term.png') }}" alt=""><span class="ml-2 fw-600">Terms</span></td>
                        <td class="text-end">{{$offer->RETerms}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Down Pay</span></td>
                        <td class="text-end">{{$offer->REDownPay}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Balance</span></td>
                        <td class="text-end">{{$offer->REBal}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/lease_term.png') }}" alt=""><span class="ml-2 fw-600">Lease Terms</span></td>
                        <td class="text-end">{{$offer->LeaseTerm}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""><span class="ml-2 fw-600">Option Years</span></td>
                        <td class="text-end">{{$offer->LeaseNoYears}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""><span class="ml-2 fw-600">Dol Month</span></td>
                        <td class="text-end">{{$offer->LeaseDolMonth}}</td>
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/lease_option.png') }}" alt=""><span class="ml-2 fw-600">Options</span></td>
                        <td class="text-end">{{$offer->LeaseOptions}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <h5>Activities</h5>
            </div>
            <div class="card-body scrollable-activity">
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
              <div class="activity mt-2">
                <div class="activity-title fw-bold">Unknown</div>
                <div class="activity-time"><small class="profile-time">12:00 Yesterday</small></div>
                <div class="activity-content ">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
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
      
      </script>
@endsection

