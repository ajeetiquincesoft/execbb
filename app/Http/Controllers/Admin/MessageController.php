<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\Agent;
use App\Models\User;
use App\Models\Buyer;

class MessageController extends Controller
{
    protected $database;
    protected $reference;

    public function __construct()
    {
        $serviceAccountPath = storage_path('app/firebase/exeb-443511-firebase-adminsdk-fbsvc-99ad7c8b12.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://exeb-443511-default-rtdb.firebaseio.com');
        $this->database = $firebase->createDatabase();
        $this->reference = $this->database->getReference('messages');
    }
    public function index()
    {
        $currentUserId = auth()->id();
        $allMessages = $this->reference->getValue();
        $chatUserIds = [];
        $agents = [];
        $buyers = [];
        if (is_array($allMessages) || is_object($allMessages)) {
            foreach ($allMessages as $chatKey => $messages) {
                $userIds = explode('_', $chatKey);
                if (in_array($currentUserId, $userIds)) {
                    $otherUserId = $userIds[0] == $currentUserId ? $userIds[1] : $userIds[0];
                    $chatUserIds[] = $otherUserId;
                }
            }
            $chatUserIds = array_unique($chatUserIds);
        }
        // Fetch agents and buyers separately
        $agents = User::whereIn('id', $chatUserIds)->where('role_name', 'agent')->get(['id', 'name', 'email']);
        $buyers = User::whereIn('id', $chatUserIds)->where('role_name', 'buyer')->get(['id', 'name', 'email']);

        /* $agents = User::where('role_name', 'agent')->orderBy('created_at', 'asc')->get(); */
        $admins = User::where('role_name', 'admin')->get();
        /* $buyers = User::where('role_name', 'buyer')->orderBy('created_at', 'asc')->get(); */
        return view('admin.message.message-by-admin', compact('agents', 'admins', 'buyers'));
    }
    /*  public function getUsers(Request $request, $role)
    {
        $perPage = $request->input('perPage', 20);
        $page = $request->input('page', 1);
        $search = $request->input('search');
        if ($role === 'agent') {
            $query = User::where('role_name', 'agent');
        } else {
            $query = User::where('role_name', 'buyer');
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($users);
    } */
    public function getUsers(Request $request, $role)
    {
        $query = User::where('role_name', $role);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $perPage = $request->input('perPage', 10);
        $offset = $request->input('offset', 0);

        $users = $query->skip($offset)->take($perPage)->get();

        return response()->json(['data' => $users]);
    }
    public function getActiveUsers($role)
    {
        $currentUserId = auth()->id();
        $allMessages = $this->reference->getValue();
        $chatUserIds = [];

        if (is_array($allMessages) || is_object($allMessages)) {
            foreach ($allMessages as $chatKey => $messages) {
                $userIds = explode('_', $chatKey);
                if (in_array($currentUserId, $userIds)) {
                    $otherUserId = $userIds[0] == $currentUserId ? $userIds[1] : $userIds[0];
                    $chatUserIds[] = $otherUserId;
                }
            }
            $chatUserIds = array_unique($chatUserIds);
        }

        $users = User::whereIn('id', $chatUserIds)
            ->where('role_name', $role)
            ->get(['id', 'name', 'email']);

        return response()->json(['data' => $users]);
    }
}
