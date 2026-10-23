<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginActivity;
use App\Models\Activity;

class LoginActivityController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all login activities
        /*  $loginActivities = LoginActivity::with('user')->latest()->paginate(10); */
        $search_query = $request->input('query');
        $loginActivities = LoginActivity::query();
        if ($search_query) {

            $loginActivities = LoginActivity::with('user')  // Eager load the user relationship
                ->whereHas('user', function ($query) use ($search_query) {
                    $query->where('name', 'like', '%' . $search_query . '%')
                        ->orWhere('logged_in_at', 'like', '%' . $search_query . '%');
                });
        }

        $loginActivities = $loginActivities->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.login_activities.index', compact('loginActivities'));
    }

    public function userActivities(Request $request)
    {
        $query = Activity::query()->latest();

        // Search by action, details, or user ID
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('details', 'like', "%{$search}%")
                    ->orWhere('user_id', 'like', "%{$search}%");
            });
        }

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->paginate(15);
        $activities->appends(request()->query());

        // Summary statistics
        $totalActivities = Activity::count();

        $todayActivities = Activity::whereDate(
            'created_at',
            today()
        )->count();

        $activeUsersToday = Activity::whereDate(
            'created_at',
            today()
        )->whereNotNull('user_id')
            ->distinct()
            ->count('user_id');

        $loginActivities = Activity::where(
            'action',
            'like',
            '%login%'
        )->count();

        // Available action filters
        $actions = Activity::query()
            ->whereNotNull('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('admin.user-activity.index', compact(
            'activities',
            'totalActivities',
            'todayActivities',
            'activeUsersToday',
            'loginActivities',
            'actions'
        ));
    }
}
