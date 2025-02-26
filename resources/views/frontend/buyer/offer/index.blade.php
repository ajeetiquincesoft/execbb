@extends('frontend.layout.buyer-master')
@section('content')
<div class="container-showing">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
        <strong>{{ Session::get('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row card">
        <div class="list-header">

            <div class="container-fluid py-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">Offers</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('buyer.create.offer')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Off-Esc-Close.png') }}"> Add Offer
                            </button></a>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('buyer.all.offer') }}">
                            <div class="input-group search-bar-container">
                                <input type="text" id="search" name="query" class="form-control search-input" placeholder="Search Here..." value="{{ request('query') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn search-btn">
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
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                    @forelse($offers as $index =>$offer)
                        <tr>
                        <td>{{ $index + 1 + ($offers->currentPage() - 1) * $offers->perPage() }}</td>
                            <td>{{ $company_name[$offer->ListingID] ?? 'N/A' }}</td>
                            <td>{{ $offer->Status}}</td>
                            <td class="list-btn">
                                <a href="{{route('buyer.show.offer',$offer->OfferID)}}">
                                    <button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{route('buyer.edit.offer.form',$offer->OfferID)}}">
                                    <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form action="{{route('buyer.offer.destroy',$offer->OfferID)}}" method="post" class="offer_delete" id="delete-offer-{{ $offer->OfferID  }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="buyerOfferDelete('{{ $offer->OfferID}}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <!--  <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No offer found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                {{ $offers->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    td.list-btn {
        display: flex;
        justify-content: space-between;
    }

    i.fas.fa-eye {
        color: #28a745;
    }

    i.fas.fa-edit {
        color: #007bff;
    }

    i.fas.fa-trash {
        color: #dc3545;
    }

    img.create_img {
        height: 20px;
    }

    tbody#agentsResult tr td {
        color: #626262;
    }
</style>

<script>
    function buyerOfferDelete(customId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5e0f2f',
            cancelButtonColor: '#93744b',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form for deletion
                document.getElementById('delete-offer-' + customId).submit();
            }
        });
    }
</script>
@endsection