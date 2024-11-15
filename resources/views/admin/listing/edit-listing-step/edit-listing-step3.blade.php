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
                <form id="addnewliststep3" action="{{ route('update.listing.step3',$listingData->ListingID) }}" method="post">
                @csrf
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
                                        <label for="managementAgentName">Name</label>
                                        <input type="text" class="form-control" id="managementAgentName" name="managementAgentName"  value="{{$listingData->MgtAgentName}}">
                                        @error('managementAgentName')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="managementAgentPhone">Phone</label>
                                        <input type="text" class="form-control" id="managementAgentPhone" name="managementAgentPhone"  value="{{$listingData->MgtAgentPh}}">
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
                                        <label for="referringAgentName">Name</label>
                                       <!--  <input type="text" class="form-control" id="referringAgentName" name="referringAgentName"  value="{{$listingData->RefAgentID}}"> -->
                                        <select id="managementAgentName" class="form-select" name="managementAgentName">
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
                                        <label for="referringAgentPhone">Phone</label>
                                        <input type="text" class="form-control" id="referringAgentPhone" name="referringAgentPhone"  value="{{$listingData->RefAgentPh}}">
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
                                <label for="listingDate">Listing Date</label>
                                <input type="date" class="form-control" id="listingDate" name="listingDate"  value="{{$listingData->ListDate}}">
                                @error('listingDate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Exp Date</label>
                                <input type="date" class="form-control" id="expDate" name="expDate"  value="{{$listingData->ExpDate}}">
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
                                <label for="coBroker">Co-Broker</label>
                                <input type="text" class="form-control" id="coBroker" name="coBroker"  value="{{$listingData->CoBrokID}}">
                                @error('coBroker')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reasonForSale">Reason For Sale</label>
                                <input type="text" class="form-control" id="reasonForSale" name="reasonForSale"  value="{{$listingData->SaleReas}}">
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
                                <input type="number" class="form-control" id="listPrice" name="listPrice"  value="{{$listingData->ListPrice}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="purPrice">Pur. Price</label>
                                <input type="number" class="form-control" id="purPrice" name="purPrice"  value="{{$listingData->PurPrice}}">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="downPay">Down Pay</label>
                                <input type="number" class="form-control" id="downPay" name="downPay"  value="{{$listingData->DownPay}}">

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="balance">Balance</label>
                                <input type="number" class="form-control" id="balance" name="balance"  value="{{$listingData->Balance}}">

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="interest">Interest</label>
                                <input type="text" class="form-control" id="interest" name="interest"  value="{{$listingData->Interest}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="addTerms">Add. Terms</label>
                                <input type="text" class="form-control" id="addTerms" name="addTerms"  value="{{$listingData->AddTerm}}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invInPrice">Inv. in Price</label>
                                <input type="number" class="form-control" id="invInPrice" name="invInPrice"  value="{{$listingData->InvInPrice}}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="invNotInPrice">Inv. Not in Price</label>
                                <input type="number" class="form-control" id="invNotInPrice" name="invNotInPrice"  value="{{$listingData->InvNot}}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-check-label me-2" for="untilSolid">Until Solid</label>
                                <input type="checkbox" class="form-check-input" id="untilSolid" name="untilSolid" value="1"  {{ $listingData->UntilSold == 1 ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <h4 class="form-sec mb-3">Real Estate Data</h4>
                            <div class="col-md-3 mb-3">
                                <label for="agent">Agent</label>
                               <!--  <input type="text" class="form-control" id="agent" name="agent"  value="{{ session('formData.agent') ? session('formData.agent') : '' }}"> -->
                               <select id="agent" name="agents[]" class="form-control" multiple>
                                    @foreach($agents as $key=>$agent)
                                    <option value="{{$agent->agent_info->AgentID}}"  {{ in_array($agent->agent_info->AgentID, $selectedAgents) ? 'selected' : '' }}>{{$agent->name}}</option>
                                    @endforeach
                                </select>
                                @error('agents')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="commission">Commission</label>
                                <input type="text" class="form-control" id="commission" name="commission"  value="{{$listingData->Commission}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="flatFee">Flat Fee</label>
                                <input type="number" class="form-control" id="flatFee" name="flatFee"  value="{{$listingData->FlatFee}}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="reAskingPrice">Re Asking Price</label>
                                <input type="number" class="form-control" id="reAskingPrice" name="reAskingPrice" value="{{$listingData->REAskingPrice}}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3" style="height: 80px;">

                                <label class="form-check-label me-2" for="realEstate">Real Estate</label>
                                <input type="checkbox" class="form-check-input" id="realEstate" name="realEstate" value="1"  {{ $listingData->RealEstate == 1 ? 'checked' : '' }}>
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
                  
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                        <a href="{{route('edit.listing.step2',$listingData->ListingID)}}"><button class="btn-primary" type="button" id="prevBtn">Previous</button></a>
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