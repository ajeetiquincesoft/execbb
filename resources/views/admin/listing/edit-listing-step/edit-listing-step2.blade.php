@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4">
        <form id="addnewliststep2" action="{{ route('update.listing.step2',$listingData->ListingID) }}" method="post">
            @csrf
            <!-- One "tab" for each step in the form: -->

            <div class="tab" style="display: block;">
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
                        <!-- <label>Employees</label>
                                <div class="d-flex">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestPartTime" name="empJobType" value="Part Time" {{  $listingData->PTEmp == 'Part Time' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interestPartTime">Part Time</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="interestFullTime" name="empJobType" value="Full Time" {{  $listingData->FTEmp == 'Full Time' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interestFullTime">Full Time</label>
                                    </div>
                                </div> -->
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>
                    <a href="{{route('edit.listing.step1',$listingData->ListingID)}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
                    <button class="btn-primary" type="submit" id="nextBtn">Next</button>
                </div>
            </div>
            <div id="errorMessage" class="alert alert-danger mt-3 d-none"></div>
        </form>
    </div>
</div>
<div p-8="">
    <p>&nbsp;</p>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addnewliststep2').validate({
            rules: {
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
                }

            },
            messages: {

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
<style>
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

    .tab h3 {
        font-size: 23px;
        font-weight: 600;
        font-family: 'Inter';
        color: #000;
    }

    .tab label {
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
@endsection