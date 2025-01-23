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
                    <div class="col-12 col-md-6 col-lg-2">
                        <h4 class="mb-0">Listings</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end add-list-btn">
                        <a href="{{route('listing.form')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Listing.png') }}"> Add Listing
                            </button>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end action_bt">
                        <select class="form-control" id="change_status">
                            <option value="">Change Listing Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="valid">Valid</option>
                            <option value="sole exclusive">Sole-Exclusive</option>
                            <option value="delete">Delete</option>
                            <option value="close">Close</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('all.listing') }}">
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
                                    <input type="checkbox" name="checkListing" value="" class="custom-control-input" id="checkAll">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label></th>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Act/Ina</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="listingResults">
                        @forelse($listings as $key=>$listing)
                        <tr>
                            <td class="checkList">
                                <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                                    <input type="checkbox" name="listing_id[]" value="{{$listing->ListingID}}" class="custom-control-input listing-check">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </td>
                            <td>{{ $key + 1 + ($listings->currentPage() - 1) * $listings->perPage() }}</td>
                            <td>{{$listing->SellerFName}} {{$listing->SellerLName}}</td>
                            <td>{{$listing->SellerCorpName}}</td>
                            <td>{{$listing->SHomeAdd1 ? $listing->SHomeAdd1 : $listing->Address1}}</td>
                            <td>{{$listing->SCity ? $listing->SCity : $listing->City}}</td>
                            <td>{{$listing->SHomePh ? $listing->SHomePh : $listing->Phone}}</td>
                            <td>{{$listing->Email}}</td>
                            <td>@if($listing->Active == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ucfirst($listing->Status)}}</td>
                            <td class="list-btn" style="width: 120px;">
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
                                <!-- <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No listing found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $listings->appends(request()->query())->links('vendor.pagination.custom') }}
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
        $('#checkAll').on('change', function() {
            $('.listing-check').prop('checked', this.checked);
        });
        $('.listing-check').on('change', function() {
            if ($('.listing-check:checked').length === $('.listing-check').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
        $('#change_status').change(function() {
            // Prevent the default behavior of the link
            //event.preventDefault();

            // Get the href value of the clicked item
            var action_val = $(this).val();
            // Get the selected listing ids from checkboxes
            let selectedIds = $('.listing-check:checked').map(function() {
                return $(this).val();
            }).get();

            // Check if there are any selected listings
            if (selectedIds.length > 0) {
                if (action_val == 'delete') {
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
                                url: "{{ route('listing.bulkAction') }}",
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    action: action_val,
                                    listing_id: selectedIds
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
                        url: "{{ route('listing.bulkAction') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            action: action_val,
                            listing_id: selectedIds
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
                    text: 'Please select at least one listing.',
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