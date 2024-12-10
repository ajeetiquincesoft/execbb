@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form action="{{ route('agent.edit.listing.form.process',$listingData->ListingID) }}" method="POST" id="listingAgentForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="step" value="{{ session('step', 1) }}">
            <!-- One "form-multi-tab" for each step in the form: -->

            @if (session('step', 1) == 1)
            <div class="form-multi-tab">
                <h3>General:</h3>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="busCategory" class="form-label">Bus. Category <span class="text-danger">*</span></label>
                        <select id="busCategory" class="form-select" name="bus_category">
                            <option value="" selected="">Select category</option>
                            @foreach($categoryData as $key=>$data)
                            <option value="{{$data->CategoryID}}" {{ $listingData->BusCategory == $data->CategoryID ? 'selected' : '' }}>{{$data->BusinessCategory}}</option>
                            @endforeach
                        </select>
                        @error('bus_category')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="busType" class="form-label">Bus. Type <span class="text-danger">*</span></label>
                        <select id="busType" class="form-select" name="bus_type">
                            <option value="" selected>Select type</option>
                            @foreach($sub_categories as $key=>$bus_type)
                            <option value="{{$bus_type->SubCatID}}" {{ $listingData->SubCat == $bus_type->SubCatID  ? 'selected' : '' }}>{{$bus_type->SubCategory}}</option>
                            @endforeach
                        </select>
                        @error('bus_type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4" style="height: 70px;">
                        <label for="franchise" class="form-check-label">Franchise</label>
                        <input type="checkbox" id="franchise" class="form-check-input" name="franchise" value="1" {{ $listingData->Franchise == 1 ? 'checked' : '' }} onchange="changeFranchiseValue()">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="cropName" class="form-label">Crop Name <span class="text-danger">*</span></label>
                        <input type="text" id="cropName" class="form-control" name="cropName" value="{{$listingData->SellerCorpName}}">
                        @error('cropName')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dba" class="form-label">DBA <span class="text-danger">*</span></label>
                        <input type="text" id="dba" class="form-control" name="dba" value="{{$listingData->DBA}}">
                        @error('dba')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="productMix" class="form-label">Product Mix</label>
                        <input type="text" id="productMix" class="form-control" name="productMix" value="{{$listingData->Product}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-8 mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" id="address" class="form-control" name="address" value="{{$listingData->Address1}}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="City" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{$listingData->City}}">
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="State" class="form-label">State <span class="text-danger">*</span></label>
                        <select id="State" class="form-select" name="state">
                            <option value="" selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{$listingData->State == $value->State ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                        @error('state')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Zip" class="form-label">Zip <span class="text-danger">*</span></label>
                        <input type="text" id="Zip" class="form-control" placeholder="Zip" name="zip_code" value="{{$listingData->Zip}}">
                        @error('zip_code')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country" class="form-label">Country</label>
                        <!--  <input type="text" id="country" class="form-control" name="country" value="{{$listingData->County}}"> -->
                        <select id="country" class="form-select" name="country">
                            <option value="" selected="">Select country</option>
                            @foreach($counties as $key=>$value)
                            <option value="{{$value->County}}" {{$listingData->County == $value->County ? 'selected' : '' }}>{{$value->County}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" class="form-control" name="phone" value="{{$listingData->Phone}}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" id="fax" class="form-control" name="fax" value="{{$listingData->Fax}}">
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="featuredListing" class="form-check-label">Featured Listing</label>
                        <input type="checkbox" id="featuredListing" class="form-check-input" name="featuredListing" value="1" {{ $listingData->featured == 1 ? 'checked' : '' }} onchange="changeFeatureValue()">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <u><span id="fileLink">View Image</span> </u>
                        <br><!-- Placeholder for the file name -->
                        <label for="fileUpload" class="upload-button mt-1">
                            <input type="file" id="fileUpload" accept="image/*" style="display:none;" name="listing_img">
                            <span class="button-text"> <img src="{{url('assets/images/uploadicon.svg')}}" alt="">Upload</span>
                        </label>
                        <div id="imagePreview"></div>
                    </div>
                    @if(!empty($listingData->imagepath))
                    <div class="col">
                        <div id="imageUploads">
                            <img class="view_upload_image" src="{{ asset('assets/uploads/images/' . $listingData->imagepath) }}" alt="Uploaded Image">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" id="firstName" class="form-control" name="first_name" value="{{$listingData->SellerFName}}">
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" id="lastName" class="form-control" name="last_name" value="{{$listingData->SellerLName}}">
                        @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homeAddress" class="form-label">Home Address</label>
                        <input type="text" id="homeAddress" class="form-control" name="home_address" value="{{$listingData->SHomeAdd1}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip2" class="form-label">City</label>
                        <input type="text" id="city2" class="form-control" placeholder="City" name="user_city" value="{{$listingData->SCity}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state" class="form-label">State</label>
                        <select id="State2" class="form-select" name="user_state">
                            <option value="" selected="">Select state</option>
                            @foreach($states as $key=>$value)
                            <option value="{{$value->State}}" {{ $listingData->SState == $value->State ? 'selected' : '' }}>{{$value->StateName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="Zip" class="form-label">Zip</label>
                        <input type="text" id="Zip2" class="form-control" placeholder="Zip" name="user_zip_code" value="{{$listingData->SZip}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control" name="user_email" value="{{$listingData->Email}}">
                        @error('user_email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homePhone" class="form-label">Home Phone</label>
                        <input type="text" id="homePhone" class="form-control" name="user_home_phone" value="{{$listingData->SHomePh}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="homeFax" class="form-label">Home Fax</label>
                        <input type="text" id="homeFax" class="form-control" name="user_home_fax" value="{{$listingData->SHomeFax}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="pager" class="form-label">Pager</label>
                        <input type="text" id="pager" class="form-control" name="user_pager" value="{{$listingData->Pager}}">
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label for="review" class="form-check-label">Review</label>
                        <input type="checkbox" id="review" class="form-check-input" name="review" value="1" {{ $listingData->Review == 1 ? 'checked' : '' }} onchange="changeReviewValue()">
                    </div>
                </div>
            </div>

            @endif

            <!-- Step 2 -->
            @if (session('step', 1) == 2)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3>Business</h3>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="buildingSize">Building Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="buildingSize" name="buildingSize" value="{{$listingData->BldgSize}}">
                        @error('buildingSize')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="basementSize">Basement Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="basementSize" name="basementSize" value="{{$listingData->BaseSize}}">
                        @error('basementSize')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4" style="height: 70px;">
                        <label class="form-check-label me-2">Basement?</label>
                        <input type="checkbox" class="form-check-input" id="basement" name="basement" value="1" {{ $listingData->Basement == 1 ? 'checked' : '' }} onchange="changeBasementValue()">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="parking">Parking <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="parking" name="parking" value="{{$listingData->Parking}}">
                        @error('parking')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="licenseRequired">License Required <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="licenseRequired" name="licenseRequired" value="{{$listingData->LicenseReq}}">
                        @error('licenseRequired')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="baseMonthlyRent">Base Monthly Rent <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="baseMonthlyRent" name="baseMonthlyRent" value="{{$listingData->BaseMonthRent}}">
                        @error('baseMonthlyRent')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="leaseTerms">Lease Terms <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="leaseTerms" name="leaseTerms" value="{{$listingData->LeaseTerms}}">
                        @error('leaseTerms')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="leaseOptions">Lease Options <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="leaseOptions" name="leaseOptions" value="{{$listingData->LeaseOpt}}">
                        @error('leaseOptions')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="daysOpen">No. of Days Open <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="daysOpen" name="daysOpen" value="{{$listingData->NoDaysOpen}}">
                        @error('daysOpen')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="hoursOperation">Hours of Operation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="hoursOperation" name="hoursOperation" value="{{$listingData->HoursOfOp}}">
                        @error('hoursOperation')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numSeats">No. of Seats <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="numSeats" name="numSeats" value="{{$listingData->Seats}}">
                        @error('numSeats')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="yearsEstablished">Years Established? <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="yearsEstablished" name="yearsEstablished" value="{{$listingData->YrsEstablished}}">
                        @error('yearsEstablished')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="yearsPrevOwner">Years Previous Owner <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="yearsPrevOwner" name="yearsPrevOwner" value="{{$listingData->YrsPresentOwner}}">
                        @error('yearsPrevOwner')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Interest</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="interestHot" name="motivation" value="Hot" {{ $listingData->Motivation == 'Hot' ? 'checked' : '' }}>
                                <label class="form-check-label" for="interestHot">Hot</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="interestMedium" name="motivation" value="Medium" {{  $listingData->Motivation == 'Medium' ? 'checked' : '' }}>
                                <label class="form-check-label" for="interestMedium">Medium</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="interestCold" name="motivation" value="Cold" {{  $listingData->Motivation == 'Cold' ? 'checked' : '' }}>
                                <label class="form-check-label" for="interestCold">Cold</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="row mb-2">
                            <label>Employees</label>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="PTEmp" name="PTEmp" value="{{$listingData->PTEmp}}" placeholder="Part Time">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="FTEmp" name="FTEmp" value="{{$listingData->FTEmp}}" placeholder="Full Time">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif
            <!-- Step 3 -->
            @if (session('step', 1) == 3)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3>Pricing</h3>
                <hr>
                <!-- Management and Referring Agent -->
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <h4 class="form-sec mb-3">Management Agent</h4>
                        <div class="d-flex">
                            <div class="col-sm-6 p-0  mb-3">
                                <label for="managementAgentName">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="managementAgentName" name="managementAgentName" value="{{$listingData->MgtAgentName}}">
                                @error('managementAgentName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="managementAgentPhone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="managementAgentPhone" name="managementAgentPhone" value="{{$listingData->MgtAgentPh}}">
                                @error('managementAgentPhone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6  mb-2">
                        <h4 class="form-sec mb-3">Referring Agent</h4>
                        <div class="d-flex">
                            <div class="col p-0 mb-3">
                                <label for="referringAgentName">Name <span class="text-danger">*</span></label>
                                <!--  <input type="text" class="form-control" id="referringAgentName" name="referringAgentName"  value="{{$listingData->RefAgentID}}"> -->
                                <select id="managementAgentName" class="form-select" name="referringAgentName">
                                    <option value="" selected="">Select referring agent</option>
                                    @foreach($agents as $key=>$agent)
                                    <option value="{{$agent->agent_info->AgentUserRegisterId }}" {{ $listingData->RefAgentID == $agent->agent_info->AgentUserRegisterId ? 'selected' : '' }}>{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</option>
                                    @endforeach
                                </select>
                                @error('referringAgentName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="referringAgentPhone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="referringAgentPhone" name="referringAgentPhone" value="{{$listingData->RefAgentPh}}">
                                @error('referringAgentPhone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listing Data -->
                <div class="row mb-2">
                    <h4 class="form-sec mb-3">Listing Data</h4>
                    <div class="col-md-3 mb-3">
                        <label for="listingDate">Listing Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="listingDate" name="listingDate" value="{{$listingData->ListDate}}">
                        @error('listingDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="expDate">Exp Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="expDate" name="expDate" value="{{$listingData->ExpDate}}">
                        @error('expDate')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="listingType">Listing Type</label>
                        <!--  <input type="text" class="form-control" id="listingType" name="listingType"  value="{{$listingData->ListType}}"> -->
                        <select id="listingType" class="form-select" name="listingType">
                            <option value="" selected="">Select listing type</option>
                            @foreach($listingTypes as $key=>$listingType)
                            <option value="{{$listingType->ListType}}" {{ $listingType->ListType == $listingData->ListType ? 'selected' : '' }}>{{$listingType->Description}}</option>
                            @endforeach
                        </select>
                        @error('listingType')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Co-Broker and Reason for Sale -->
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="coBroker">Co-Broker <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="coBroker" name="coBroker" value="{{$listingData->CoBrokID}}">
                        @error('coBroker')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="reasonForSale">Reason For Sale <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="reasonForSale" name="reasonForSale" value="{{$listingData->SaleReas}}">
                        @error('reasonForSale')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- formData Data -->
                <div class="row mb-2">
                    <h4 class="form-sec mb-3">formData Data</h4>
                    <div class="col-md-3 mb-3">
                        <label for="listPrice">List Price</label>
                        <input type="number" class="form-control" id="listPrice" name="listPrice" value="{{$listingData->ListPrice}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="purPrice">Pur. Price</label>
                        <input type="number" class="form-control" id="purPrice" name="purPrice" value="{{$listingData->PurPrice}}">

                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="downPay">Down Pay</label>
                        <input type="number" class="form-control" id="downPay" name="downPay" value="{{$listingData->DownPay}}">

                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="balance">Balance</label>
                        <input type="number" class="form-control" id="balance" name="balance" value="{{$listingData->Balance}}">

                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3 mb-3">
                        <label for="interest">Interest</label>
                        <input type="text" class="form-control" id="interest" name="interest" value="{{$listingData->Interest}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="addTerms">Add. Terms</label>
                        <input type="text" class="form-control" id="addTerms" name="addTerms" value="{{$listingData->AddTerm}}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="invInPrice">Inv. in Price</label>
                        <input type="number" class="form-control" id="invInPrice" name="invInPrice" value="{{$listingData->InvInPrice}}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="invNotInPrice">Inv. Not in Price</label>
                        <input type="number" class="form-control" id="invNotInPrice" name="invNotInPrice" value="{{$listingData->InvNot}}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-check-label me-2" for="untilSolid">Until Solid</label>
                        <input type="checkbox" class="form-check-input" id="untilSolid" name="untilSolid" value="1" {{ $listingData->UntilSold == 1 ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="row mb-2">
                    <h4 class="form-sec mb-3">Real Estate Data</h4>
                    <div class="col-md-3 mb-3">
                        <label for="agent">Agent</label>
                        <!--  <input type="text" class="form-control" id="agent" name="agent"  value="{{ session('formData.agent') ? session('formData.agent') : '' }}"> -->
                        <select id="agent" name="agents[]" class="form-select">
                            @foreach($agents as $key=>$agent)
                            <option value="{{$agent->agent_info->AgentID}}" {{ $agent->agent_info->AgentID == $listingData->AgentID ? 'selected' : '' }}>{{$agent->name}}</option>
                            @endforeach
                        </select>
                        @error('agents')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="commission">Commission</label>
                        <input type="text" class="form-control" id="commission" name="commission" value="{{$listingData->Commission}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="flatFee">Flat Fee</label>
                        <input type="number" class="form-control" id="flatFee" name="flatFee" value="{{$listingData->FlatFee}}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="reAskingPrice">Re Asking Price</label>
                        <input type="number" class="form-control" id="reAskingPrice" name="reAskingPrice" value="{{$listingData->REAskingPrice}}">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3" style="height: 80px;">

                        <label class="form-check-label me-2" for="realEstate">Real Estate</label>
                        <input type="checkbox" class="form-check-input" id="realEstate" name="realEstate" value="1" {{ $listingData->RealEstate == 1 ? 'checked' : '' }}>
                    </div>

                    <div class="col-md-3" style="height: 80px;">
                        <label class="form-check-label me-2" for="optionToBuy">Option to Buy</label>
                        <input type="checkbox" class="form-check-input" id="optionToBuy" name="optionToBuy" value="1" {{ $listingData->ToBuy == 1 ? 'checked' : '' }}>

                    </div>

                    <div class="col-md-3" style="height: 80px;">
                        <label class="form-check-label me-2" for="soldByEBB">Sold by EBB</label>
                        <input type="checkbox" class="form-check-input" id="soldByEBB" name="soldByEBB" value="1" {{ $listingData->SoldEBB == 1 ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            @endif

            <!-- Step 4 -->
            @if (session('step', 1) == 4)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h3>Financial</h3>
                <hr>
                <div class="row">
                    <h4 class="form-sec mb-3">Income &amp; Expenses</h4>
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="annualSales">Annual Sales <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="annualSales" name="annualSales" value="{{$listingData->AnnualSales}}">
                            @error('annualSales')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="costOfSales">Cost of Sales <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="costOfSales" name="costOfSales" value="{{$listingData->CostOfSale}}">
                            @error('costOfSales')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="grossProfit">Gross Profit <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="grossProfit" name="grossProfit" value="{{$listingData->GrossProfit}}">
                            @error('grossProfit')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="totalExpenses">Total Expenses <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="totalExpenses" name="totalExpenses" value="{{$listingData->TotalExpenses}}">
                            @error('totalExpenses')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <h4 class="form-sec mb-3">Cost of Goods</h4>
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="food">Goods Name</label>
                            <input type="text" class="form-control" id="goods_name1" name="goods_name1" value="{{$listingData->COG1Label}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="cost0_1">Cost 1</label>
                            <input type="number" class="form-control" id="cost0_1" name="cost0_1" value="{{$listingData->COG1}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="beverage">Goods Name</label>
                            <input type="text" class="form-control" id="goods_name2" name="goods_name2" value="{{$listingData->COG2Label}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="cost0_2">Cost 2</label>
                            <input type="number" class="form-control" id="cost0_2" name="cost0_2" value="{{$listingData->COG2}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="beverage">Goods Name</label>
                            <input type="text" class="form-control" id="goods_name3" name="goods_name3" value="{{$listingData->COG3Label}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="cost0_3">Cost 3</label>
                            <input type="number" class="form-control" id="cost0_3" name="cost0_3" value="{{$listingData->COG3}}">
                        </div>
                    </div>


                </div>
                <div class="row">
                    <h4 class="form-sec mb-3">Other Expenses</h4>
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="baseAnnRent">Base Annual Rent</label>
                            <input type="number" class="form-control" id="baseAnnRent" name="baseAnnRent" value="{{$listingData->AnnRent}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="commAreaMaint">Comm Area Maintenance</label>
                            <input type="number" class="form-control" id="commAreaMaint" name="commAreaMaint" value="{{$listingData->CommonAreaMaint}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="realEstateTax">Real Estate Tax</label>
                            <input type="number" class="form-control" id="realEstateTax" name="realEstateTax" value="{{$listingData->RealEstateTax}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="annPayroll">Annual Payroll</label>
                            <input type="number" class="form-control" id="annPayroll" name="annPayroll" value="{{$listingData->AnnPayroll}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="payrollTax">Payroll Tax</label>
                            <input type="number" class="form-control" id="payrollTax" name="payrollTax" value="{{$listingData->PayrollTax}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="licenseFees">License Fees</label>
                            <input type="number" class="form-control" id="licenseFees" name="licenseFees" value="{{$listingData->LicFee}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="advertising">Advertising</label>
                            <input type="number" class="form-control" id="advertising" name="advertising" value="{{$listingData->Advertising}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="telephone">Telephone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="{{$listingData->Telephone}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="utilities">Utilities</label>
                            <input type="number" class="form-control" id="utilities" name="utilities" value="{{$listingData->Utilities}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="insurance">Insurance</label>
                            <input type="number" class="form-control" id="insurance" name="insurance" value="{{$listingData->Insurance}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="accountingLegal">Accounting/Legal</label>
                            <input type="number" class="form-control" id="accountingLegal" name="accountingLegal" value="{{$listingData->AcctLeg}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="maintenance">Maintenance</label>
                            <input type="number" class="form-control" id="maintenance" name="maintenance" value="{{$listingData->Maintenance}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="trash">Trash</label>
                            <input type="number" class="form-control" id="trash" name="trash" value="{{$listingData->Trash}}">
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                            <label for="other">Other</label>
                            <input type="number" class="form-control" id="other" name="other" value="{{$listingData->Other}}">
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Step 5 -->
            @if (session('step', 1) == 5)
            <!-- Next tab Business -->
            <div class="form-multi-tab">
                <h4>Comments</h4>
                <hr>
                <div class="comment-area w-100">
                    <div class="row mb-3">
                        <!-- Highlights -->
                        <div class="col">
                            <label for="highlights" class="form-label">Highlights</label>
                            <textarea class="form-control" id="highlights" name="highlights" rows="4">{{$listingData->Highlights}}</textarea>
                            @error('highlights')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Directions -->
                        <div class="col">
                            <label for="directions" class="form-label">Directions</label>
                            <textarea class="form-control" id="directions" name="directions" rows="4">{{$listingData->Directions}}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Comments -->
                        <div class="col">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4">{{$listingData->Comments}}</textarea>
                            @error('comments')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Lead ID -->
                        <div class="col">
                            <label for="leadId" class="form-label">Lead ID</label>
                            <select id="leadId" name="leadId" class="form-select">
                                <option value="" selected="">Select lead</option>
                                @foreach($leads as $key=>$lead)
                                <option value="{{$lead->LeadID}}" {{ $listingData->LeadID ==$lead->LeadID ? 'selected' : '' }}>{{$lead->LeadID}}</option>
                                @endforeach
                            </select>
                            @error('leadId')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @endif
            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>
                    <!-- Previous button -->
                    @if (session('step', 1) > 1)
                    <button type="submit" name="previous" class="btn-primary" id="prevBtn">Previous</button>
                    @endif

                    <!-- Next button or Submit -->
                    <button type="submit" name="next" class="btn-primary" id="nextBtn">
                        {{ session('step', 1) < 5 ? 'Next' : 'Submit' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div p-8="">
    <p>&nbsp;</p>
</div>
<style>
    .hidden-step {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("regex", function(value, element, regexpr) {
            return this.optional(element) || regexpr.test(value); // Allows optional fields to be empty
        }, "Invalid phone number format.");
        var form = $('#listingAgentForm');
        form.validate({
            rules: {
                user_email: {
                    required: true,
                    email: true
                },
                bus_category: {
                    required: true
                },
                bus_type: {
                    required: true
                },
                cropName: {
                    required: true
                },
                dba: {
                    required: true
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                zip_code: {
                    required: true,
                    minlength: 5, // Minimum length for US ZIP code
                    maxlength: 10 // Maximum length for 9-digit ZIP code
                },
                phone: {
                    required: true,
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                },
                user_home_phone: {
                    regex: /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/ // Custom regex rule
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                listing_img: {
                    extension: "jpeg,png,gif,svg",
                    filesize: 5 * 1024 * 1024 // 5MB
                },
                buildingSize: {
                    required: true
                },
                basementSize: {
                    required: true
                },
                parking: {
                    required: true
                },
                licenseRequired: {
                    required: true
                },
                baseMonthlyRent: {
                    required: true
                },
                leaseTerms: {
                    required: true
                },
                leaseOptions: {
                    required: true
                },
                daysOpen: {
                    required: true
                },
                hoursOperation: {
                    required: true
                },
                numSeats: {
                    required: true
                },
                yearsEstablished: {
                    required: true
                },
                yearsPrevOwner: {
                    required: true
                },
                managementAgentName: {
                    required: true
                },
                managementAgentPhone: {
                    required: true
                },
                referringAgentName: {
                    required: true
                },
                referringAgentPhone: {
                    required: true
                },
                listingDate: {
                    required: true
                },
                expDate: {
                    required: true
                },
                coBroker: {
                    required: true
                },
                reasonForSale: {
                    required: true
                },
                agents: {
                    required: true
                },
                annualSales: {
                    required: true
                },
                costOfSales: {
                    required: true
                },
                grossProfit: {
                    required: true
                },
                totalExpenses: {
                    required: true
                },
                highlights: {
                    required: true
                },
                comments: {
                    required: true
                },
                leadId: {
                    required: true
                }
            },
            messages: {
                phone: {
                    required: 'Phone number is required.',
                    regex: 'Must be a valid phone number.'
                },
                user_home_phone: {
                    regex: 'Must be a valid phone number.'
                },
                listing_img: {
                    extension: 'File must be a valid image type (jpeg, png, gif, svg).',
                    filesize: 'File size must be less than 5MB.'
                }
            },
            submitHandler: function(form) {
                form.submit(); // Proceed with form submission if valid
            }
        });


        $('#nextBtn').on('click', function(event) {
            if (form.valid()) {
                form.submit();
            } else {
                event.preventDefault();
            }
        });

        // Handle the Previous button click event
        $('#prevBtn').on('click', function(event) {
            form.unbind('submit');
            form.submit();
        });
    });
</script>
<style>
    .accordion-button.collapsed {
        background: white;
        color: #000;
        /* Optional: Change the text color to black for better contrast */
    }

    .accordion-button.collapsed::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-button.collapsed::before {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .form-check-input[type=checkbox] {
        position: absolute !important;
        top: 40% !important;
        left: 5% !important;
        margin: 0;
    }

    h4.form-sec {
        font-family: inter;
        font-weight: 600;
        font-size: 1.1rem;
        color: #000;
    }

    .form-multi-tab h3 {
        font-size: 23px;
        font-weight: 600;
        font-family: 'Inter';
        color: #000;
    }

    .form-multi-tab label {
        font-weight: 600;
        color: #444444;
        font-size: 13px;
        font-family: 'Inter';
    }

    button#nextBtn,
    button#prevBtn {
        padding: 10px 45px;
        border-radius: 5px;
        box-shadow: unset;
    }

    input:not([type=checkbox]) {
        padding: 0.7rem !important;
        border-radius: 0px !important;
    }

    .form-control {
        height: unset !important;
    }

    .form-check label.form-check-label {
        margin: 7px 20px 7px 7px;
    }

    input:focus,
    select:focus {
        border-color: #5d1229 !important;
        box-shadow: unset !important;
        border-radius: 0px !important;
    }

    .comment-area {
        width: 55% !important;
        margin: auto;
    }

    /* upload button style */
    .upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .upload-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
    }

    .thumbnail {
        width: 200px;
        height: 200px;
        object-fit: cover;
        margin-top: 20px;
        display: none;
    }

    .file-info {
        display: none;
        font-size: 14px;
        margin-top: 10px;
    }

    .upload-button {
        background-color: #620022 !important;
        /* Burgundy color */
        padding: 10px 20px !important;
        border-radius: 5px !important;
        cursor: pointer !important;
        color: #ffff !important;
    }

    .button-text {
        display: inline-block;
    }

    #imagePreview {
        margin-top: 20px;
        display: none;
    }

    #imagePreview img {
        max-width: 100px;
    }

    #fileLink {
        cursor: pointer;
        font-weight: 600;
    }

    span.button-text img {
        margin-right: 10px;
        width: 18px;
    }

    span.button-text {
        font-size: 0.80rem;
        font-weight: 400;
        font-family: 'Inter';
        letter-spacing: 0.50px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#busCategory').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: "{{ route('agent.get.options', ['id' => '__ID__']) }}".replace('__ID__', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#busType').empty(); // Clear existing options
                        $('#busType').append('<option value="">Select an option</option>'); // Add default option
                        $.each(data, function(key, value) {
                            $('#busType').append('<option value="' + value.SubCatID + '">' + value.SubCategory + '</option>');
                        });
                    }
                });
            } else {
                $('#second-dropdown').empty().append('<option value="">Select an option</option>'); // Reset second dropdown
            }
        });
    });
</script>
<script>
    document.getElementById('fileUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            const fileLink = document.getElementById('fileLink');

            reader.onload = function(e) {
                const fileType = file.type;

                // Check if the file is an image
                if (fileType.startsWith('image/')) {
                    const imagePreviewDiv = document.getElementById('imagePreview');
                    imagePreviewDiv.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview">';
                    imagePreviewDiv.style.display = 'block';
                } else {
                    // If not an image, just show the file type
                    document.getElementById('imagePreview').innerHTML = '<p>Uploaded file: ' + file.name + '</p>';
                }

                // Set the file name and make it clickable
                fileLink.innerText = file.name;
                fileLink.href = e.target.result;
                fileLink.download = file.name; // Set the filename for download
                fileLink.style.display = 'inline-block';

                // Add click event for downloading
                fileLink.addEventListener('click', function() {
                    const downloadLink = document.createElement('a');
                    downloadLink.href = e.target.result;
                    downloadLink.download = file.name;
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                });
            };

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection