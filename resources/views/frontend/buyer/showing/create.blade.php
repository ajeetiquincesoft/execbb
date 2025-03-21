@extends('frontend.layout.buyer-master')
@section('content')
        <div class="container-showing">
        <h2>Add Showing</h2>
            <div class="row">
                <form id="buyer-showing" action="{{route('buyer.store.showing')}}" method="post">
                    @csrf
                    <div>
                        <div class="row mb-4">
                            <div class="col-md-6  mb-3" style="height: 70px;">
                                <label for="agent">Agents <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg" id="agent_id" name="agent_id">
                                    <option value="" selected="">Select Agents</option>
                                    @foreach($agents as $agent)
                                    <option value="{{$agent->AgentID}}" {{ (old('agent_id') == $agent->AgentID) ? 'selected' : '' }}>{{$agent->FName}} {{$agent->LName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6  mb-3" style="height: 70px;">
                                <label for="buyer">Buyers <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg" id="buyer_id" name="buyer_id">
                                    <option value="" selected="">Select Buyers</option>
                                    @foreach($buyers as $buyer)
                                    <option value="{{$buyer->BuyerID}}" {{ (old('buyer_id') == $buyer->BuyerID) ? 'selected' : '' }}>{{$buyer->FName}} {{$buyer->LName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" id="showingDate" name="showingDate[]" value="{{ old('showingDate.0') }}">
                                @error('showingDate.0')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA <span class="text-danger">*</span></label>
                                <select class="form-select form-select-lg" id="listing" name="listing[]">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ in_array($listing->ListingID, old('listing', [])) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                                    @endforeach
                                </select>
                                @error('listing.0')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 d-flex flex-column check-column" style="height: 70px;">
                                <label for="review" class="form-check-label mr-2">Offer Made</label>
                                <input type="checkbox" id="review" class="form-check-input" name="offer_made[]" {{ in_array('review', old('offer_made', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Follow Up <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.0') }}">
                                @error('follow_up.0')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control form-control-lg" id="showingDate" name="showingDate[]" value="{{ old('showingDate.1') }}">
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA</label>
                                <select class="form-select" id="listing" name="listing[]">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ in_array($listing->ListingID, old('listing', [])) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2  mb-3 d-flex flex-column check-column" style="height: 70px;">
                                <label for="review" class="form-check-label">Offer Made</label>
                                <input type="checkbox" id="review" class="form-check-input" name="offer_made[]" {{ in_array('review', old('offer_made', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Follow Up</label>
                                <input type="text" class="form-control form-control-lg" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.1') }}">
                            </div>


                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control form-control-lg" id="showingDate" name="showingDate[]" value="{{ old('showingDate.2') }}">
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA</label>
                                <select class="form-select form-select-lg" id="listing" name="listing[]">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ in_array($listing->ListingID, old('listing', [])) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2  mb-3 d-flex flex-column check-column" style="height: 70px;">
                                <label for="review" class="form-check-label">Offer Made</label>
                                <input type="checkbox" id="review" class="form-check-input" name="offer_made[]" {{ in_array('review', old('offer_made', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-4 mb-3 d-flex flex-column check-column">
                                <label for="expDate">Follow Up</label>
                                <input type="text" class="form-control form-control-lg" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.2') }}">
                            </div>


                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control form-control-lg" id="showingDate" name="showingDate[]" value="{{ old('showingDate.3') }}">
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA</label>
                                <select class="form-select form-select-lg" id="listing" name="listing[]">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ in_array($listing->ListingID, old('listing', [])) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2  mb-3 d-flex flex-column check-column" style="height: 70px;">
                                <label for="review" class="form-check-label">Offer Made</label>
                                <input type="checkbox" id="review" class="form-check-input" name="offer_made[]" {{ in_array('review', old('offer_made', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Follow Up</label>
                                <input type="text" class="form-control" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.3') }}">
                            </div>


                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control form-control-lg" id="showingDate" name="showingDate[]" value="{{ old('showingDate.4') }}">
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA</label>
                                <select class="form-select" id="listing" name="listing[]">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ in_array($listing->ListingID, old('listing', [])) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2  mb-3 d-flex flex-column check-column" style="height: 70px;">
                                <label for="review" class="form-check-label">Offer Made</label>
                                <input type="checkbox" id="review" class="form-check-input" name="offer_made[]" {{ in_array('review', old('offer_made', [])) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Follow Up</label>
                                <input type="text" class="form-control form-control-lg" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.4') }}">
                            </div>


                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div class="save_buyer_info">
                            <button class="btn-primary btn-save" type="submit" id="prevBtn">Save</button>
                            <button class="btn-primary btn-save" type="button" id="nextBtn" onclick="resetForm()">Reset</button>
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
    document.getElementById("buyer-showing").reset();
    }
           $(document).ready(function () {
                $('#buyer-showing').validate({
                    rules: {
                        'showingDate[]': {
                            required: true
                        },
                        'listing[]': {
                            required: true
                        },
                        'follow_up[]': {
                            required: true
                        },
                        agent_id: {
                            required: true
                        },
                        buyer_id: {
                            required: true
                        },
                        
                    },
                    messages: {
                        'showingDate[]': {
                            required: 'date field is required.' 
                        },
                        'listing[]': {
                            required: 'dba field is required.' 
                        },
                        'follow_up[]': {
                            required: 'follow up field is required.' 
                        },
                      
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
</script>
@endsection