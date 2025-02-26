@extends('admin.layout.master')
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
                        <h4 class="mb-0">Leads</h4>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end add-list-btn">
                        <a href="{{route('create.lead')}}">
                            <button class="btn btn-primary" style="background-color: #5e0f2f;">
                                <img class="create_img" src="{{ url('assets/images/Lead.png') }}"> Add Lead
                            </button>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end action_bt">
                        <select class="form-control" id="change_status">
                            <option value="">Change Lead Status</option>
                            <option value="1">Open</option>
                            <option value="2">Assigned</option>
                            <option value="3">Accepted</option>
                            <option value="4">Listed</option>
                            <option value="5">Dead</option>
                            <option value="6">Old Lead</option>
                            <option value="7">Suspend</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4" id="list-search">
                        <form method="GET" action="{{ route('all.lead') }}">
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
                            <th scope="col">Category</th>
                            <th scope="col">Bus. Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Appt. Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="leadResults">
                        @forelse($leads as $key=>$lead)
                        <tr>
                            <td class="checkList">
                                <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                                    <input type="checkbox" name="lead_id[]" value="{{$lead->LeadID}}" class="custom-control-input listing-check">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </td>
                            <td>{{ $key + 1 + ($leads->currentPage() - 1) * $leads->perPage() }}</td>
                            <td>{{$lead->SellerFName}} {{$lead->SellerLName}}</td>
                            <td>{{ $categories[$lead->Category] ?? 'N/A' }}</td>
                            <td>{{$lead->BusName}}</td>
                            <td>{{$lead->Address}}</td>
                            <td>{{$lead->Phone}}</td>
                            <td>{{$lead->AppointmentDate}}</td>
                            <td>{{ $lead_status[$lead->Status] ?? 'N/A' }}</td>
                            <td class="list-btn">
                                @if(empty($lead->AgentID))
                                <button class="btn btn-sm" title="Assign" data-bs-toggle="modal" data-bs-target="#assignAgentModal" data-lead-id="{{$lead->LeadID}}" data-agent-id="{{ $lead->AgentID }}">
                                    <i class="fas fa-user-plus" style="color: #6c757d;"></i>
                                </button>
                                @endif

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
                                <!--  <button class="btn btn-sm" title="Download">
                                    <i class="fas fa-download"></i>
                                </button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center no-data-found">No lead found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="pagination" class="d-flex justify-content-end">
                    {{ $leads->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="assignAgentModal" tabindex="-1" aria-labelledby="assignAgentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignAgentModalLabel">Assign Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to select agent -->
                <form action="{{route('lead.assign')}}" method="POST" id="assign_lead_to_agent">
                    @csrf
                    <input type="hidden" name="lead_id" id="lead_id">
                    <div class="mb-3">
                        <label for="agent" class="form-label">Select Agent</label>
                        <select name="agent_id" id="agent" class="form-select">
                            <option value="">Select an agent</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->agent_info->AgentID }}">{{ $agent->agent_info->FName }} {{ $agent->agent_info->LName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" id="assignBtn" class="btn btn-primary" style="display: none;">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var agentDropdown = document.getElementById("agent");
        var assignButton = document.getElementById("assignBtn");

        // Initially hide the button if no agent is selected
        if (agentDropdown.value === "") {
            assignButton.style.display = "none";
        }

        // Show or hide the button based on the selected value in the dropdown
        agentDropdown.addEventListener("change", function() {
            if (agentDropdown.value === "") {
                assignButton.style.display = "none";
            } else {
                assignButton.style.display = "inline-block";
            }
        });
    });
    // JavaScript/jQuery to handle the lead ID dynamically
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            var leadId = this.getAttribute('data-lead-id');
            var currentAgentId = this.getAttribute('data-agent-id');
            document.getElementById('lead_id').value = leadId;
            var selectElement = document.getElementById('agent');
            if (currentAgentId) {
                selectElement.value = currentAgentId;
            } else {
                selectElement.value = '';
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#assign_lead_to_agent').validate({
            rules: {
                appointment: {
                    required: true
                }
            },
            messages: {

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
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
            var status_val = $(this).val();

            // Get the selected listing ids from checkboxes
            let selectedIds = $('.listing-check:checked').map(function() {
                return $(this).val();
            }).get();

            // Check if there are any selected listings
            if (selectedIds.length > 0) {
                $.ajax({
                    url: "{{ route('lead.bulkAction') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status_val: status_val,
                        lead_id: selectedIds
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