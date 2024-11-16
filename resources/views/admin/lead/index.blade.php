@extends('admin.layout.master')
@section('content')
<div class="container-fluid content bg-light">
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
                        <h4 class="mb-0">Leads</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.lead')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Lead.png') }}"> Add Leads
                            </button>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                    <form method="GET" action="{{ route('all.lead') }}">
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
                            <th scope="col">Lead ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Business Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Appoinment Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="leadResults">
                        @foreach($leads as $key=>$lead)
                        <tr>
                            <td>{{$lead->LeadID}}</td>
                            <td>{{$lead->SellerFName}} {{$lead->SellerLName}}</td>
                            <td>{{ $categories[$lead->Category] ?? 'N/A' }}</td>
                            <td>{{$lead->BusName}}</td>
                            <td>{{$lead->Address}}</td>
                            <td>{{$lead->Phone}}</td>
                            <td>{{$lead->AppointmentDate}}</td>
                            <td class="list-btn">
                                <a href="{{ route('show.lead', $lead->LeadID) }}"><button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{ route('edit.lead', $lead->LeadID) }}"> <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form id="delete-form-{{ $lead->LeadID }}" action="{{ route('lead.destroy', $lead->LeadID) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="leadDelete('{{$lead->LeadID}}')">
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
                    {{ $leads->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection