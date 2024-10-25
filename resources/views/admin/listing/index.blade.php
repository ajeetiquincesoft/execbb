@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
            <div class="row card">
                <div class="list-header">

                    <div class="container-fluid py-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                <h4 class="mb-0">Listings</h4>
                            </div>
                            <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                                <a href="{{route('listing.form')}}">
                                <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                    <i class="fas fa-plus mr-1"></i> Add Listings
                                </button>
                            </a>
                            </div>
                            <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                                <div class="input-group" style="max-width: 300px;">
                                    <input type="text" class="form-control" placeholder="Search Here...">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
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
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listings as $key=>$listing)
                                <tr>
                                    <td>{{$listing->ListingID}}</td>
                                    <td>{{$listing->SellerFName}} {{$listing->SellerLName}}</td>
                                    <td>{{$listing->SellerCorpName}}</td>
                                    <td>{{$listing->SHomeAdd1}}</td>
                                    <td>{{$listing->SCity}}</td>
                                    <td>{{$listing->SHomePh}}</td>
                                    <td>{{$listing->Email}}</td>
                                    <td class="list-btn-new">
                                    <a href="{{ route('show.listing', $listing->ListingID) }}"><button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button></a>
                                        <a href="{{ route('edit.listing.form', $listing->ListingID) }}"> <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button></a>
                                        <form id="delete-form-{{ $listing->ListingID }}" action="{{ route('listing.destroy', $listing->ListingID) }}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="button" class="btn btn-sm" title="Delete" onclick="listingDelete('{{ $listing->ListingID }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                          </form>
                                        <button class="btn btn-sm" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                          {{ $listings->links('pagination::bootstrap-4') }} 
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection