
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form id="editShowing" action="{{ route('update.showing',$showing->ShowingID) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div>
                        <h1>Showing:</h1>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-md-6  mb-3" style="height: 70px;">
                                <label for="agent">Agents <span class="text-danger">*</span></label>
                                <select class="form-select" id="agent_id" name="agent_id">
                                    <option value="" selected="">Select Agents</option>
                                    @foreach($agents as $agent)
                                    <option value="{{$agent->AgentID}}" {{ ($showing->AgentID == $agent->AgentID) ? 'selected' : '' }}>{{$agent->FName}} {{$agent->LName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6  mb-3" style="height: 70px;">
                                <label for="buyer">Buyers <span class="text-danger">*</span></label>
                                <select class="form-select" id="buyer_id" name="buyer_id">
                                    <option value="" selected="">Select Buyers</option>
                                    @if(isset($selectedBuyer))
                                        <option value="{{ $selectedBuyer->BuyerID }}" selected>{{ $selectedBuyer->FName }}</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 mb-3">
                                <label for="expDate">Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="showingDate" name="showingDate" value="{{ \Carbon\Carbon::parse($showing->Date)->format('Y-m-d') }}">
                                @error('showingDate')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3  mb-3" style="height: 70px;">
                                <label for="status">DBA <span class="text-danger">*</span></label>
                                <select class="form-select" id="listing" name="listing">
                                    <option value="">Select Listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}"  {{ $listing->ListingID == $showing->ListingID ? 'selected' : '' }}>{{ (!empty(trim($listing->CorpName ?? '')) ? $listing->CorpName : $listing->DBA) }}</option>
                                    @endforeach
                                </select>
                                @error('listing')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 d-flex flex-column check-column" style="height: 70px;">
                                <label for="review" class="form-check-label mr-2">Offer Made</label>
                                <input type="checkbox" id="review" class="form-check-input" name="offer_made" {{ ($showing->OfferMade == 1) ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expDate">Follow Up <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="follow_up" name="follow_up"  value="{{$showing->FollowUp}}">
                                @error('follow_up')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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

           $(document).ready(function () {
                $('#editShowing').validate({
                    rules: {
                        showingDate: {
                            required: true
                        },
                        listing: {
                            required: true
                        },
                        follow_up: {
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
                                    };
                                }),
                                pagination: {
                                    more: data.length === 20
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    width: '100%'
                });
            });
</script>
@endsection