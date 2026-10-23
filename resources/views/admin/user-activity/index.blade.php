@extends('admin.layout.master')
@section('content')
    <style>
        .activity-page {
            --activity-maroon: #5e0f2f;
            --activity-maroon-dark: #45091f;
            --activity-border: #e5e7eb;
            --activity-muted: #778196;
            color: #202838;
        }

        .activity-page .page-card {
            background: #fff;
            border: 1px solid var(--activity-border);
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(24, 39, 75, .04);
        }

        .activity-page .page-title {
            border-left: 4px solid var(--activity-maroon);
            padding-left: 12px;
            font-size: 23px;
            font-weight: 700;
            margin: 0;
        }

        .activity-page .btn-maroon {
            background: var(--activity-maroon);
            border-color: var(--activity-maroon);
            color: #fff;
            border-radius: 7px;
            transition: .2s ease;
        }

        .activity-page .btn-maroon:hover {
            background: var(--activity-maroon-dark);
            border-color: var(--activity-maroon-dark);
            color: #fff;
        }

        .activity-page .stat-card {
            padding: 20px;
            height: 100%;
        }

        .activity-page .stat-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #f7edf1;
            color: var(--activity-maroon);
            font-size: 19px;
            flex-shrink: 0;
        }

        .activity-page .stat-label {
            font-size: 13px;
            color: var(--activity-muted);
        }

        .activity-page .stat-number {
            font-size: 25px;
            font-weight: 700;
            margin-top: 4px;
            line-height: 1.3;
        }

        .activity-page .form-control,
        .activity-page .form-select {
            border-color: #dfe3ea;
            border-radius: 7px;
            min-height: 41px;
            font-size: 13px;
            box-shadow: none;
        }

        .activity-page .form-control:focus,
        .activity-page .form-select:focus {
            border-color: var(--activity-maroon);
            box-shadow: 0 0 0 3px rgba(94, 15, 47, .08);
        }

        .activity-page .table {
            margin-bottom: 0;
        }

        .activity-page .table thead th {
            background: #f7f3f5;
            color: #374151;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .35px;
            white-space: nowrap;
            padding: 15px 14px;
            border-bottom: 1px solid var(--activity-border);
        }

        .activity-page .table tbody td {
            padding: 15px 14px;
            vertical-align: middle;
            border-color: #edf0f3;
            font-size: 13px;
        }

        .activity-page .table tbody tr:hover {
            background: #fcfafb;
        }

        .activity-page .activity-user {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 120px;
        }

        .activity-page .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #f2e5eb;
            color: var(--activity-maroon);
            font-weight: 700;
            font-size: 14px;
        }

        .activity-page .muted {
            color: var(--activity-muted);
            font-size: 12px;
        }

        .activity-page .activity-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: #edf0f5;
            color: #475467;
            white-space: nowrap;
        }

        .activity-page .badge-create {
            background: #e5f7ed;
            color: #16804a;
        }

        .activity-page .badge-update {
            background: #e8f1ff;
            color: #205ec5;
        }

        .activity-page .badge-delete {
            background: #fde9e9;
            color: #c62828;
        }

        .activity-page .badge-login {
            background: #eee9ff;
            color: #6941c6;
        }

        .activity-page .badge-status {
            background: #fff1d6;
            color: #956000;
        }

        .activity-page .details-text {
            min-width: 220px;
            max-width: 440px;
            line-height: 1.6;
            overflow-wrap: anywhere;
            color: #475467;
        }

        .activity-page .pagination {
            margin-bottom: 0;
            flex-wrap: wrap;
            gap: 3px;
        }

        .activity-page .page-link {
            color: var(--activity-maroon);
            border-radius: 6px;
            font-size: 13px;
        }

        .activity-page .active>.page-link {
            background: var(--activity-maroon);
            border-color: var(--activity-maroon);
            color: #fff;
        }

        .activity-page .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .activity-page .empty-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #f7edf1;
            color: var(--activity-maroon);
            font-size: 28px;
        }

        @media (max-width: 767px) {
            .activity-page .page-title {
                font-size: 20px;
            }

            .activity-page .stat-card {
                padding: 15px;
            }

            .activity-page .stat-number {
                font-size: 22px;
            }
        }
    </style>

    <div class="container-fluid activity-page py-3">

        {{-- Page heading --}}
        <div class="page-card p-3 p-md-4 mb-4">
            <div class="d-flex flex-wrap align-items-center
                    justify-content-between gap-3">

                <div>
                    <h4 class="page-title">User Activities</h4>

                    <p class="text-muted small mb-0 mt-2">
                        Track and review actions performed across your system.
                    </p>
                </div>

                <a href="{{ route('user.activities') }}" class="btn btn-maroon px-4 py-2">
                    <i class="fas fa-sync-alt me-2"></i>
                    Refresh
                </a>
            </div>
        </div>

        {{-- Summary cards --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="page-card stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-history"></i>
                        </div>

                        <div>
                            <div class="stat-label">Total Activities</div>
                            <div class="stat-number">
                                {{ number_format($totalActivities) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="page-card stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>

                        <div>
                            <div class="stat-label">Today's Activities</div>
                            <div class="stat-number">
                                {{ number_format($todayActivities) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="page-card stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <div>
                            <div class="stat-label">Users Active Today</div>
                            <div class="stat-number">
                                {{ number_format($activeUsersToday) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="page-card stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>

                        <div>
                            <div class="stat-label">Recorded Logins</div>
                            <div class="stat-number">
                                {{ number_format($loginActivities) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Search and filters --}}
        <div class="page-card p-3 p-md-4 mb-4">

            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="fas fa-filter text-secondary"></i>
                <h6 class="fw-bold mb-0">Search & Filters</h6>
            </div>

            <form method="GET" action="{{ route('user.activities') }}">

                <div class="row g-3 align-items-end">

                    <div class="col-12 col-lg-5">
                        <label class="form-label small fw-semibold">
                            Search Activity
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search text-secondary"></i>
                            </span>

                            <input type="text" name="search" class="form-control"
                                placeholder="Search action, details, user ID..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold">
                            Action Type
                        </label>

                        <select name="action" class="form-select">
                            <option value="">All Actions</option>

                            @foreach ($actions as $action)
                                <option value="{{ $action }}" @selected(request('action') === $action)>
                                    {{ $action }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-semibold">
                            From Date
                        </label>

                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>

                    <div class="col-6 col-lg-2">
                        <label class="form-label small fw-semibold">
                            To Date
                        </label>

                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>

                    <div class="col-12 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-maroon px-4">
                            <i class="fas fa-search me-1"></i>
                            Apply Filters
                        </button>

                        <a href="{{ route('user.activities') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-undo me-1"></i>
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        {{-- Activity history --}}
        <div class="page-card overflow-hidden">

            <div class="p-3 p-md-4 d-flex flex-wrap
                    justify-content-between align-items-center gap-3">

                <div>
                    <h5 class="fw-bold mb-1">Activity History</h5>

                    <div class="muted">
                        Showing {{ $activities->total() }} matching records
                    </div>
                </div>

                <span class="activity-badge">
                    <i class="fas fa-shield-alt me-1"></i>
                    Audit Log
                </span>
            </div>

            <div class="table-responsive">
                <table class="table">

                    <thead>
                        <tr>
                            <th style="min-width: 150px;">Activity ID</th>
                            <th style="min-width: 140px;">Action</th>
                            <th style="min-width: 110px;">User ID</th>
                            <th style="min-width: 250px;">Activity Details</th>
                            <th style="min-width: 155px;">Date & Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($activities as $activity)
                            @php
                                $actionName = strtolower((string) $activity->action);

                                $badgeClass = '';

                                if (str_contains($actionName, 'delete') || str_contains($actionName, 'remove')) {
                                    $badgeClass = 'badge-delete';
                                } elseif (str_contains($actionName, 'add') || str_contains($actionName, 'create')) {
                                    $badgeClass = 'badge-create';
                                } elseif (str_contains($actionName, 'update') || str_contains($actionName, 'edit')) {
                                    $badgeClass = 'badge-update';
                                } elseif (str_contains($actionName, 'login')) {
                                    $badgeClass = 'badge-login';
                                } elseif (str_contains($actionName, 'status')) {
                                    $badgeClass = 'badge-status';
                                }

                                $userLabel = $activity->user_id ? 'User #' . $activity->user_id : 'System / Guest';
                            @endphp

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar" style="width:34px;height:34px;">
                                            <i class="fas fa-history"></i>
                                        </div>

                                        <div>
                                            <div class="fw-semibold">
                                                #{{ $activity->id }}
                                            </div>

                                            <div class="muted">
                                                Activity record
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="activity-badge {{ $badgeClass }}">
                                        {{ $activity->action ?: 'Unknown' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $userLabel }}
                                    </span>
                                </td>

                                <td>
                                    <div class="details-text">
                                        {{ $activity->details ?: 'No details available' }}
                                    </div>
                                </td>

                                <td>
                                    @if ($activity->created_at)
                                        <div class="fw-semibold">
                                            {{ $activity->created_at->format('d M Y') }}
                                        </div>

                                        <div class="muted mt-1">
                                            <i class="far fa-clock me-1"></i>
                                            {{ $activity->created_at->format('h:i A') }}
                                        </div>
                                    @else
                                        <span class="muted">N/A</span>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>

                                        <h5 class="fw-bold">
                                            No activities found
                                        </h5>

                                        <p class="text-muted mb-3">
                                            No activity records match your search
                                            or selected filters.
                                        </p>

                                        @if (request()->hasAny(['search', 'action', 'date_from', 'date_to']))
                                            <a href="{{ route('user.activities') }}" class="btn btn-maroon px-4">
                                                Clear Filters
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            @if ($activities->hasPages())
                <div id="pagination" class="d-flex justify-content-end p-3">
                    {{ $activities->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            @endif

        </div>

    </div>
@endsection
