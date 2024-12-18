@extends('agent-dashboard.layout.master')
@section('content')
<div class="container-fluid content bg-light">
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">Buyers</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="#">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                            <img class="create_img" src="{{ url('assets/images/Buyers.png') }}"> Add Buyers
                            </button></a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('agent.list.buyer') }}">
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
                            <th scope="col">Buyer ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @foreach($buyers as $index =>$buyer)
                        <tr>
                            <td>{{ $buyer->BuyerID}}</td>
                            <td>{{ $buyer->FName}} {{ $buyer->LName}}</td>
                            <td>{{ $buyer->Address1}}</td>
                            <td>{{ $buyer->HomePhone}}</td>
                            <td>{{ $buyer->Email}}</td>
                            <td class="list-btn">
                                <a href="{{ route('agent.show.buyer', $buyer->BuyerID) }}">
                                    <button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                    <form action="{{ route('agent.buyer.destroy', $buyer->BuyerID) }}" method="post" class="buyer_delete" id="delete-buyer-{{ $buyer->BuyerID }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="buyerDelete('{{ $buyer->BuyerID }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                               <!--  <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $buyers->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection