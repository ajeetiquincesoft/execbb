<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;

class ShareFactSheetNotificationController extends Controller
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
    public function index(){
        $userId = Auth::id();
        $notifications = $this->reference->orderByChild('receiver_id')->equalTo($userId)->getValue();
       
        return view('frontend.buyer.buyer_notifications',compact('notifications'));
    }
   
}
