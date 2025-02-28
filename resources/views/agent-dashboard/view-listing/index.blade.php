@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 col-lg-6">
                        <h4 class="mb-0">Listing Visit By Buyers</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6  d-flex justify-content-end" id="list-search">
                        <form method="GET" action="{{ route('agent.buyer.listing.visit') }}">
                            <div class="input-group" style="max-width: 300px;">
                                <input type="text" id="search" name="query" class="form-control" placeholder="Search Here..." value="{{ request('query') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-data">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Listing ID</th>
                            <th scope="col">Listing Name</th>
                            <th scope="col">Buyer Name</th>
                            <th scope="col">Buyer Email</th>
                            <th scope="col">Visited Date</th>
                        </tr>
                    </thead>
                    <tbody id="leadResults">
                        @forelse($buyerVisitLists as $key=>$buyerVisitList)
                        <tr>
                            <td>{{ $key + 1 + ($buyerVisitLists->currentPage() - 1) * $buyerVisitLists->perPage() }}</td>
                            <td>{{$buyerVisitList->listing_id}}</td>
                            <td><a href="{{route('view.business.listing', $buyerVisitList->listing_id)}}" target="_blank">{{$buyerVisitList->listing->SellerCorpName}}</a></td>
                            <td>{{$buyerVisitList->buyer->FName}} {{$buyerVisitList->buyer->LName}}</td>
                            <td>{{$buyerVisitList->buyer->Email}}</td>
                            <td>{{\Carbon\Carbon::parse($buyerVisitList->buyer->viewed_at)->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No visitor found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $buyerVisitLists->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection