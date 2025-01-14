@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="addnewliststep3" action="{{ route('store.listing.step3') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ session('formData.listing_id') ? session('formData.listing_id') : '' }}">

                    <!-- One "tab" for each step in the form: -->
                   
                    <div class="tab" style="display: block;">
                        <h3>Pricing</h3>
                        <hr>
                        <!-- Management and Referring Agent -->
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <h4 class="form-sec mb-3">Management Agent</h4>
                                <div class="d-flex">
                                    <div class="col-sm-6 p-0  mb-3">
                                        <label for="managementAgentName">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="managementAgentName" name="managementAgentName"  value="{{ session('formData.managementAgentName') ?? old('managementAgentName')}}">
                                        @error('managementAgentName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="managementAgentPhone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="managementAgentPhone" name="managementAgentPhone"  value="{{ session('formData.managementAgentPhone') ?? old('managementAgentPhone')}}">
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
                                        <!-- <input type="text" class="form-control" id="referringAgentName" name="referringAgentName"  value="{{ session('formData.referringAgentName') ?? old('referringAgentName')}}"> -->
                                        <select id="referringAgentName" class="form-select" name="referringAgentName">
                                            <option value="" selected="">Select referring agent</option>
                                            @foreach($agents as $key=>$agent)
                                            <option value="{{$agent->agent_info->AgentUserRegisterId }}" {{ (old('referringAgentName') == $agent->agent_info->	AgentUserRegisterId  || session('formData.referringAgentName') == $agent->agent_info->	AgentUserRegisterId ) ? 'selected' : '' }}>{{$agent->agent_info->FName}} {{$agent->agent_info->LName}}</option>
                                            @endforeach
                                        </select>
                                        @error('referringAgentName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col mb-3">
                                        <label for="referringAgentPhone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="referringAgentPhone" name="referringAgentPhone"  value="{{ session('formData.referringAgentPhone') ?? old('referringAgentPhone')}}">
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
                                <input type="date" class="form-control" id="listingDate" name="listingDate"  value="{{ session('formData.listingDate') ?? old('listingDate')}}" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                @error('listingDate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Exp Date</label>
                                <input type="date" class="form-control" id="expDate" name="expDate"  value="{{ session('formData.expDate') ?? old('expDate')}}" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                    @error('expDate')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="listingType">Listing Type</label>
                               <!--  <input type="text" class="form-control" id="listingType" name="listingType"  value="{{ session('formData.listingType') ?? old('listingType')}}"> -->
                               <select id="listingType" class="form-select" name="listingType">
                                    <option value="" selected="">Select listing type</option>
                                    @foreach($listingTypes as $key=>$listingType)
                                    <option value="{{$listingType->ListType}}" {{ (old('listingType') == $listingType->ListType || session('formData.listingType') == $listingType->ListType) ? 'selected' : '' }}>{{$listingType->Description}}</option>
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
                                <input type="text" class="form-control" id="coBroker" name="coBroker"  value="{{ session('formData.coBroker') ?? old('coBroker')}}">
                                @error('coBroker')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reasonForSale">Reason For Sale <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="reasonForSale" name="reasonForSale"  value="{{ session('formData.reasonForSale') ?? old('reasonForSale')}}">
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
                                <input type="number" class="form-control" id="listPrice" name="listPrice"  value="{{ session('formData.listPrice') ?? old('listPrice')}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="purPrice">Pur. Price</label>
                                <input type="number" class="form-control" id="purPrice" name="purPrice"  value="{{ session('formData.purPrice') ?? old('purPrice')}}">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="downPay">Down Pay</label>
                                <input type="number" class="form-control" id="downPay" name="downPay"  value="{{ session('formData.downPay') ?? old('downPay')}}">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="balance">Balance</label>
                                <input type="number" class="form-control" id="balance" name="balance"  value="{{ session('formData.balance') ?? old('balance')}}">

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="interest">Interest</label>
                                <input type="text" class="form-control" id="interest" name="interest"  value="{{ session('formData.interest') ?? old('interest')}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="addTerms">Add. Terms</label>
                                <input type="text" class="form-control" id="addTerms" name="addTerms"  value="{{ session('formData.addTerms') ?? old('addTerms')}}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invInPrice">Inv. in Price</label>
                                <input type="number" class="form-control" id="invInPrice" name="invInPrice"  value="{{ session('formData.invInPrice') ?? old('invInPrice')}}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invNotInPrice">Inv. Not in Price</label>
                                <input type="number" class="form-control" id="invNotInPrice" name="invNotInPrice"  value="{{ session('formData.invNotInPrice') ?? old('invNotInPrice')}}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-check-label me-2" for="untilSolid">Until Solid</label>
                                <input type="checkbox" class="form-check-input" id="untilSolid" name="untilSolid" value="1" {{ (old('untilSolid') || session('formData.untilSolid') == 1) ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Real Estate Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="agent">Agent <span class="text-danger">*</span></label>
                               <!--  <input type="text" class="form-control" id="agent" name="agent"  value="{{ session('formData.agent') ? session('formData.agent') : '' }}"> -->
                               <select id="agent" name="agents" class="form-select select2">
                               <option value="">Select agent</option>
                                    @foreach($agents as $key=>$agent)
                                    <option value="{{$agent->agent_info->AgentID }}" {{ (old('agents') == $agent->agent_info->AgentID  || session('formData.agents') == $agent->agent_info->AgentID ) ? 'selected' : '' }}>{{$agent->name}}</option>
                                    @endforeach
                                </select>
                                @error('agents')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="commission">Commission</label>
                                <input type="text" class="form-control" id="commission" name="commission"  value="{{ session('formData.commission') ?? old('commission')}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="flatFee">Flat Fee</label>
                                <input type="number" class="form-control" id="flatFee" name="flatFee"  value="{{ session('formData.flatFee') ?? old('flatFee')}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="reAskingPrice">Re Asking Price</label>
                                <input type="number" class="form-control" id="reAskingPrice" name="reAskingPrice" value="{{ session('formData.reAskingPrice') ?? old('reAskingPrice')}}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3" style="height: 80px;">

                                <label class="form-check-label me-2" for="realEstate">Real Estate</label>
                                <input type="checkbox" class="form-check-input" id="realEstate" name="realEstate" value="1"  {{ (old('realEstate') || session('formData.realEstate') == 1) ? 'checked' : '' }}>
                            </div>

                            <div class="col-md-3" style="height: 80px;">
                                <label class="form-check-label me-2" for="optionToBuy">Option to Buy</label>
                                <input type="checkbox" class="form-check-input" id="optionToBuy" name="optionToBuy" value="1" {{ (old('optionToBuy') || session('formData.optionToBuy') == 1) ? 'checked' : '' }}>

                            </div>

                            <div class="col-md-3" style="height: 80px;">
                                <label class="form-check-label me-2" for="soldByEBB">Sold by EBB</label>
                                <input type="checkbox" class="form-check-input" id="soldByEBB" name="soldByEBB" value="1" {{ (old('soldByEBB') || session('formData.soldByEBB') == 1) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                  
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                        <a href="{{route('create.listing.step2')}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
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
                $('#addnewliststep3').validate({
                    rules: {
                        managementAgentName: {
                            required: true
                        },
                        managementAgentPhone: {
                            required: true,
                            regex: /^\d{10}$/
                        },
                        referringAgentName: {
                            required: true
                        },
                        referringAgentPhone: {
                            required: true,
                            regex: /^\d{10}$/
                        },
                        listingDate: {
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
                        }
                       
                    },
                    messages: {
                
                    },
                    submitHandler: function (form) { 
                        form.submit();
                    }
                });
                 // Custom method for regex validation
                $.validator.addMethod("regex", function(value, element, regexpr) {
                    return this.optional(element) || regexpr.test(value);
                }, "Please check your input.");
       
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