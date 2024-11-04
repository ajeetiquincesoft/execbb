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
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" id="search" class="form-control" placeholder="Search Here...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
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
                                <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $leads->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetch_data(page, query = '') {
            $.ajax({
                url: "{{ route('all.lead') }}",
                data: {
                    page: page,
                    query: query
                },
                dataType: 'json',
                success: function(data) {
                    $('#leadResults').empty(); // Clear previous results

                    // Check if data is empty
                    if (data.data.length === 0) {
                        $('#leadResults').append(`
                    <tr>
                        <td colspan="8" class="text-center">No records found.</td>
                    </tr>
                `);
                    } else {
                        // Loop through the data and append rows to the table
                        data.data.forEach(item => {
                            $('#leadResults').append(`
                        <tr id="lead-row-${item.LeadID}">
                            <td id="lead-id-${item.LeadID}">${item.LeadID}</td>
                            <td>${item.SellerFName} ${item.SellerLName}</td>
                            <td>${item.category_name || 'N/A'}</td>
                            <td>${item.BusName}</td>
                            <td>${item.Address}</td>
                            <td>${item.Phone}</td>
                            <td>${item.AppointmentDate}</td>
                            <td class="list-btn">
                                <a href="/leads/${item.LeadID}">
                                    <button class="btn btn-sm" title="View" id="view-btn-${item.LeadID}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="/leads/${item.LeadID}/edit">
                                    <button class="btn btn-sm" title="Edit" id="edit-btn-${item.LeadID}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <form id="delete-form-${item.LeadID}" action="/leads/${item.LeadID}" method="post" style="display:inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="button" class="btn btn-sm" title="Delete" id="delete-btn-${item.LeadID}" onclick="leadDelete('${item.LeadID}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm" title="Download" id="download-btn-${item.LeadID}">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                        });
                    }

                    // Update pagination links if necessary
                    $('#pagination').html(createPaginationLinks(data.pagination));
                }
            });
        }



        function createPaginationLinks(pagination) {
            let links = '';
            if (pagination.last_page > 1) {
                // Previous link
                links += `
            <li class="${pagination.current_page === 1 ? 'disabled' : ''}">
                <a href="#" class="pagination-link" data-page="${pagination.current_page - 1}" rel="prev">&lsaquo; Previous</a>
            </li>
        `;

                // Page links
                for (let i = 1; i <= pagination.last_page; i++) {
                    const activeClass = i === pagination.current_page ? 'active' : '';
                    links += `
                <li class="${activeClass}">
                    <a href="#" class="pagination-link" data-page="${i}">${i}</a>
                </li>
            `;
                }

                // Next link
                links += `
            <li class="${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
                <a href="#" class="pagination-link" data-page="${pagination.current_page + 1}" rel="next">Next &rsaquo;</a>
            </li>
        `;
            }
            return `<ul class="pagination">${links}</ul>`;
        }


        // Trigger search on input
        $(document).on('keyup', '#search', function() {
            const query = $(this).val();
            fetch_data(1, query); // Always start from the first page
        });

        // Handle pagination click
        $(document).on('click', '.pagination-link', function(event) {
            event.preventDefault();
            const page = $(this).data('page');
            const query = $('#search').val();
            fetch_data(page, query); // Use the current search query
        });
    });
</script>
@endsection