@extends('agent-dashboard.layout.master')
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
                        <h4 class="mb-0">Login Lists</h4>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 ml-auto" id="login_activity_search">
                        <form method="GET" action="{{ route('agent.login.activities') }}">
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
                            <th scope="col">User</th>
                            <th scope="col">IP Address</th>
                            <th scope="col">User Information</th>
                            <th scope="col">Logged In At</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                    @php
                        $counter = ($loginActivities->currentPage() - 1) * $loginActivities->perPage() + 1;
                    @endphp
                        @foreach($loginActivities as $activity)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $activity->user->name }}</td>
                            <td>{{ $activity->ip_address }}</td>
                            <td>{{ $activity->user_info }}</td>
                            <td>{{ $activity->logged_in_at }}</td>
                        </tr>
                        @php
                            $counter++;
                        @endphp
                        @endforeach 
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $loginActivities->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection