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
                    <div class="col-12 col-md-6 col-lg-2">
                        <h4 class="mb-0">Offers</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.offer')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Off-Esc-Close.png') }}"> Add Offer
                            </button></a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end action_bt">
                        <select class="form-control" id="change_offer_status">
                            <option value="">Change Offer Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Closed">Closed</option>
                            <option value="Dead">Dead</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('all.offer') }}">
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
                        <th scope="col" class="checkList"><label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                                    <input type="checkbox" name="checkOffer" value="" class="custom-control-input" id="checkAllOffer">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label></th>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @forelse($offers as $index =>$offer)
                        <tr>
                        <td class="checkList">
                                <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                                    <input type="checkbox" name="offer_id[]" value="{{$offer->OfferID}}" class="custom-control-input offer-check">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </td>
                            <td>{{ $index + 1 + ($offers->currentPage() - 1) * $offers->perPage() }}</td>
                            <td>{{ $company_name[$offer->ListingID] ?? 'N/A' }}</td>
                            <td>{{ $offer->Status}}</td>
                            <td class="list-btn">
                                <a href="{{route('show.offer',$offer->OfferID)}}">
                                    <button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{route('edit.offer.form',$offer->OfferID)}}">
                                    <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form action="{{route('offer.destroy',$offer->OfferID)}}" method="post" class="offer_delete" id="delete-offer-{{ $offer->OfferID  }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="offerDelete('{{ $offer->OfferID}}')">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#checkAllOffer').on('change', function() {
            $('.offer-check').prop('checked', this.checked);
        });
        $('.offer-check').on('change', function() {
            if ($('.offer-check:checked').length === $('.offer-check').length) {
                $('#checkAllOffer').prop('checked', true);
            } else {
                $('#checkAllOffer').prop('checked', false);
            }
        });
        $('#change_offer_status').change(function() {
            // Prevent the default behavior of the link
            //event.preventDefault();

            // Get the href value of the clicked item
            var action_val = $(this).val();
            // Get the selected listing ids from checkboxes
            let selectedIds = $('.offer-check:checked').map(function() {
                return $(this).val();
            }).get();

            // Check if there are any selected listings
            if (selectedIds.length > 0) {
                if (action_val == 'Delete') {
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
                            $.ajax({
                                url: "{{ route('offer.bulkAction.process') }}",
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    action: action_val,
                                    offer_id: selectedIds
                                },
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#5e0f2f',
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // Handle error
                                    if (xhr.status === 419) {
                                        alert('CSRF token mismatch. Please reload the page and try again.');
                                    } else {
                                        alert('An error occurred while processing your request.');
                                    }
                                }
                            });
                        }
                    });

                } else {
                    $.ajax({
                        url: "{{ route('offer.bulkAction.process') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            action: action_val,
                            offer_id: selectedIds
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#5e0f2f',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            if (xhr.status === 419) {
                                alert('CSRF token mismatch. Please reload the page and try again.');
                            } else {
                                alert('An error occurred while processing your request.');
                            }
                        }
                    });

                }

            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select at least one offer.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#5e0f2f',
                }).then(() => {
                    location.reload();
                });
            }
        });

    });
</script>
@endsection