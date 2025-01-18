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
                    <div class="col-12 col-md-6 col-lg-2">
                        <h4 class="mb-0">Listings</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end add-list-btn">
                        <a href="{{route('agent.create.listing')}}">
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
                            <option value="expired">Expired</option>
                            <option value="delete">Delete</option>
                            <option value="close">Close</option>
                        </select>
                        <!-- <div class="btn-group">
                          
                            <div class="btn btn-primary btn-lg pl-4 pr-0 check-button header-btn">
                                <label class="custom-control custom-checkbox mb-0 d-inline-block">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </div>

                            
                            <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                           
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item dropdown-item-val" href="delete">Delete</a>
                                <a class="dropdown-item dropdown-item-val" href="active">Active</a>
                                <a class="dropdown-item dropdown-item-val" href="Inactive">Inactive</a>
                                <a class="dropdown-item dropdown-item-val" href="close">Close</a>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('agent.all.listing') }}">
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
                                    <input type="checkbox" name="checkListing" value="" class="custom-control-input listing-check" id="checkAll">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="listingResults">
                        @foreach($listings as $key=>$listing)
                        <tr>
                            <td class="checkList">
                                <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                                    <input type="checkbox" name="listing_id[]" value="{{$listing->ListingID}}" class="custom-control-input listing-check">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </td>
                            <td>{{$listing->ListingID}}</td>
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
                            <td class="list-btn">
                                <a href="{{ route('agent.show.listing', $listing->ListingID) }}"><button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{ route('agent.edit.listing.form', $listing->ListingID) }}"> <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form id="delete-form-{{ $listing->ListingID }}" action="{{ route('agent.listing.destroy', $listing->ListingID) }}" method="post">
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
                        @endforeach
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
            // event.preventDefault();

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
                        url: "{{ route('agent.listing.bulkAction') }}",
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
<style>
    /* General Styles for Desktop */
    .check-button {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        padding: 0 20px;
    }

    /* Dropdown Button - Adjust Height */
    .dropdown-toggle-split {
        height: 40px;
        padding: 10px 20px;
        display: flex;
        align-items: center;
    }

    /* Dropdown Menu - Position and Alignment */
    .dropdown-menu {
        min-width: 160px;
        padding: 0;
        border-radius: 10px;
    }

    /* Dropdown items height adjustment */
    .dropdown-item {
        height: 40px;
        display: flex;
        align-items: center;
        padding: 10px 20px;
    }

    /* Responsive Styles for Mobile Devices */
    @media (max-width: 768px) {

        /* Adjust check-button padding and height for smaller screens */
        .check-button {
            height: 35px;
            padding: 0 15px;
        }

        /* Adjust dropdown button padding and height */
        .dropdown-toggle-split {
            height: 35px;
            padding: 8px 15px;
        }

        /* Adjust dropdown menu width and items for mobile */
        .dropdown-menu {
            min-width: 140px;
        }

        /* Adjust dropdown item height and padding */
        .dropdown-item {
            height: 35px;
            padding: 8px 15px;
        }
    }

    /* Extra small screen styles (mobile portrait) */
    @media (max-width: 480px) {

        /* Further adjust check-button height for very small screens */
        .check-button {
            height: 30px;
            padding: 0 10px;
        }

        /* Further adjust dropdown button height and padding */
        .dropdown-toggle-split {
            height: 30px;
            padding: 6px 10px;
        }

        /* Further adjust dropdown menu width and items for smaller mobile screens */
        .dropdown-menu {
            min-width: 130px;
        }

        /* Further adjust dropdown item height and padding */
        .dropdown-item {
            height: 30px;
            padding: 6px 10px;
        }
    }


    /* Responsive layout for smaller screens */
    @media (max-width: 768px) {
        .btn {
            margin-bottom: 10px;
        }
    }
</style>
@endsection