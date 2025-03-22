@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="addnewliststep4" action="{{ route('store.listing.step4') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ session('formData.listing_id') ? session('formData.listing_id') : '' }}">
                   
                    <div class="tab" style="display: block;">
                        <h3>Financial</h3>
                        <hr>
                        <div class="row">
                            <h4 class="form-sec mb-3">Income &amp; Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annualSales">Annual Sales <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="annualSales" name="annualSales"  value="{{ session('formData.annualSales') ?? old('annualSales')}}">
                                    @error('annualSales')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="costOfSales">Cost of Sales</label>
                                    <input type="number" class="form-control" id="costOfSales" name="costOfSales"  value="{{ session('formData.costOfSales') ?? old('costOfSales')}}">
                                    @error('costOfSales')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="grossProfit">Gross Profit</label>
                                    <input type="number" class="form-control" id="grossProfit" name="grossProfit"  value="{{ session('formData.grossProfit') ?? old('grossProfit')}}">
                                    @error('grossProfit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="totalExpenses">Total Expenses</label>
                                    <input type="number" class="form-control" id="totalExpenses" name="totalExpenses"  value="{{ session('formData.totalExpenses') ?? old('totalExpenses')}}">
                                    @error('totalExpenses')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="otherIncome">Other Income</label>
                                    <input type="number" class="form-control" id="otherIncome" name="otherIncome"  value="{{ session('formData.otherIncome') ?? old('otherIncome')}}">
                                    @error('otherIncome')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annNetProfit">Ann Net Profit</label>
                                    <input type="number" class="form-control" id="annNetProfit" name="annNetProfit"  value="{{ session('formData.annNetProfit') ?? old('annNetProfit')}}">
                                    @error('annNetProfit')
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
                                    <input type="text" class="form-control" id="goods_name1" name="goods_name1"  value="{{ session('formData.goods_name1') ?? old('goods_name1')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_1">Cost 1</label>
                                    <input type="number" class="form-control" id="cost0_1" name="cost0_1"  value="{{ session('formData.cost0_1') ?? old('cost0_1')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="beverage">Goods Name</label>
                                    <input type="text" class="form-control" id="goods_name2" name="goods_name2"  value="{{ session('formData.goods_name2') ?? old('goods_name2')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_2">Cost 2</label>
                                    <input type="number" class="form-control" id="cost0_2" name="cost0_2"  value="{{ session('formData.cost0_2') ?? old('cost0_2')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="beverage">Goods Name</label>
                                    <input type="text" class="form-control" id="goods_name3" name="goods_name3"  value="{{ session('formData.goods_name3') ?? old('goods_name3')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="cost0_3">Cost 3</label>
                                    <input type="number" class="form-control" id="cost0_3" name="cost0_3"  value="{{ session('formData.cost0_3') ?? old('cost0_3')}}">
                                </div>
                            </div>
                            

                        </div>
                        <div class="row">
                            <h4 class="form-sec mb-3">Other Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="baseAnnRent">Base Annual Rent</label>
                                    <input type="number" class="form-control" id="baseAnnRent" name="baseAnnRent"  value="{{ session('formData.baseAnnRent') ?? old('baseAnnRent')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="commAreaMaint">Comm Area Maintenance</label>
                                    <input type="number" class="form-control" id="commAreaMaint" name="commAreaMaint"  value="{{ session('formData.commAreaMaint') ?? old('commAreaMaint')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="realEstateTax">Real Estate Tax</label>
                                    <input type="number" class="form-control" id="realEstateTax" name="realEstateTax"  value="{{ session('formData.realEstateTax') ?? old('realEstateTax')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="annPayroll">Annual Payroll</label>
                                    <input type="number" class="form-control" id="annPayroll" name="annPayroll"  value="{{ session('formData.annPayroll') ?? old('annPayroll')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="payrollTax">Payroll Tax</label>
                                    <input type="number" class="form-control" id="payrollTax" name="payrollTax"  value="{{ session('formData.payrollTax') ?? old('payrollTax')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="licenseFees">License Fees</label>
                                    <input type="number" class="form-control" id="licenseFees" name="licenseFees"  value="{{ session('formData.licenseFees') ?? old('licenseFees')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="advertising">Advertising</label>
                                    <input type="number" class="form-control" id="advertising" name="advertising"  value="{{ session('formData.advertising') ?? old('advertising')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="telephone">Telephone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone"  value="{{ session('formData.telephone') ?? old('telephone')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="utilities">Utilities</label>
                                    <input type="number" class="form-control" id="utilities" name="utilities"  value="{{ session('formData.utilities') ?? old('utilities')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="insurance">Insurance</label>
                                    <input type="number" class="form-control" id="insurance" name="insurance"  value="{{ session('formData.insurance') ?? old('insurance')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="accountingLegal">Accounting/Legal</label>
                                    <input type="number" class="form-control" id="accountingLegal" name="accountingLegal"  value="{{ session('formData.accountingLegal') ?? old('accountingLegal')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="maintenance">Maintenance</label>
                                    <input type="number" class="form-control" id="maintenance" name="maintenance"  value="{{ session('formData.maintenance') ?? old('maintenance')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="trash">Trash</label>
                                    <input type="number" class="form-control" id="trash" name="trash"  value="{{ session('formData.trash') ?? old('trash')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="other">Other</label>
                                    <input type="number" class="form-control" id="other" name="other"  value="{{ session('formData.other') ?? old('other')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="form-sec mb-3">Additional Expenses</h4>
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="Opt1Label">Option 1 Label</label>
                                    <input type="text" class="form-control" id="Opt1Label" name="Opt1Label"  value="{{ session('formData.Opt1Label') ?? old('Opt1Label')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="Opt1">Option Cost 1</label>
                                    <input type="number" class="form-control" id="Opt1" name="Opt1"  value="{{ session('formData.Opt1') ?? old('Opt1')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="Opt2Label">Option 2 Label</label>
                                    <input type="text" class="form-control" id="Opt2Label" name="Opt2Label"  value="{{ session('formData.Opt2Label') ?? old('Opt2Label')}}">
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-3">
                                    <label for="Opt2">Option Cost 2</label>
                                    <input type="number" class="form-control" id="Opt2" name="Opt2"  value="{{ session('formData.Opt2') ?? old('Opt2')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                        <a href="{{route('create.listing.step3')}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
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