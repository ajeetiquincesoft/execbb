@extends('admin.layout.master')

@section('content')

    <div class="container-fluid content bg-light">

        {{-- Success Message --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif

        {{-- Error Message --}}
        @if (Session::has('error'))
            <div class="alert alert-danger alert-block" id="alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('error') }}</strong>
            </div>
        @endif


        <div class="row card">

            {{-- =========================
                HEADER
            ========================== --}}
            <div class="list-header">

                <div class="container-fluid py-3 border-bottom">

                    <div class="row align-items-center">

                        {{-- Title --}}
                        <div class="col-12 col-md-6 col-lg-2">
                            <h4 class="mb-0">Leads</h4>
                        </div>


                        {{-- Add Lead --}}
                        <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-end add-list-btn">

                            <a href="{{ route('create.lead') }}">

                                <button class="btn btn-primary" style="background-color: #5e0f2f; border-color:#5e0f2f;">

                                    <img class="create_img" src="{{ url('assets/images/Lead.png') }}">

                                    Add Lead

                                </button>

                            </a>

                        </div>


                        {{-- Change Status --}}
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


                        {{-- Search --}}
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4" id="list-search">

                            <form method="GET" action="{{ route('all.lead') }}">

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


            {{-- =========================
                LEAD DATA
            ========================== --}}
            <div class="list-data">

                @php
                    $currentSort = request('sort');
                    $currentDirection = request('direction');
                @endphp


                {{-- Sort Icon Helper --}}
                @php
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

                                {{-- Checkbox --}}
                                <th scope="col" class="checkList">

                                    <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">

                                        <input type="checkbox" name="checkListing" value=""
                                            class="custom-control-input" id="checkAll">

                                        <span class="custom-control-label">&nbsp;</span>

                                    </label>

                                </th>


                                {{-- Lead ID --}}
                                <th scope="col" class="sortable">

                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'LeadID',
                                            'direction' => sortDirection('LeadID', $currentSort, $currentDirection),
                                        ]) }}">

                                        #
                                        {!! sortIcon('LeadID', $currentSort, $currentDirection) !!}

                                    </a>

                                </th>


                                {{-- Name --}}
                                <th scope="col" class="sortable">

                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'SellerFName',
                                            'direction' => sortDirection('SellerFName', $currentSort, $currentDirection),
                                        ]) }}">

                                        Name
                                        {!! sortIcon('SellerFName', $currentSort, $currentDirection) !!}

                                    </a>

                                </th>


                                <th scope="col">
                                    Category
                                </th>


                                <th scope="col">
                                    Bus. Name
                                </th>


                                <th scope="col">
                                    Agent Assigned
                                </th>


                                <th scope="col">
                                    Address
                                </th>


                                <th scope="col">
                                    Phone
                                </th>


                                {{-- Appointment --}}
                                <th scope="col" class="sortable">

                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'AppointmentDate',
                                            'direction' => sortDirection('AppointmentDate', $currentSort, $currentDirection),
                                        ]) }}">

                                        Appt. Date
                                        {!! sortIcon('AppointmentDate', $currentSort, $currentDirection) !!}

                                    </a>

                                </th>


                                <th scope="col">
                                    Status
                                </th>


                                <th scope="col">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody id="leadResults">

                            @forelse($leads as $key => $lead)
                                <tr>

                                    {{-- Checkbox --}}
                                    <td class="checkList">

                                        <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">

                                            <input type="checkbox" name="lead_id[]" value="{{ $lead->LeadID }}"
                                                class="custom-control-input listing-check">

                                            <span class="custom-control-label">&nbsp;</span>

                                        </label>

                                    </td>


                                    {{-- Lead ID --}}
                                    <td>
                                        {{ $lead->LeadID }}
                                    </td>


                                    {{-- Seller Name --}}
                                    <td>
                                        {{ $lead->SellerFName }}
                                        {{ $lead->SellerLName }}
                                    </td>


                                    {{-- Category --}}
                                    <td>
                                        {{ $categories[$lead->Category] ?? 'N/A' }}
                                    </td>


                                    {{-- Business Name --}}
                                    <td>
                                        {{ $lead->BusName }}
                                    </td>


                                    {{-- =========================
                                        AGENT ASSIGNED
                                    ========================== --}}
                                    <td>

                                        @if (empty($lead->lead_agent_id))
                                            <span class="text-muted">
                                                Unassigned
                                            </span>
                                        @else
                                            @php
                                                $agentName = trim(
                                                    ($lead->agent_fname ?? '') . ' ' . ($lead->agent_lname ?? ''),
                                                );
                                            @endphp

                                            {{ $agentName ?: 'Agent #' . $lead->lead_agent_id }}
                                        @endif

                                    </td>


                                    {{-- Address --}}
                                    <td>
                                        {{ $lead->Address }}
                                    </td>


                                    {{-- Phone --}}
                                    <td>
                                        {{ $lead->Phone }}
                                    </td>


                                    {{-- Appointment Date --}}
                                    <td>

                                        @if (!empty($lead->AppointmentDate))
                                            {{ \Carbon\Carbon::parse($lead->AppointmentDate)->format('m/d/Y') }}
                                        @else
                                            -
                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td>
                                        {{ $lead_status[$lead->Status] ?? 'N/A' }}
                                    </td>


                                    {{-- =========================
                                        ACTIONS
                                    ========================== --}}
                                    <td class="list-btn">


                                        {{-- Assign Agent Button --}}
                                        @if (is_null($lead->lead_agent_id) ||
                                                $lead->lead_agent_id == 0 ||
                                                trim((string) $lead->lead_agent_id) === '' ||
                                                strtoupper(trim((string) $lead->lead_agent_id)) === 'NULL')
                                            <button type="button" class="btn btn-sm assign-agent-trigger"
                                                title="Assign Agent" data-bs-toggle="modal"
                                                data-bs-target="#assignAgentModal" data-lead-id="{{ $lead->LeadID }}"
                                                data-agent-id="">

                                                <i class="fas fa-user-plus" style="color:#6c757d;">
                                                </i>

                                            </button>
                                        @endif


                                        {{-- View --}}
                                        <a href="{{ route('show.lead', $lead->LeadID) }}">

                                            <button type="button" class="btn btn-sm" title="View">

                                                <i class="fas fa-eye"></i>

                                            </button>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('edit.lead', $lead->LeadID) }}">

                                            <button type="button" class="btn btn-sm" title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </button>

                                        </a>
                                        <a href="{{ route('lead.print', $lead->LeadID) }}" target="_blank"
                                            rel="noopener" class="btn btn-sm lead-print-btn" title="Print Lead"
                                            aria-label="Print Lead">
                                            <i class="fas fa-print"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form id="delete-form-{{ $lead->LeadID }}"
                                            action="{{ route('lead.destroy', $lead->LeadID) }}" method="post"
                                            style="display:inline-block;">

                                            @csrf

                                            @method('DELETE')

                                            <button type="button" class="btn btn-sm" title="Delete"
                                                onclick="leadDelete('{{ $lead->LeadID }}')">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="12" class="text-center no-data-found">

                                        No lead found.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>


                    {{-- Pagination --}}
                    <div id="pagination" class="d-flex justify-content-end">

                        {{ $leads->appends(request()->query())->links('vendor.pagination.custom') }}

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
        ASSIGN AGENT MODAL
    ====================================================== --}}
    <div class="modal fade" id="assignAgentModal" tabindex="-1" aria-labelledby="assignAgentModalLabel"
        aria-hidden="true" data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content assign-agent-modal">


                {{-- =========================
                    MODAL HEADER
                ========================== --}}
                <div class="modal-header assign-agent-header">

                    <div class="d-flex align-items-center">

                        <div class="assign-agent-icon">

                            <i class="fas fa-user-tie"></i>

                        </div>


                        <div class="ms-3">

                            <h5 class="modal-title mb-1" id="assignAgentModalLabel">

                                Assign Agent

                            </h5>

                            <small>
                                Assign this lead to an agent
                            </small>

                        </div>

                    </div>


                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>

                </div>



                {{-- =========================
                    MODAL BODY
                ========================== --}}
                <div class="modal-body assign-agent-body">


                    <form action="{{ route('lead.assign') }}" method="POST" id="assign_lead_to_agent">

                        @csrf


                        {{-- Lead ID --}}
                        <input type="hidden" name="lead_id" id="lead_id">


                        {{-- =========================
                            LEAD INFORMATION
                        ========================== --}}
                        <div class="lead-info-box mb-4">

                            <div class="lead-info-icon">

                                <i class="fas fa-clipboard-list"></i>

                            </div>


                            <div>

                                <span class="lead-info-label">
                                    Lead ID
                                </span>

                                <div class="lead-info-value" id="display_lead_id">

                                    -

                                </div>

                            </div>

                        </div>



                        {{-- =========================
                            AGENT SELECT
                        ========================== --}}
                        <div class="mb-3">

                            <label for="agent" class="form-label agent-label">

                                <i class="fas fa-user-check me-2"></i>

                                Select Agent

                            </label>


                            <div class="agent-select-wrapper">

                                <i class="fas fa-user agent-select-icon"></i>


                                <select name="agent_id" id="agent" class="form-select agent-select">

                                    <option value="">
                                        Select an agent
                                    </option>


                                    @foreach ($agents as $agent)
                                        @php

                                            $firstName = trim($agent->agent_info->FName ?? '');

                                            $lastName = trim($agent->agent_info->LName ?? '');

                                            $fullName = trim($firstName . ' ' . $lastName);

                                            $agentId = $agent->agent_info->AgentID ?? null;

                                        @endphp


                                        @if ($agentId)
                                            <option value="{{ $agentId }}">

                                                {{ $fullName ?: 'Agent #' . $agentId }}

                                            </option>
                                        @endif
                                    @endforeach

                                </select>

                            </div>


                            <div class="form-text mt-2">

                                <i class="fas fa-info-circle me-1"></i>

                                Choose the agent responsible for this lead.

                            </div>

                        </div>



                        {{-- =========================
                            SELECTED AGENT PREVIEW
                        ========================== --}}
                        <div id="selectedAgentBox" class="selected-agent-box" style="display:none;">

                            <div class="selected-agent-avatar">

                                <i class="fas fa-user"></i>

                            </div>


                            <div class="selected-agent-details">

                                <small>
                                    Selected Agent
                                </small>

                                <strong id="selectedAgentName">
                                    -
                                </strong>

                            </div>


                            <i class="fas fa-check-circle selected-agent-check"></i>

                        </div>



                        {{-- =========================
                            ACTION BUTTONS
                        ========================== --}}
                        <div class="modal-action-buttons mt-4">


                            <button type="button" class="btn btn-light cancel-agent-btn" data-bs-dismiss="modal">

                                <i class="fas fa-times me-2"></i>

                                Cancel

                            </button>


                            <button type="submit" id="assignBtn" class="btn assign-agent-btn" disabled>

                                <i class="fas fa-user-plus me-2"></i>

                                Assign Agent

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
        CSS
    ====================================================== --}}
    <style>
        /* =========================================
                                                       SORTABLE
                                                    ========================================= */

        .sortable a {
            color: inherit;
            text-decoration: none;
        }

        .sortable a:hover {
            color: inherit;
            text-decoration: none;
        }


        /* =========================================
                                                       ASSIGN AGENT MODAL
                                                    ========================================= */

        .assign-agent-modal {

            border: none;

            border-radius: 16px;

            overflow: hidden;

            box-shadow:
                0 15px 50px rgba(0, 0, 0, 0.20);

        }


        /* =========================================
                                                       HEADER
                                                    ========================================= */

        .assign-agent-header {

            background:
                linear-gradient(135deg,
                    #741038,
                    #8d1646);

            color: #fff;

            border: none;

            padding: 20px 24px;

        }


        .assign-agent-header .modal-title {

            font-size: 20px;

            font-weight: 600;

        }


        .assign-agent-header small {

            color:
                rgba(255, 255, 255, 0.78);

            font-size: 13px;

        }


        /* Header Icon */

        .assign-agent-icon {

            width: 46px;

            height: 46px;

            border-radius: 12px;

            background:
                rgba(255, 255, 255, 0.15);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            color: #fff;

        }


        /* =========================================
                                                       BODY
                                                    ========================================= */

        .assign-agent-body {

            padding: 26px;

            background: #fff;

        }


        /* =========================================
                                                       LEAD INFO
                                                    ========================================= */

        .lead-info-box {

            display: flex;

            align-items: center;

            background: #f8f9fb;

            border: 1px solid #e9ecef;

            border-radius: 12px;

            padding: 14px 16px;

        }


        .lead-info-icon {

            width: 40px;

            height: 40px;

            border-radius: 10px;

            background: #f1e7ec;

            color: #741038;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 12px;

        }


        .lead-info-label {

            display: block;

            font-size: 11px;

            color: #8a8f98;

            text-transform: uppercase;

            letter-spacing: .5px;

        }


        .lead-info-value {

            margin-top: 2px;

            font-size: 15px;

            font-weight: 600;

            color: #343a40;

        }


        /* =========================================
                                                       AGENT LABEL
                                                    ========================================= */

        .agent-label {

            font-size: 14px;

            font-weight: 600;

            color: #343a40;

        }


        /* =========================================
                                                       AGENT SELECT
                                                    ========================================= */

        .agent-select-wrapper {

            position: relative;

        }


        .agent-select {

            height: 48px;

            border-radius: 10px;

            border: 1px solid #dfe3e8;

            padding-left: 42px;

            font-size: 14px;

            background-color: #fff;

            transition: all .2s ease;

        }


        .agent-select:focus {

            border-color: #741038;

            box-shadow:
                0 0 0 3px rgba(116, 16, 56, .10);

        }


        .agent-select-icon {

            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #8b929a;

            z-index: 2;

            pointer-events: none;

        }


        /* =========================================
                                                       HELP TEXT
                                                    ========================================= */

        .form-text {

            color: #8a8f98;

            font-size: 12px;

        }


        /* =========================================
                                                       SELECTED AGENT
                                                    ========================================= */

        .selected-agent-box {

            display: flex;

            align-items: center;

            padding: 13px 15px;

            border-radius: 12px;

            background: #f4faf6;

            border: 1px solid #cce8d5;

        }


        .selected-agent-avatar {

            width: 40px;

            height: 40px;

            border-radius: 50%;

            background: #198754;

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 12px;

        }


        .selected-agent-details {

            flex: 1;

        }


        .selected-agent-details small {

            display: block;

            color: #6c757d;

            font-size: 11px;

        }


        .selected-agent-details strong {

            display: block;

            color: #212529;

            font-size: 14px;

            margin-top: 2px;

        }


        .selected-agent-check {

            color: #198754;

            font-size: 18px;

        }


        /* =========================================
                                                       BUTTONS
                                                    ========================================= */

        .modal-action-buttons {

            display: flex;

            justify-content: flex-end;

            gap: 10px;

            padding-top: 20px;

            border-top: 1px solid #eeeeee;

        }


        .cancel-agent-btn {

            height: 44px;

            padding: 0 18px;

            border: 1px solid #dee2e6;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 500;

        }


        .cancel-agent-btn:hover {

            background: #f5f5f5;

        }


        .assign-agent-btn {

            height: 44px;

            padding: 0 20px;

            border: none;

            border-radius: 9px;

            background: #741038;

            color: #fff;

            font-size: 14px;

            font-weight: 600;

            transition: all .2s ease;

        }


        .assign-agent-btn:hover:not(:disabled) {

            background: #93744B;
            color: #fff;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(116, 16, 56, .20);

        }


        .assign-agent-btn:disabled {

            background: #d6d9dd;

            color: #8b9198;

            cursor: not-allowed;

        }


        /* =========================================
                                                       ASSIGN ICON
                                                    ========================================= */

        .assign-agent-trigger {

            border: none;

            background: transparent;

            padding: 4px 7px;

        }


        .assign-agent-trigger:hover {

            background: #f1f1f1;

            border-radius: 6px;

        }


        /* =========================================
                                                       MOBILE
                                                    ========================================= */

        @media (max-width: 576px) {

            .assign-agent-body {

                padding: 20px;

            }


            .assign-agent-header {

                padding: 17px 20px;

            }


            .modal-action-buttons {

                flex-direction: column-reverse;

            }


            .cancel-agent-btn,
            .assign-agent-btn {

                width: 100%;

            }

        }
    </style>



    {{-- =====================================================
        JAVASCRIPT - ASSIGN AGENT MODAL
    ====================================================== --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const agentDropdown =
                document.getElementById("agent");

            const assignButton =
                document.getElementById("assignBtn");

            const leadIdInput =
                document.getElementById("lead_id");

            const displayLeadId =
                document.getElementById("display_lead_id");

            const selectedAgentBox =
                document.getElementById("selectedAgentBox");

            const selectedAgentName =
                document.getElementById("selectedAgentName");


            /*
            |--------------------------------------------------------------------------
            | Reset Modal
            |--------------------------------------------------------------------------
            */

            function resetAssignModal() {

                leadIdInput.value = "";

                displayLeadId.textContent = "-";

                agentDropdown.value = "";

                assignButton.disabled = true;

                selectedAgentBox.style.display = "none";

                selectedAgentName.textContent = "-";

            }


            /*
            |--------------------------------------------------------------------------
            | Open Assign Agent Modal
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(".assign-agent-trigger")
                .forEach(function(button) {

                    button.addEventListener("click", function() {

                        const leadId =
                            this.getAttribute("data-lead-id");

                        const currentAgentId =
                            this.getAttribute("data-agent-id");


                        /*
                        |--------------------------------------------------------------------------
                        | Set Lead ID
                        |--------------------------------------------------------------------------
                        */

                        leadIdInput.value = leadId;

                        displayLeadId.textContent =
                            "#" + leadId;


                        /*
                        |--------------------------------------------------------------------------
                        | Reset Agent Selection
                        |--------------------------------------------------------------------------
                        */

                        agentDropdown.value = "";

                        assignButton.disabled = true;

                        selectedAgentBox.style.display = "none";

                        selectedAgentName.textContent = "-";


                        /*
                        |--------------------------------------------------------------------------
                        | If an existing agent exists
                        |--------------------------------------------------------------------------
                        */

                        if (
                            currentAgentId &&
                            currentAgentId !== "0" &&
                            currentAgentId.toUpperCase() !== "NULL"
                        ) {

                            agentDropdown.value =
                                currentAgentId;


                            if (agentDropdown.value !== "") {

                                assignButton.disabled = false;

                                const selectedOption =
                                    agentDropdown.options[
                                        agentDropdown.selectedIndex
                                    ];


                                selectedAgentName.textContent =
                                    selectedOption.text.trim();


                                selectedAgentBox.style.display =
                                    "flex";

                            }

                        }

                    });

                });


            /*
            |--------------------------------------------------------------------------
            | Agent Selection
            |--------------------------------------------------------------------------
            */

            agentDropdown.addEventListener("change", function() {

                if (this.value !== "") {

                    assignButton.disabled = false;


                    const selectedOption =
                        this.options[
                            this.selectedIndex
                        ];


                    selectedAgentName.textContent =
                        selectedOption.text.trim();


                    selectedAgentBox.style.display =
                        "flex";

                } else {

                    assignButton.disabled = true;

                    selectedAgentBox.style.display =
                        "none";

                    selectedAgentName.textContent =
                        "-";

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Form Submit Validation
            |--------------------------------------------------------------------------
            */

            document
                .getElementById("assign_lead_to_agent")
                .addEventListener("submit", function(event) {

                    if (
                        !agentDropdown.value ||
                        agentDropdown.value === ""
                    ) {

                        event.preventDefault();

                        agentDropdown.focus();

                        return false;

                    }

                });


            /*
            |--------------------------------------------------------------------------
            | Reset modal after close
            |--------------------------------------------------------------------------
            */

            const assignModal =
                document.getElementById("assignAgentModal");


            if (assignModal) {

                assignModal.addEventListener(
                    "hidden.bs.modal",
                    function() {

                        resetAssignModal();

                    }
                );

            }

        });
    </script>



    {{-- =====================================================
        JQUERY
    ====================================================== --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script>
        $(document).ready(function() {


            /*
            |--------------------------------------------------------------------------
            | jQuery Validate
            |--------------------------------------------------------------------------
            */

            if ($.fn.validate) {

                $('#assign_lead_to_agent').validate({

                    rules: {

                        agent_id: {

                            required: true

                        }

                    },

                    messages: {

                        agent_id: {

                            required: "Please select an agent."

                        }

                    },

                    submitHandler: function(form) {

                        form.submit();

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | AJAX CSRF
            |--------------------------------------------------------------------------
            */

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Check All
            |--------------------------------------------------------------------------
            */

            $('#checkAll').on('change', function() {

                $('.listing-check')
                    .prop('checked', this.checked);

            });


            /*
            |--------------------------------------------------------------------------
            | Individual Checkbox
            |--------------------------------------------------------------------------
            */

            $('.listing-check').on('change', function() {

                if (
                    $('.listing-check:checked').length ===
                    $('.listing-check').length
                ) {

                    $('#checkAll').prop('checked', true);

                } else {

                    $('#checkAll').prop('checked', false);

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Bulk Status Change
            |--------------------------------------------------------------------------
            */

            $('#change_status').change(function() {

                let status_val =
                    $(this).val();


                let selectedIds =
                    $('.listing-check:checked')
                    .map(function() {

                        return $(this).val();

                    })
                    .get();


                /*
                |--------------------------------------------------------------------------
                | No Lead Selected
                |--------------------------------------------------------------------------
                */

                if (selectedIds.length === 0) {

                    Swal.fire({

                        title: 'Warning!',

                        text: 'Please select at least one listing.',

                        icon: 'warning',

                        confirmButtonText: 'OK',

                        confirmButtonColor: '#5e0f2f'

                    }).then(() => {

                        location.reload();

                    });

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Update Status
                |--------------------------------------------------------------------------
                */

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

                            confirmButtonColor: '#5e0f2f'

                        }).then(() => {

                            location.reload();

                        });

                    },


                    error: function(
                        xhr,
                        status,
                        error
                    ) {

                        if (xhr.status === 419) {

                            alert(
                                'CSRF token mismatch. Please reload the page and try again.'
                            );

                        } else {

                            alert(
                                'An error occurred while processing your request.'
                            );

                        }

                    }

                });

            });

        });
    </script>


@endsection
