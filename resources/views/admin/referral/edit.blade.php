
   
@extends('admin.layout.master')
@section('content')
      
        <div class="container-fluid content" style="background-color: #f8f9fa; padding: 2rem 2rem 0rem 2rem;">
            <div class="next-back-page d-flex justify-content-between">
                <button><i class="fa fa-chevron-left"></i>Back</button>
                <button>Next <i class="fa fa-chevron-right"></i></button>
            </div>
        </div>
        <div class="container-fluid content bg-light">
            <div class="row card p-4 font-fm mb-5">
                <form id="editReferral_form" action="{{ route('update.referral',$referral->RefID) }}" method="post">
                @csrf
                @method('PUT')
                    <div>
                        <h1>Referrals:</h1>
                        <hr>
                        <div class="col-md-12">
                            <h5>Referring Agent</h5>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Follow Up</label>
                                <input type="text" class="form-control" id="follow_up" name="follow_up" value="{{$referral->RefCompany}}">
                                @error('follow_up')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Broke of Rec</label>
                                <input type="text" class="form-control" id="broke_of_rac" name="broke_of_rac" value="{{$referral->BrokOfRec}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Agent Name</label>
                                <input type="text" class="form-control" id="agent_name" name="agent_name" value="{{$referral->AgentName}}">
                                @error('agent_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$referral->Address1}}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip" class="form-label">City</label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{$referral->City}}">
                                        @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3  p-0">
                                        <select id="State" class="form-select" name="state">
                                            <option value="" selected="">Select state</option>
                                            @foreach($states as $key=>$value)
                                            <option value="{{$value->State}}" {{ $referral->State == $value->State ? 'selected' : '' }}>{{$value->StateName}}</option>
                                            @endforeach
                                        </select>
                                            @error('state')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="Zip" class="form-control" placeholder="Zip" name="zip" value="{{$referral->Zip}}">
                                        @error('zip')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"  value="{{$referral->Phone}}">
                                @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="expDate">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax"  value="{{$referral->Fax}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Ref Fee</label>
                                <input type="text" class="form-control" id="ref_fee" name="ref_fee"  value="{{$referral->RefFee}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Flat Fee</label>
                                <input type="text" class="form-control" id="flat_fee" name="flat_fee"  value="{{$referral->FlatFee}}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="expDate">Ref Amt Paid</label>
                                <input type="text" class="form-control" id="ref_amt_paid" name="ref_amt_paid"  value="{{$referral->RefAmt}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Comments</label>
                                <input type="text" class="form-control" id="comments" name="comments"  value="{{$referral->Comments}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label for="cityStateZip" class="form-label">Ref Type</label>
                                        <select class="form-select" aria-label="Default select example" name="ref_type">
                                            <option value="0" selected>No Ref Type</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  ">
                                        <label for="cityStateZip" class="form-label">Ref Source</label>
                                        <select class="form-select" aria-label="Default select example" name="ref_source">
                                            <option value="0" selected>No Ref Src</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <h5>Referral Status</h5>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-3 mb-3 d-flex">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio1" value="option1">
                                            <label class="form-check-label" for="inlineRadio1">Incoming</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio2" value="option2">
                                            <label class="form-check-label" for="inlineRadio2">Outgoing</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate"> Name</label>
                                <input type="text" class="form-control" id="referral_name" name="referral_name"  value="{{$referral->ReferredName}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Address</label>
                                <input type="text" class="form-control" id="referral_address" name="referral_address"  value="{{$referral->ReferredAdd1}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cityStateZip" class="form-label">City</label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" id="referral_city" class="form-control" placeholder="City" name="referral_city"  value="{{$referral->ReferredCity}}">
                                    </div>
                                    <div class="col-md-3  p-0">
                                        <select id="referral_state" class="form-select" name="referral_state">
                                            <option value="" selected="">Select state</option>
                                            @foreach($states as $key=>$value)
                                            <option value="{{$value->State}}" {{ $referral->ReferredState == $value->State ? 'selected' : '' }}>{{$value->StateName}}</option>
                                            @endforeach
                                        </select>
                                            @error('referral_state')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="referral_zip" class="form-control" placeholder="Zip" name="referral_zip"  value="{{$referral->ReferredZip}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Phone</label>
                                <input type="text" class="form-control" id="referral_phone" name="referral_phone"  value="{{$referral->ReferredPhone}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Ref Interest</label>
                                <input type="text" class="form-control" id="ref_interest" name="ref_interest"  value="{{$referral->ReferredInterest}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Ref DBA</label>
                                <input type="text" class="form-control" id="ref_dba" name="ref_dba"  value="{{$referral->ReferredDBA}}">
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <button class="btn-primary" type="submit" id="prevBtn">Save</button>
                            <button class="btn-primary" type="button" id="nextBtn" onclick="resetForm()">Reset</button>
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
    function resetForm() {
    document.getElementById("referral_form").reset();
    }
           $(document).ready(function () {
                // Define custom phone validation
                $.validator.addMethod("phone", function(value, element) {
                // Regex for phone validation (international and local formats)
                var phoneRegex = /^(\+?\d{1,3}[- ]?)?(\(?\d{1,4}\)?[- ]?)?[\d- ]{6,10}$/;
                return this.optional(element) || phoneRegex.test(value);
                }, "Please enter a valid phone number.");
                $.validator.addMethod("regex", function(value, element, regexp) {
                    return this.optional(element) || regexp.test(value);
                }, "Invalid format.");
                $('#editReferral_form').validate({
                    rules: {
                        follow_up: {
                            required: true
                        },
                        agent_name: {
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
                        zip: {
                            required: true,
                            regex: /^\d{5}(-\d{4})?$/
                        },
                        phone: {
                            required: true,
                            phone: true 
                        },
                        referral_phone: {
                            phone: true 
                        }  
                    },
                    messages: {
                        phone: {
                            required: "Please enter a phone number.",
                            pattern: "Please enter a valid phone number." 
                        },
                        zip: {
                            required: "Please enter a zip code.",
                            regex: "Please enter a valid zip code."
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
</script>
@endsection