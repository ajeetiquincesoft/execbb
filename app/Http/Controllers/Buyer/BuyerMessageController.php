<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use App\Models\Agent;

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
        $agents = Agent::all();
        return view('frontend.buyer.buyer_message',compact('agents'));
    }

    public function sendMessage(Request $request)
    {
        $messageData = [
            'sender' => $request->sender,
            'receiver' => $request->receiver,
            'message' => $request->message,
            'timestamp' => now()->timestamp,
            'read' =>false,
        ];
        $this->reference->push($messageData);
        return response()->json(['success' => true]);
    }

    public function getMessages()
    {
        $messages = $this->database->getReference('messages')->getValue();
        return response()->json($messages);
    }
}
