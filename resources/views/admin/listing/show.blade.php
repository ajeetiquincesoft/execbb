@extends('admin.layout.master')
@section('content')
<div class="container-fluid content nextPreviousButtons">
  <div class="next-back-page d-flex justify-content-between">
    @if ($previous)
    <a href="{{ route('show.listing', $previous->ListingID) }}"><button><i class="fa fa-chevron-left"></i></button></a>
    @endif

    @if ($next)
    <a href="{{ route('show.listing', $next->ListingID) }}"><button><i class="fa fa-chevron-right"></i></button></a>
    @endif
  </div>
</div>
<div class="container-fluid content bg-light">
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-5 mb-5 mb-xl-0">
      <div class="card">
        <div class="card-body">
          <div class="profile-info">
            <div class="text-end">
              <a href="{{ route('edit.listing.form', $listing->ListingID) }}"><i class="fa fa-edit edit-icon"></i></a>
            </div>
            <div class="text-center">
              <form action="{{ route('upload.listing.avatar',$listing->ListingID ) }}" method="POST" enctype="multipart/form-data" id="listing_show_form">
                @csrf
                @method('PUT')
                <div class="avatar-upload">
                  <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                  <label for="avatar" class="circular-image">
                    @if($listing->imagepath)
                    <img id="avatar-preview" src="{{ asset('assets/uploads/images/' . $listing->imagepath) }}" alt="Avatar Preview" class="avatar">
                    @else
                    <img id="avatar-preview" src="{{ asset('assets/images/avatar.png') }}" alt="Avatar Preview" class="avatar">
                    @endif
                  </label>
                </div>
                <div id="listingImgError" style="color:#dc3545;"></div>
                <button class="avatar_img_upload" type="button" onclick="confirmImage(this.form)">Confirm Image</button>
              </form>
              <h5>{{$listing->SellerFName}} {{$listing->SellerLName}}</h5>
              <h6>Listing ID: {{$listing->ListingID }}</h6>
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
            @if(!empty($listing->document_path))
            <p class="mt-2">
              Listing Document File:
              <a href="{{ asset('storage/' . $listing->document_path) }}" target="_blank">View Document</a>
            </p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xl-7">
      <div class="card">
        <div class="card-header">
          <h5>Activities</h5>
        </div>
        <div class="card-body scrollable-activity">
          @foreach($activities as $activity)
          <div class="activity mt-2">
            @php
            $user = App\Models\User::find($activity->user_id);
            @endphp
            <div class="activity-title fw-bold">{{ $activity->action }} by {{ ucfirst($user->name) }}</div>
            <div class="activity-time"><small class="profile-time">{{ $activity->created_at->format('H:i') }}
                @if ($activity->created_at->isYesterday())
                Yesterday
                @else
                {{ $activity->created_at->diffForHumans() }}
                @endif</small></div>
            <div class="activity-content ">
              {{ ucfirst($user->name) }} {{ $activity->details }}
            </div>
          </div>
          @endforeach
        </div>
        <div id="pagination" class="d-flex justify-content-end">
          {{ $activities->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Add custom method for validating image extensions
    $.validator.addMethod("imageExtension", function(value, element) {
      // Check if the file input value matches the allowed extensions (jpg, jpeg, png, svg)
      var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.svg)$/i;
      return this.optional(element) || allowedExtensions.test(value);
    }, "Only .jpg, .jpeg, .png, and .svg files are allowed.");
    // Custom image dimension validation
    // Flag to check if validation should pass
    let isValidImage = true;

    // Custom validation method for image dimensions
    $.validator.addMethod("imageDimensions", function(value, element) {
      var imageFile = element.files[0];

      if (!imageFile) {
        return true; // No file selected, skip validation
      }

      var img = new Image();
      var $element = $(element);
      $('.avatar_img_upload').hide();
      img.onload = function() {
        var width = img.width;
        var height = img.height;
        var isValid = width >= 800 && height >= 500;
        // Store validation result in a data attribute
        $element.data("valid-image", isValid);

        // Manually trigger validation again
        if (isValid) {
          $("#avatar").valid();
          $('.avatar_img_upload').show();
        }
      };

      img.src = URL.createObjectURL(imageFile);

      // Return stored validation result or assume false if not yet loaded
      return $element.data("valid-image") === true;
    }, "Image must be at least 800px by 500px.");

    $.validator.setDefaults({
      ignore: []
    });
    $('#listing_show_form').validate({
      rules: {
        avatar: {
          imageExtension: true,
          imageDimensions: true
        }
      },
      messages: {
        avatar: {
          imageExtension: 'Only .jpg, .jpeg, .png, and .svg files are allowed.',
          imageDimensions: 'Image must be at least 800px by 500px.'
        }
      },
      errorPlacement: function(error, element) {
        // Custom placement for errors
        console.log(element.attr('name'));
        if (element.attr('name') == 'avatar') {
          // Place the error outside the label in the #listingImgError div
          error.appendTo('#listingImgError');
        } else {
          // Default placement for other fields
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
    $('#listing_show_form input').on('keyup change', function() {
      $(this).valid(); // Trigger validation for the input field
    });

  });
</script>
<script>
  function previewImage(event) {
    isValidImage = true;
    const preview = document.getElementById('avatar-preview');
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        /* $('.avatar_img_upload').show(); */
      }
      reader.readAsDataURL(file);
    }
  }
</script>
@endsection