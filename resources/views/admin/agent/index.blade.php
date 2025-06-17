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
                                <img class="create_img" src="{{ url('assets/images/Agents.png') }}"> Add Agent
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
                            <th scope="col">#</th>
                            <th scope="col">Agent ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="agentsResult">
                        @forelse($agents as $index =>$agent)
                        <tr>
                            <td>{{ $index + 1 + ($agents->currentPage() - 1) * $agents->perPage() }}</td>
                            <td>{{ $agent->AgentID}}</td>
                            <td>{{ $agent->FName}} {{ $agent->LName}}</td>
                            <td>{{ $agent->Address1}}</td>
                            <td>{{ $agent->Telephone}}</td>
                            <td>{{ $agent->Email}}</td>
                            <td class="list-btn">
                                <a href="{{ route('show.agent', $agent->AgentUserRegisterId) }}">
                                    <button class="btn btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button></a>
                                <a href="{{ route('edit.agent', $agent->AgentUserRegisterId) }}">
                                    <button class="btn btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button></a>
                                <form action="{{ route('agents.destroy', $agent->AgentUserRegisterId) }}" method="post" class="agent_delete" id="delete-agent-{{ $agent->AgentUserRegisterId }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" title="Delete" onclick="confirmDelete('{{ $agent->AgentUserRegisterId }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @php
                                $id = $agent->AgentUserRegisterId;
                                $name = $agent->FName . ' ' . $agent->LName;
                                @endphp
                                <button type="button" class="btn btn-sm btn-deactivate" title="Deactivate" data-toggle="modal"
                                    data-target="#deactivateModal" data-agent-id="{{$id}}" data-agent-name="{{$name}}">
                                    <i class="fas fa-user-slash text-warning"></i>
                                </button>
                                <!-- <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No agent found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $agents->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
            <!-- Deactivation Modal -->
            <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form id="deactivateAgentForm" method="POST" action="{{ route('agent.deactivate') }}">
                        @csrf
                        <input type="hidden" name="agent_id" id="deactivateAgentId">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Deactivate Agent</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Deactivating:</strong> <span id="deactivateAgentName"></span></p>
                                <div class="form-group">
                                    <label for="new_agent_id">Reassign all data to:</label>
                                    <input type="text" class="form-control" id="agentSearch" placeholder="Search agents...">
                                    <select class="form-control mt-2" name="new_agent_id" id="newAgentDropdown" required>
                                        <!-- Options will be loaded via JS -->
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Confirm Deactivate</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
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

        $('.btn-deactivate').on('click', function() {
            const agentId = $(this).data('agent-id');
            const agentName = $(this).data('agent-name');
            $('#deactivateAgentId').val(agentId);
            $('#deactivateAgentName').text(agentName);
            $('#agentSearch').val('');
            $('#newAgentDropdown').empty();
        });

        // Dynamic agent search
        $(document).on('keyup', '#agentSearch', function() {
            const keyword = $(this).val();
            if (keyword.length >= 2) {
                $.ajax({
                    url: "{{ route('assign.agent.search') }}",
                    method: 'GET',
                    data: {
                        keyword
                    },
                    success: function(data) {
                        let options = '<option value="">Select Agent</option>';
                        data.forEach(agent => {
                            options += `<option value="${agent.AgentUserRegisterId}">${agent.FName} ${agent.LName} (${agent.AgentID})</option>`;
                        });
                        $('#newAgentDropdown').html(options);
                    }
                });
            }
        });


    });
</script>
@endsection