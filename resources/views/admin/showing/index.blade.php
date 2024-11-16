@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">Showings</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.referral')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                            <img class="create_img" src="{{ url('assets/images/Referrals.png') }}"> Add showings
                            </button></a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('all.showing') }}">
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
                            <th scope="col">Showing ID</th>
                            <th scope="col">Agent Name</th>
                            <th scope="col">Buyer Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">DBA</th>
                            <th scope="col">Offer Made</th>
                            <th scope="col">Follow Up</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @foreach($showings as $index =>$showing)
                        <tr>
                            <td>{{ $showing->ShowingID}}</td>
                            <td>{{ $showing->AgentID}}</td>
                            <td>{{ $buyerName[$showing->BuyerID] ?? 'N/A'}}</td>
                            <td>{{ $showing->Date}}</td>
                            <td>{{ $dbaName[$showing->ListingID] ?? 'N/A'}}</td>
                            <td>{{ $showing->OfferMade }}</td>
                            <td>{{ $showing->FollowUp }}</td>
                            <td class="list-btn">
                            <a href="{{route('show.showing',$showing->ShowingID)}}">
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button></a>
                            <a href="{{route('edit.showing',$showing->ShowingID)}}">
                                <button class="btn btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button></a>
                                <form action="{{route('showing.destroy',$showing->ShowingID)}}" method="post" class="showing_delete" id="delete-showing-{{ $showing->ShowingID }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm" title="Delete" onclick="showingDelete('{{ $showing->ShowingID}}')">
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
                    {{ $showings->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection