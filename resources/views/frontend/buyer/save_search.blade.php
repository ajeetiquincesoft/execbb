@extends('frontend.layout.buyer-master')
@section('content')
<div class="container mt-5">
    <div class="save-search-container">
        <h2 class="text-center mb-2">Your Saved Searches</h2>
        <p class="text-center mb-5">Below are the results of your saved searches. You can view the details of each search.</p>

        <div class="row">
            @foreach($saveSearch as $result)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-lg border-light rounded">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ ucfirst($result->search_val) }}</h5>
                        <p class="card-text">
                            <strong>Industry:</strong> {{ $result->industry }}<br>
                            <strong>State:</strong> {{ $result->state }}<br>
                            <strong>Search Type:</strong> {{ $result->search_for }}<br>
                            <small class="text-muted">Created on: {{ $result->created_at->format('M d, Y') }}</small>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div id="pagination" class="d-flex justify-content-end">
            {{ $saveSearch->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
@endsection