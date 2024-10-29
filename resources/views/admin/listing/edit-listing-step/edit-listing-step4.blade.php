@extends('admin.layout.master')
@section('content')
<div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
            <div class="next-back-page d-flex justify-content-between">
                <button><i class="fa fa-chevron-left"></i>Back</button>
                <button>Next <i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="addnewliststep4" action="{{ route('update.listing.step4',$listingData->ListingID) }}" method="post">
                @csrf
                    <div class="tab" style="display: block;">
                        <h3>Financial</h3>
                        <hr>
                        <div class="row">
                            <h4 class="form-sec mb-3">Income &amp; Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annualSales">Annual Sales</label>
                                    <input type="number" class="form-control" id="annualSales" name="annualSales"  value="{{$listingData->AnnualSales}}">
                                    @error('annualSales')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="costOfSales">Cost of Sales</label>
                                    <input type="number" class="form-control" id="costOfSales" name="costOfSales"  value="">
                                    @error('costOfSales')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="grossProfit">Gross Profit</label>
                                    <input type="number" class="form-control" id="grossProfit" name="grossProfit"  value="">
                                    @error('grossProfit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="totalExpenses">Total Expenses</label>
                                    <input type="number" class="form-control" id="totalExpenses" name="totalExpenses"  value="">
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
                                    <input type="text" class="form-control" id="goods_name1" name="goods_name1"  value="{{$listingData->COG1Label}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_1">Cost 1</label>
                                    <input type="number" class="form-control" id="cost0_1" name="cost0_1"  value="{{$listingData->COG1}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="beverage">Goods Name</label>
                                    <input type="text" class="form-control" id="goods_name2" name="goods_name2"  value="{{$listingData->COG2Label}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_2">Cost 2</label>
                                    <input type="number" class="form-control" id="cost0_2" name="cost0_2"  value="{{$listingData->COG2}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="beverage">Goods Name</label>
                                    <input type="text" class="form-control" id="goods_name3" name="goods_name3"  value="{{$listingData->COG3Label}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_3">Cost 3</label>
                                    <input type="number" class="form-control" id="cost0_3" name="cost0_3"  value="{{$listingData->COG3}}">
                                </div>
                            </div>
                            

                        </div>
                        <div class="row">
                            <h4 class="form-sec mb-3">Other Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="baseAnnRent">Base Annual Rent</label>
                                    <input type="number" class="form-control" id="baseAnnRent" name="baseAnnRent"  value="">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="commAreaMaint">Comm Area Maintenance</label>
                                    <input type="number" class="form-control" id="commAreaMaint" name="commAreaMaint"  value="{{$listingData->CommonAreaMaint}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="realEstateTax">Real Estate Tax</label>
                                    <input type="number" class="form-control" id="realEstateTax" name="realEstateTax"  value="{{$listingData->RealEstateTax}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annPayroll">Annual Payroll</label>
                                    <input type="number" class="form-control" id="annPayroll" name="annPayroll"  value="{{$listingData->AnnPayroll}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="payrollTax">Payroll Tax</label>
                                    <input type="number" class="form-control" id="payrollTax" name="payrollTax"  value="{{$listingData->PayrollTax}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="licenseFees">License Fees</label>
                                    <input type="number" class="form-control" id="licenseFees" name="licenseFees"  value="{{$listingData->LicFee}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="advertising">Advertising</label>
                                    <input type="number" class="form-control" id="advertising" name="advertising"  value="{{$listingData->Advertising}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="telephone">Telephone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone"  value="{{$listingData->Telephone}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="utilities">Utilities</label>
                                    <input type="number" class="form-control" id="utilities" name="utilities"  value="{{$listingData->Utilities}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="insurance">Insurance</label>
                                    <input type="number" class="form-control" id="insurance" name="insurance"  value="{{$listingData->Insurance}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="accountingLegal">Accounting/Legal</label>
                                    <input type="number" class="form-control" id="accountingLegal" name="accountingLegal"  value="{{$listingData->AcctLeg}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="maintenance">Maintenance</label>
                                    <input type="number" class="form-control" id="maintenance" name="maintenance"  value="{{$listingData->Maintenance}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="trash">Trash</label>
                                    <input type="number" class="form-control" id="trash" name="trash"  value="{{$listingData->Trash}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="other">Other</label>
                                    <input type="number" class="form-control" id="other" name="other"  value="{{$listingData->Other}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                        <a href="{{route('edit.listing.step3',$listingData->ListingID)}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
                            <button class="btn-primary" type="submit" id="nextBtn">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
           $(document).ready(function () {
                $('#addnewliststep4').validate({
                    rules: {
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
                        } 
                    },
                    messages: {
                
                    },
                    submitHandler: function (form) { 
                        form.submit();
                    }
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

        select {
            font-size: 13px !important;
            font-family: 'Inter' !important;
            padding: 1rem !important;
        }

        input,
        select {
            padding: 0.7rem !important;
            border-radius: 0px !important;
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