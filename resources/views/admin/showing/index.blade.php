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
                        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                            <h4 class="mb-0">
                                @if (!empty($listingId))
                                    Showings for Listing #{{ $listingId }}
                                @else
                                    Showings
                                @endif
                            </h4>
                        </div>
                        <div class="col-sm-6 col-md-6  col-lg-3 col-xl-3 d-flex justify-content-end add-list-btn">
                            <a href="{{ route('create.showing') }}">
                                <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                    <img class="create_img" src="{{ url('assets/images/Showings.png') }}"> Add showing
                                </button></a>
                        </div>
                        @if (!empty($listingId))
                            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 d-flex justify-content-start">
                                <a href="{{ route('listing.showings.print', $listingId) }}" target="_blank"
                                    class="btn btn-primary">
                                    <i class="fas fa-print"></i>
                                    Print All Showings
                                </a>
                            </div>
                        @endif
                        <div class="col-sm-12 col-md-12  col-lg-3 col-xl-3" id="list-search">
                            <form method="GET" action="{{ route('all.showing') }}">
                                @if (!empty($listingId))
                                    <input type="hidden" name="listing_id" value="{{ $listingId }}">
                                @endif

                                <div class="input-group" style="max-width: 300px;">
                                    <input type="text" id="search" name="query" class="form-control"
                                        placeholder="Search Here..." value="{{ request('query') }}">

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
                @php
                    $currentSort = request('sort');
                    $currentDirection = request('direction');
                    function sortIcon($column, $currentSort, $currentDirection)
                    {
                        if ($currentSort === $column) {
                            return $currentDirection === 'asc'
                                ? '<i class="fa-solid fa-arrow-up-short-wide"></i>'
                                : '<i class="fa-solid fa-arrow-down-wide-short"></i>';
                        }

                        return '<i class="fa-solid fa-sort"></i>';
                    }

                    function sortDirection($column, $currentSort, $currentDirection)
                    {
                        return $currentSort === $column && $currentDirection === 'asc' ? 'desc' : 'asc';
                    }
                @endphp
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>

                                <th scope="col" class="sortable">
                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'ShowingID',
                                            'direction' => sortDirection('ShowingID', $currentSort, $currentDirection),
                                            'page' => 1,
                                        ]) }}">
                                        # {!! sortIcon('ShowingID', $currentSort, $currentDirection) !!}
                                    </a>
                                </th>

                                <th scope="col" class="sortable">
                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'AgentName',
                                            'direction' => sortDirection('AgentName', $currentSort, $currentDirection),
                                            'page' => 1,
                                        ]) }}">
                                        Agent Name {!! sortIcon('AgentName', $currentSort, $currentDirection) !!}
                                    </a>
                                </th>

                                <th scope="col" class="sortable">
                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'BuyerName',
                                            'direction' => sortDirection('BuyerName', $currentSort, $currentDirection),
                                            'page' => 1,
                                        ]) }}">
                                        Buyer Name {!! sortIcon('BuyerName', $currentSort, $currentDirection) !!}
                                    </a>
                                </th>

                                <th scope="col">
                                    Date
                                </th>

                                <th scope="col" class="sortable">
                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'DBA',
                                            'direction' => sortDirection('DBA', $currentSort, $currentDirection),
                                            'page' => 1,
                                        ]) }}">
                                        DBA {!! sortIcon('DBA', $currentSort, $currentDirection) !!}
                                    </a>
                                </th>

                                <th scope="col">
                                    Offer Made
                                </th>

                                <th scope="col">
                                    Follow Up
                                </th>

                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody id="agentsResult">
                            @forelse($showings as $index =>$showing)
                                <tr>
                                    <td>{{ $showing->ShowingID }}</td>
                                    <td>
                                        {{ trim(($showing->agent_fname ?? '') . ' ' . ($showing->agent_lname ?? '')) ?: 'N/A' }}
                                    </td>
                                    <td>
                                        {{ trim(($showing->buyer_fname ?? '') . ' ' . ($showing->buyer_lname ?? '')) ?: 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $showing->Date ? \Carbon\Carbon::parse($showing->Date)->format('d-m-Y') : 'N/A' }}
                                    </td>
                                    <td>{{ $showing->listing_dba ?? 'N/A' }}</td>
                                    <td>{{ $showing->OfferMade == 1 ? 'Yes' : 'No' }}</td>
                                    <td>{{ $showing->FollowUp }}</td>
                                    <td class="list-btn">
                                        <a href="{{ route('show.showing', $showing->ShowingID) }}">
                                            <button class="btn btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button></a>
                                        <a href="{{ route('edit.showing', $showing->ShowingID) }}">
                                            <button class="btn btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button></a>
                                        <form action="{{ route('showing.destroy', $showing->ShowingID) }}" method="post"
                                            class="showing_delete" id="delete-showing-{{ $showing->ShowingID }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm" title="Delete"
                                                onclick="showingDelete('{{ $showing->ShowingID }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        <!-- <button class="btn btn-sm" title="Download">
                                                                                                                                                                                                                                                                        <i class="fas fa-download"></i>
                                                                                                                                                                                                                                                                    </button> -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center no-data-found">No showing found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="pagination" class="d-flex justify-content-end">
                        {{ $showings->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
