
   
@extends('admin.layout.master')
@section('content')
        <div class="container-fluid content bg-light">
            <div class="row card p-4">
                <form action="{{ route('store.probmatch') }}" method="POST" id="probMatch">
                @csrf 
                     <div class="form-multi-tab">
                        <h1>Add ProbMatch</h1>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="companyName">Listing</label>
                                <select class="form-control" id="listingName" name="listingName">
                                    <option value="">Select listing</option>
                                    @foreach($listings as $listing)
                                    <option value="{{$listing->ListingID}}" {{ (old('listingName') == $listing->ListingID) ? 'selected' : '' }}>{{$listing->SellerCorpName}}</option>
                                    @endforeach
                                </select>
                                @error('listingName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="buyer">Buyer</label>
                                <select class="form-control" id="buyer" name="buyer">
                                    <option value="" selected >Select Buyer</option>
                                    @foreach($buyers as $buyer)
                                    <option value="{{$buyer->BuyerID}}" {{ (old('buyer') == $buyer->BuyerID) ? 'selected' : '' }}>{{$buyer->FName}}</option>
                                    @endforeach
                                </select>
                                @error('buyer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="BusInt">BusInt</label>
                                <input type="text" class="form-control" id="BusInt" name="BusInt" value="{{ old('BusInt')}}">
                                @error('BusInt')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4" style="height: 70px;">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{old('location')}}">
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4" style="height: 70px;">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="downPay">Down Pay</label>
                                <input type="text" class="form-control" id="downPay"
                                    name="downPay" value="{{ old('downPay')}}">
                                    @error('downPay')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 mb-3">
                                <label for="Vol">Vol</label>
                                <input type="text" class="form-control" id="Vol" name="Vol" value="{{old('Vol')}}">
                                @error('Vol')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Profit">Profit</label>
                                <input type="text" class="form-control" id="profit"
                                    name="profit" value="{{ old('profit')}}">
                                    @error('profit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="Overall">Overall</label>
                                <input type="text" class="form-control" id="overall" name="overall" value="{{old('overall')}}">
                                @error('overall')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            
                            <div class="col-md-4 mb-3">
                                <label for="DateRank">Date Rank</label>
                                <input type="date" class="form-control" id="dateRank" name="dateRank" value="{{old('dateRank')}}">
                                @error('dateRank')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="overflow:auto;">
                        <div>
                            <button type="submit" name="submit" class="btn-primary"  id="nextBtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div p-8="">
            <p>&nbsp;</p>
        </div>
        <style>
    .hidden-step {
        display: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
           $(document).ready(function () {
                $('#probMatch').validate({
                    rules: {
                        listingName: {
                            required: true
                        },
                        buyer: {
                            required: true
                        },
                        BusInt: {
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
@endsection