<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;

class NotificationController extends Controller
{
    protected $database;
    protected $reference;

    public function __construct()
    {
        // Set the path to your Firebase service account JSON file
        $serviceAccountPath = storage_path('app/firebase/exeb-443511-firebase-adminsdk-fbsvc-99ad7c8b12.json');

        // Initialize Firebase with the service account and database URI
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://exeb-443511-default-rtdb.firebaseio.com');

        // Create the database instance
        $this->database = $firebase->createDatabase();

        // Set the reference to 'notifications'
        $this->reference = $this->database->getReference('notifications');
    }
    public function markAllAsRead()
    {
        $userId = Auth::id();
        $notifications = $this->reference->orderByChild('user_id')->equalTo((string) $userId)->getValue();

        // Check if there are any notifications
        if ($notifications) {
            foreach ($notifications as $key => $notification) {
                // Update the 'is_read' field to true for each notification
                $this->reference->getChild($key)->update([
                    'is_read' => true
                ]);
            }
            return response()->json(['status' => 'success']);
        }

    }
}
