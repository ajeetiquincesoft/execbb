@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="hotsheet-content">
        <h1>Executive Business Brokers</h1>
        <p class="sub-heading">Hot Sheet Offers</p>
        <span class="mb-2">As of: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</span>
    </div>
    <table class="hotsheet-table">
        <thead>
            <tr>
                <th>Date of Offer</th>
                <th>No Show</th>
                <th>Business Name</th>
                <th>ID #</th>
                <th>L.Agent</th>
                <th>S.agent</th>
                <th>Buyer Name/ID</th>
                <th>Price</th>
                <th>Down Pay</th>
                <th>Accepted</th>
                <th>Under Contract</th>
                <th>Check Deposited</th>
                <th>Offer #</th>
                <th>Closing Date</th>
                <th>Closing Place</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
            <tr>
                <td>{{$offer->DateOfOffer}}</td>
                <td>@if($offer->Status == 'Accepted')✓@endif</td>
                <td>{{$offer->SellerCorpName}}</td>
                <td>{{$offer->AgentUserRegisterId}}</td>
                <td>{{$offer->ListingAgent}}</td>
                <td>{{$offer->SellingAgent}}</td>
                <td>{{$offer->BuyerFName}} {{$offer->BuyerLName}} {{$offer->BuyerID}}</td>
                <td>{{$offer->PurchasePrice}}</td>
                <td>{{$offer->DownPaymnt}}</td>
                <td>{{$offer->Status == 'Accepted' ? 'Yes' : ''}}</td>
                <td>No</td>
                <td>{{$offer->DepositCheckNumber}}</td>
                <td>{{$offer->OfferID}}</td>
                <td>{{$offer->SchedCloseDate}}</td>
                <td>{{$offer->SchedClosePlace}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div p-8="">
    <p>&nbsp;</p>
</div>
<style>
    .hotsheet-table {
        border-collapse: collapse;
        width: 100%;
    }

    .hotsheet-table th,
    .hotsheet-table td {
        border: 1px solid black;
        text-align: center;
        font-size: 12px !important;
    }

    .hotsheet-table th {
        background-color: #f2f2f2;
    }

    .hotsheet-content h3 {
        font-weight: bold;
    }
    .hotsheet-content span {
    text-align: center;
    display: block;
}
</style>
@endsection