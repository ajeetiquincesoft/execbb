@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card p-4 font-fm mb-5">
        <form id="editReferral_form" action="{{ route('update.referral',$referral->RefID) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <h1>Referral:</h1>
                <hr>
                <div class="col-md-12">
                    <h5>Referring Agent</h5>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Follow Up <span class="text-danger">*</span></label>
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
                        <label for="expDate">Agent Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="agent_name" name="agent_name" value="{{$referral->AgentName}}">
                        @error('agent_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="expDate">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$referral->Address1}}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" id="city" class="form-control" placeholder="City" name="city" value="{{$referral->City}}">
                        @error('city')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">State <span class="text-danger">*</span></label>
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
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">Zip <span class="text-danger">*</span></label>
                        <input type="text" id="Zip" class="form-control" placeholder="Zip" name="zip" value="{{$referral->Zip}}">
                        @error('zip')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{$referral->Phone}}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="expDate">Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" value="{{$referral->Fax}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Ref Fee</label>
                        <input type="text" class="form-control" id="ref_fee" name="ref_fee" value="{{$referral->RefFee}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Flat Fee</label>
                        <input type="text" class="form-control" id="flat_fee" name="flat_fee" value="{{$referral->FlatFee}}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="expDate">Ref Amt Paid</label>
                        <input type="text" class="form-control" id="ref_amt_paid" name="ref_amt_paid" value="{{$referral->RefAmt}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">Ref Type</label>
                        <select class="form-select" aria-label="Default select example" name="ref_type">
                            <option value="0" selected>No Ref Type</option>
                            @foreach($referral_types as $key=>$referral_type)
                            <option value="{{$referral_type->RefTypeID}}" {{ $referral->RefType == $referral_type->RefTypeID ? 'selected' : '' }}>{{$referral_type->RefTypeDescript}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">Ref Source</label>
                        <select class="form-select" aria-label="Default select example" name="ref_source">
                            <option value="0" selected>No Ref Src</option>
                            @foreach($referral_sources as $key=>$referral_source)
                            <option value="{{$referral_source->RefID }}" {{ $referral->RefSource == $referral_source->RefID  ? 'selected' : '' }}>{{$referral_source->RefSourceDescrip}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="comments">Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3">{{$referral->Comments}}</textarea>
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
                        <input type="text" class="form-control" id="referral_name" name="referral_name" value="{{$referral->ReferredName}}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="expDate">Address</label>
                        <input type="text" class="form-control" id="referral_address" name="referral_address" value="{{$referral->ReferredAdd1}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">City</label>
                        <input type="text" id="referral_city" class="form-control" placeholder="City" name="referral_city" value="{{$referral->ReferredCity}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">City</label>
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
                    <div class="col-md-4 mb-3">
                        <label for="cityStateZip" class="form-label">City</label>
                        <input type="text" id="referral_zip" class="form-control" placeholder="Zip" name="referral_zip" value="{{$referral->ReferredZip}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Phone</label>
                        <input type="text" class="form-control" id="referral_phone" name="referral_phone" value="{{$referral->ReferredPhone}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Ref Interest</label>
                        <input type="text" class="form-control" id="ref_interest" name="ref_interest" value="{{$referral->ReferredInterest}}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="expDate">Ref DBA</label>
                        <input type="text" class="form-control" id="ref_dba" name="ref_dba" value="{{$referral->ReferredDBA}}">
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-center" style="overflow:auto;">
                <div>
                    <button class="btn-primary" type="submit" id="prevBtn">Update</button>
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
    $(document).ready(function() {
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
                    required: true,
                    regex: /^[a-zA-Z\s]+$/
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
                },
                referral_city: {
                    regex: /^[a-zA-Z\s]+$/
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
                },
                city: {
                    regex: 'City can only contain letters and spaces.'
                },
                referral_city: {
                    regex: 'City can only contain letters and spaces.'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        // Define custom phone validation
        $.validator.addMethod("phone", function(value, element) {
            // Regex for phone validation (international and local formats)
            var phoneRegex = /^(?:\+?1[-. ]?)?\(?\d{3}\)?[-. ]?\d{3}[-. ]?\d{4}$/;
            return this.optional(element) || phoneRegex.test(value);
        }, "Please enter a valid phone number.");
        $.validator.addMethod("regex", function(value, element, regexp) {
            return this.optional(element) || regexp.test(value);
        }, "Please check your input.");
        $('#editReferral_form input').on('keyup change', function() {
            $(this).valid();
        });
    });
</script>
@endsection