<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use App\Models\Agent;
use App\Models\User;

class BuyerMessageController extends Controller
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
        $admins = [];
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
        $admins = User::whereIn('id', $chatUserIds)->where('role_name', 'admin')->get(['id', 'name', 'email']);
        $agents = User::whereIn('id', $chatUserIds)->where('role_name', 'agent')->get(['id', 'name', 'email']);
        return view('frontend.buyer.buyer_message', compact('agents', 'admins'));
    }

    public function sendMessage(Request $request)
    {
        $messageData = [
            'sender' => $request->sender,
            'receiver' => $request->receiver,
            'message' => $request->message,
            'timestamp' => now()->timestamp,
            'read' => false,
        ];
        $this->reference->push($messageData);
        return response()->json(['success' => true]);
    }

    public function getMessages()
    {
        $messages = $this->database->getReference('messages')->getValue();
        return response()->json($messages);
    }
    public function ajaxBuyer(Request $request, $role)
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
