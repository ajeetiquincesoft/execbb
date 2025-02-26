@extends('frontend.layout.buyer-master')
@section('content')
<div class="container buyer-shw-view">
    <h2 class="text-center">Showing Details</h2>
    <div class="row my-4">
        <div class="col-md-4">
            <div class="info-box">
                <h4><strong>Agent</strong></h4>
                <p>{{ $showing->AgentID }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <h4><strong>Buyer</strong></h4>
                <p>{{$buyerName[$showing->BuyerID] ?? 'N/A'}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <h4><strong>Date</strong></h4>
                <p>{{ \Carbon\Carbon::parse($showing->Date)->format('F j, Y') }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <h4><strong>DBA</strong></h4>
                <p>{{$dbaName[$showing->ListingID] ?? 'N/A'}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <h4><strong>Offer Made</strong></h4>
                <p>{{$showing->OfferMade}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <h4><strong>Follow-Up</strong></h4>
                <p>{{ $showing->FollowUp }}</p>
            </div>
        </div>
    </div>
</div>
<style>
    .info-box {
        background-color: #fff;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .info-box h4 {
        font-size: 18px;
        color: #5a102a;
    }

    .info-box p {
        font-size: 16px;
        color: #555;
    }
</style>
@endsection