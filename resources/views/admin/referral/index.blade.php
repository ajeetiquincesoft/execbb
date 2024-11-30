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
                        <h4 class="mb-0">Referrals</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.referral')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                            <img class="create_img" src="{{ url('assets/images/Referrals.png') }}"> Add referral
                            </button></a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('all.referral') }}">
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
                            <th scope="col">Referral ID</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Agent Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">State</th>
                            <th scope="col">Zip</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @foreach($referrals as $index =>$referral)
                        <tr>
                            <td>{{$referral->RefID  }}</td>
                            <td>{{ $referral->RefCompany}}</td>
                            <td>{{ $referral->AgentName}}</td>
                            <td>{{ $referral->Address1}}</td>
                            <td>{{ $referral->City}}</td>
                            <td>{{ $referral->State }}</td>
                            <td>{{ $referral->Zip }}</td>
                            <td>{{ $referral->Phone }}</td>
                            <td class="list-btn">
                            <a href="{{route('show.referral',$referral->RefID)}}">
                                        <button class="btn btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button></a>
                            <a href="{{route('edit.referral',$referral->RefID)}}">
                                        <button class="btn btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button></a>
                                <form action="{{route('referral.destroy',$referral->RefID)}}" method="post" class="referral_delete" id="delete-referral-{{ $referral->RefID }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="referralDelete('{{ $referral->RefID}}')">
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
                    {{ $referrals->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection