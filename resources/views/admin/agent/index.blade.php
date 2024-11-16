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
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <h4 class="mb-0">Agents</h4>
                    </div>
                    <div class="col-sm-6 col-md-6  col-lg-4 col-xl-4 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.agent')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                            <img class="create_img" src="{{ url('assets/images/Agents.png') }}"> Add Agents
                            </button></a>
                    </div>
                    <div class="col-sm-12 col-md-12  col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('list.agent') }}">
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
                            <th scope="col">Agent ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @foreach($agents as $index =>$agent)
                        <tr>
                            <td>{{ $agent->AgentID}}</td>
                            <td>{{ $agent->FName}} {{ $agent->LName}}</td>
                            <td>{{ $agent->Address1}}</td>
                            <td>{{ $agent->Telephone}}</td>
                            <td>{{ $agent->email}}</td>
                            <td class="list-btn-new">
                                <a href="{{ route('show.agent', $agent->AgentUserRegisterId) }}">
                                    <button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{ route('edit.agent', $agent->AgentUserRegisterId) }}">
                                    <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form action="{{ route('agents.destroy', $agent->AgentUserRegisterId) }}" method="post" class="agent_delete" id="delete-agent-{{ $agent->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="confirmDelete('{{ $agent->id }}')">
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
                    {{ $agents->appends(request()->query())->links('vendor.pagination.custom') }}
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
                url: "{{ route('list.agent') }}", // Ensure this route matches your search route
                data: {
                    page: page,
                    query: query
                },
                dataType: 'json',
                success: function(data) {
                    $('#agentsResult').empty(); // Clear previous results
                    // Check if data is empty
                    if (data.data.length === 0) {
                        $('#agentsResult').append(`
                    <tr>
                        <td colspan="8" class="text-center">No records found.</td>
                    </tr>
                `);
                    } else {
                        // Loop through the agent data and append rows
                        data.data.forEach(agent => {
                            $('#agentsResult').append(`
                    <tr>
                        <td>${agent.agent_info.AgentID}</td>
                        <td>${agent.name}</td>
                        <td>${agent.agent_info.Address1}</td>
                        <td>${agent.agent_info.Telephone}</td>
                        <td>${agent.email}</td>
                        <td class="list-btn-new">
                            <a href="{{ route('show.agent', '') }}/${agent.id}">
                                <button class="btn btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                            <a href="{{ route('edit.agent', '') }}/${agent.id}">
                                <button class="btn btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <form action="{{ route('agents.destroy', '') }}/${agent.id}" method="post" class="agent_delete" id="delete-agent-${agent.id}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm" title="Delete" onclick="confirmDelete('${agent.id}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm" title="Download">
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