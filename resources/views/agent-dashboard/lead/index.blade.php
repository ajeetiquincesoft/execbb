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
                    <div class="col-12 col-md-6 col-lg-6">
                        <h4 class="mb-0">Leads</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6  d-flex justify-content-end" id="list-search">
                        <form method="GET" action="{{ route('agent.all.leads') }}">
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
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Bus. Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Appt. Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="leadResults">
                        @forelse($leads as $key=>$lead)
                        <tr>
                            <td>{{ $key + 1 + ($leads->currentPage() - 1) * $leads->perPage() }}</td>
                            <td>{{$lead->SellerFName}} {{$lead->SellerLName}}</td>
                            <td>{{ $categories[$lead->Category] ?? 'N/A' }}</td>
                            <td>{{$lead->BusName}}</td>
                            <td>{{$lead->Address}}</td>
                            <td>{{$lead->Phone}}</td>
                            <td>{{$lead->AppointmentDate}}</td>
                            <td>{{ $lead_status[$lead->Status] ?? 'N/A' }}</td>
                            <td class="list-btn">
                                <a href="{{ route('agent.show.lead', $lead->LeadID) }}"><button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                            </td>
                           
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No lead found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $leads->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection