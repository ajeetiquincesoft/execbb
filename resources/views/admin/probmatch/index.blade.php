@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">ProbMatch</h4>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.probmatch')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Showings.png') }}"> Add ProbMatch
                            </button></a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 ml-auto" id="login_activity_search">
                        <form method="GET" action="{{ route('probmatch') }}">
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
                            <th scope="col">Buyer</th>
                            <th scope="col">Listing</th>
                            <th scope="col">BusInt</th>
                            <th scope="col">Location</th>
                            <th scope="col">Price</th>
                            <th scope="col">Down Pay</th>
                            <th scope="col">Vol</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Overall</th>
                            <th scope="col">Date Range</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @foreach($probMatchs as $index=>$probMatch)
                        <tr>
                            <td>{{ $index + 1 + ($probMatchs->currentPage() - 1) * $probMatchs->perPage() }}</td>
                            <td>{{ $buyer_name[$probMatch->BuyerID] ?? 'N/A' }}</td>
                            <td>{{ $listing_name[$probMatch->ListingID] ?? 'N/A' }}</td>
                            <td>{{ $probMatch->BusInt }}</td>
                            <td>{{ $probMatch->Location }}</td>
                            <td>{{ $probMatch->Price }}</td>
                            <td>{{ $probMatch->DownPay }}</td>
                            <td>{{ $probMatch->Vol }}</td>
                            <td>{{ $probMatch->Profit }}</td>
                            <td>{{ $probMatch->Overall }}</td>
                            <td>{{ $probMatch->DateRank }}</td>
                            <td class="list-btn">
                                <a href="{{route('edit.probmatch',$probMatch->id)}}">
                                    <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form action="{{route('probmatch.destroy',$probMatch->id)}}" method="post" class="probmatch_delete" id="delete-probmatch-{{ $probMatch->id  }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="probmatchDelete('{{ $probMatch->id}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!-- <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $probMatchs->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection