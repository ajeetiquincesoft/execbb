@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content bg-light">
@if(Session::has('success'))
    <div class="alert alert-success alert-block" id="alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger alert-block" id="alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
    @endif
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">Listings</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('agent.create.listing')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                            <img class="create_img" src="{{ url('assets/images/Listing.png') }}"> Add Listing
                            </button>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                    <form method="GET" action="{{ route('agent.all.listing') }}">
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
                            <th scope="col">Listing ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Active/Inactive</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="listingResults">
                        @foreach($listings as $key=>$listing)
                        <tr>
                            <td>{{$listing->ListingID}}</td>
                            <td>{{$listing->SellerFName}} {{$listing->SellerLName}}</td>
                            <td>{{$listing->SellerCorpName}}</td>
                            <td>{{$listing->SHomeAdd1 ? $listing->SHomeAdd1 : $listing->Address1}}</td>
                            <td>{{$listing->SCity ? $listing->SCity : $listing->City}}</td>
                            <td>{{$listing->SHomePh ? $listing->SHomePh : $listing->Phone}}</td>
                            <td>{{$listing->Email}}</td>
                            <td>@if($listing->Active == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ucfirst($listing->Status)}}</td>
                            <td class="list-btn">
                                <a href="{{ route('agent.show.listing', $listing->ListingID) }}"><button class="btn btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                                </button></a>
                                <a href="{{ route('agent.edit.listing.form', $listing->ListingID) }}"> <button class="btn btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                                </button></a>
                                <form id="delete-form-{{ $listing->ListingID }}" action="{{ route('agent.listing.destroy', $listing->ListingID) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="listingDelete('{{ $listing->ListingID }}')">
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
                    {{ $listings->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection