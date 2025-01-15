@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
    <div class="next-back-page d-flex justify-content-between">
        @if ($previous)
        <a href="{{ route('agent.show.listing', $previous->ListingID) }}"><button><i class="fa fa-chevron-left"></i></button></a>
        @endif

        @if ($next)
        <a href="{{ route('agent.show.listing', $next->ListingID) }}"><button><i class="fa fa-chevron-right"></i></button></a>
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
                  <a href="#"><i  class="fa fa-edit edit-icon"></i></a>
                </div>
                <div class="text-center">
                <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="avatar-upload">
                          <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                          <label for="avatar">
                          @if($listing->imagepath)
                              <img id="avatar-preview" src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" alt="Avatar Preview" class="avatar">
                              @else
                              <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}" alt="Avatar Preview" class="avatar">
                              @endif
                          </label>
                        </div>
                        <button class="avatar_img_upload" type="submit">Upload Image</button>
                    </form>
                  <h5>{{$listing->SellerFName}} {{$listing->SellerLName}}</h5>
                  <h6>Listing ID: {{$listing->ListingID  }}</h6>
                </div>
                <div class="table-responsive">
                  <div>
                    <h6>General Info</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/company.svg') }}" alt=""><span class="ml-2 fw-600">Company</span></td>
                        <td class="text-end">{{$listing->SellerCorpName}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/phone.png') }}" alt=""><span class="ml-2 fw-600">Phone</span></td>
                        <td class="text-end">{{$listing->Phone}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/email.png') }}" alt=""><span class="ml-2 fw-600">Email</span></td>
                        <td class="text-end">{{$listing->Email}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/fax.png') }}" alt=""><span class="ml-2 fw-600">fax</span></td>
                        <td class="text-end">{{$listing->Fax}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/location.png') }}" alt=""><span class="ml-2 fw-600">Address</span></td>
                        <td class="text-end">{{$listing->Address1}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Business</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/building.png') }}" alt=""><span class="ml-2 fw-600">Building Size</span></td>
                        <td class="text-end">{{$listing->BldgSize}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/parking.png') }}" alt=""><span class="ml-2 fw-600">Parking</span></td>
                        <td class="text-end">{{$listing->Parking}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/license.png') }}" alt=""><span class="ml-2 fw-600">License Required</span></td>
                        <td class="text-end">{{$listing->LicenseReq}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/base_month_rent.png') }}" alt=""><span class="ml-2 fw-600">Base Month Rent</span></td>
                        <td class="text-end">{{$listing->BaseMonthRent}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/house_of_operation.png') }}" alt=""><span class="ml-2 fw-600">House Of Operations</span></td>
                        <td class="text-end">{{$listing->HoursOfOp}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Pricing</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/listing_date.png') }}" alt=""><span class="ml-2 fw-600">Listing Date</span></td>
                        <td class="text-end">{{$listing->ListDate}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/exp_date.png') }}" alt=""><span class="ml-2 fw-600">Exp Date</span></td>
                        <td class="text-end">{{$listing->ExpDate}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/listing_type.png') }}" alt=""><span class="ml-2 fw-600">Listing Type</span></td>
                        <td class="text-end">{{$listing->ListType}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">List Price</span></td>
                        <td class="text-end">{{$listing->ListPrice}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Pur. Price</span></td>
                        <td class="text-end">{{$listing->PurPrice}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/price.png') }}" alt=""><span class="ml-2 fw-600">Down Pay</span></td>
                        <td class="text-end">{{$listing->DownPay}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div>
                    <h6>Financial</h6>
                  </div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><img src="{{ url('assets/images/annual_sale.png') }}" alt=""><span class="ml-2 fw-600">Annual Sales</span></td>
                        <td class="text-end">{{$listing->AnnualSales}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/gross_profit.png') }}" alt=""><span class="ml-2 fw-600">Gross Profit</span></td>
                        <td class="text-end">{{$listing->GrossProfit}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/total_expenses.png') }}" alt=""><span class="ml-2 fw-600">Total Expenses</span></td>
                        <td class="text-end">{{$listing->TotalExpenses}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/operating_profit.png') }}" alt=""><span class="ml-2 fw-600">Operating Profit</span></td>
                        <td class="text-end">{{$listing->AnnualNetProfit}}</td>
                      </tr>
                      <tr>
                        <td><img src="{{ url('assets/images/annual_net_profit.png') }}" alt=""><span class="ml-2 fw-600">Annual Net Profit</span></td>
                        <td class="text-end">{{$listing->AnnualNetProfit}}</td>
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
