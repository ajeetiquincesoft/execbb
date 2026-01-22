
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="showing" action="{{route('store.showing')}}" method="post">
                    @csrf
                    <div>
                        <h1>Add Showing</h1>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-md-6  mb-3" style="height: 70px;">
                                <label for="agent">Agents <span class="text-danger">*</span></label>
                                <select class="form-select" id="agent_id" name="agent_id">
                                    <option value="" selected="">Select Agents</option>
                                    @foreach($agents as $agent)
                                    <option value="{{$agent->AgentID}}" {{ (old('agent_id') == $agent->AgentID) ? 'selected' : '' }}>{{$agent->FName}} {{$agent->LName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6  mb-3" style="height: 70px;">
                                <label for="buyer">Buyers <span class="text-danger">*</span></label>
                                <select class="form-select" id="buyer_id" name="buyer_id">
                                    <option value="" selected="">Select Buyers</option>
                                    @foreach($buyers as $buyer)
                                    <option value="{{$buyer->BuyerID}}" {{ (old('buyer_id') == $buyer->BuyerID) ? 'selected' : '' }}>{{$buyer->FName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="showingDate" name="showingDate[]" value="{{ old('showingDate.0') }}">
                                @error('showingDate.0')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA <span class="text-danger">*</span></label>
                                <select class="form-select" id="listing" name="listing[]">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ in_array($listing->ListingID, old('listing', [])) ? 'selected' : '' }}>{{ (!empty(trim($listing->CorpName ?? '')) ? $listing->CorpName : $listing->DBA) }}</option>
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
                                <input type="text" class="form-control" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.0') }}">
                                @error('follow_up.0')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control" id="showingDate" name="showingDate[]" value="{{ old('showingDate.1') }}">
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
                                <input type="text" class="form-control" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.1') }}">
                            </div>


                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control" id="showingDate" name="showingDate[]" value="{{ old('showingDate.2') }}">
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
                            <div class="col-md-4 mb-3 d-flex flex-column check-column">
                                <label for="expDate">Follow Up</label>
                                <input type="text" class="form-control" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.2') }}">
                            </div>


                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control" id="showingDate" name="showingDate[]" value="{{ old('showingDate.3') }}">
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
                                <input type="text" class="form-control" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.3') }}">
                            </div>


                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date</label>
                                <input type="date" class="form-control" id="showingDate" name="showingDate[]" value="{{ old('showingDate.4') }}">
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
                                <input type="text" class="form-control" id="follow_up" name="follow_up[]"  value="{{ old('follow_up.4') }}">
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
    document.getElementById("showing").reset();
    }
           $(document).ready(function () {
                $('#showing').validate({
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
                 $('#buyer_id').select2({
                    placeholder: 'Select Buyer',
                    ajax: {
                        url: "{{ route('showings.buyers.ajax.load') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term || '',
                                page: params.page || 1
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.BuyerID,
                                        text: item.FName
                                    }
                                }),
                                pagination: {
                                    more: data.length === 20
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0
                });

                // Preselect if old value exists
                @if(old('buyer') || session('offerData.buyer'))
                $.ajax({
                    url: "{{ route('showings.buyers.ajax.load') }}",
                    data: {
                        search: '',
                        page: 1
                    },
                    success: function (data) {
                        let selectedID = "{{ old('buyer') ?? session('offerData.buyer') }}";
                        let match = data.find(item => item.BuyerID == selectedID);
                        if (match) {
                            let option = new Option(match.FName, match.BuyerID, true, true);
                            $('#buyer').append(option).trigger('change');
                        }
                    }
                });
                @endif
            });
</script>
@endsection