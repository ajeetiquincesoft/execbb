<div class="sidebar">
    <div class="sidebar-header">
        <h4>Buyer Dashboard</h4>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{route('buyer.dashboard')}}" class="{{ Route::currentRouteName() == 'buyer.dashboard' ? 'active' : '' }}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
        <!--  <li>
            <a href="#"><i class="fa fa-shopping-cart"></i> My Orders</a>
        </li> -->
        <li>
            <a href="{{route('buyer.save.search')}}" class="{{ Route::currentRouteName() == 'buyer.save.search' ? 'active' : '' }}"><i class="fa fa-search"></i> Save Searches</a>
        </li>
        <li>
            <a href="{{route('buyer.favorite.listings')}}" class="{{ Route::currentRouteName() == 'buyer.favorite.listings' ? 'active' : '' }}"><i class="fa fa-heart"></i> Favourites</a>
        </li>
        <li>
            <a href="{{route('buyer.all.message')}}" class="{{ Route::currentRouteName() == 'buyer.all.message' ? 'active' : '' }}"><i class="fa fa-comments"></i> Messages</a>
            <span class="custom-badge" id="unread-message-count" style="display: none;">0</span>
        </li>
        <li>
            <a href="{{route('buyer.profile')}}" class="{{ Route::currentRouteName() == 'buyer.profile' ? 'active' : '' }}"><i class="fa fa-user"></i> Profile</a>
        </li>
        <li>
            <a href="{{route('buyer.change.password')}}" class="{{ Route::currentRouteName() == 'buyer.change.password' ? 'active' : '' }}"><i class="fa fa-key"></i> Change Password</a>
        </li>
        <li>
            <a href="{{route('buyer.all.showing')}}" class="{{ Route::currentRouteName() == 'buyer.all.showing' ? 'active' : '' }}"><i class="fa fa-eye"></i> Showings</a>
        </li>
        <li>
            <a href="{{route('buyer.all.offer')}}" class="{{ Route::currentRouteName() == 'buyer.all.offer' ? 'active' : '' }}"><i class="fa fa-times-circle-o"></i> Offers</a>
        </li>
        @if(!empty($hasSignedNda))
        <li>
            <a href="{{route('download.buyer.nda.form')}}" class="{{ Route::currentRouteName() == 'download.buyer.nda.form' ? 'active' : '' }}"><i class="fa fa-download"></i> Download NDA Form</a>
        </li>
        @endif
        <!-- Collapsible Settings -->
        <!--  <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link collapsed showing-menu" data-toggle="collapse" data-target="#showings-collapse" aria-expanded="false">Showings <span class="caret ml-auto">&#9660;</span>
            </a>
            <div id="showings-collapse" class="collapse">
                <ul class="list-unstyled buyer-dash">
                    <li><a href="{{route('buyer.all.showing')}}"> - All Showing</a></li>
                </ul>
            </div>
        </li> -->
        <!-- Notification Item -->
        <li>
            <a href="javascript:void(0);" id="shareNotification">
                <i class="fa fa-bell"></i>
                Notifications
                <span class="custom-badge" id="notification-count">0</span>
            </a>
        </li>
        <li>
            <a href="{{ route('signout') }}" class="{{ Route::currentRouteName() == 'signout' ? 'active' : '' }}"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
    </ul>
</div>
<style>
    /* Ensure the caret is positioned to the right */
    .nav-link {
        display: flex;
        justify-content: space-between;
        /* Aligns text and caret */
        align-items: center;
    }

    .caret {
        margin-left: 10px;
        /* Add some space between text and caret */
        font-size: 14px;
        /* Adjust size if necessary */
    }

    .ml-auto {
        margin-left: auto;
        /* Moves the caret to the far right */
    }

    .custom-badge {
        display: inline-block;
        background-color: #555555;
        color: white;
        font-size: 12px;
        font-weight: bold;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        text-align: center;
        line-height: 20px;
        position: relative;
    }
</style>
<script>
    /*   $(document).ready(function() {
        // Handle the collapse and expand of settings
        $('#settings-collapse').on('show.bs.collapse', function() {
            // Change the caret to up (▲) when expanding
            $('.caret').html('&#9650;'); // Up caret (▲)
        }).on('hide.bs.collapse', function() {
            // Change the caret back to down (▼) when collapsing
            $('.caret').html('&#9660;'); // Down caret (▼)
        });
    }); */
</script>
@php
$userId = auth()->user()->id;
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script>
    // Initialize Firebase with your config
    const firebaseConfig = {
        apiKey: "AIzaSyBOFU1nHTH3K92l8WCwUiI8Pz3Ul709OhE",
        authDomain: "exeb-443511.firebaseapp.com",
        databaseURL: "https://exeb-443511-default-rtdb.firebaseio.com",
        projectId: "exeb-443511",
        storageBucket: "exeb-443511.firebasestorage.app",
        messagingSenderId: "953545808773",
        appId: "1:953545808773:web:d2ca948fe32004f822c2ec",
        measurementId: "G-16W56RL5G9"
    };

    // Initialize Firebase
    const app = firebase.initializeApp(firebaseConfig);
    const database = firebase.database(app);

    // Pass the user ID from Laravel to JS
    const userId = '{{ $userId }}'; // This makes the userId available in JS
    const userIdNumber = Number(userId);
    // The notification count badge
    const notificationCountBadge = document.getElementById('notification-count');

    // Function to fetch the initial count of unread notifications
    function fetchInitialUnreadCount(userIdNumber) {
        // Use .once('value') to fetch data once, avoid using .on('child_added') for this.
        database.ref('notifications')
            .orderByChild('receiver_id')
            .equalTo(userIdNumber)
            .once('value', (snapshot) => {
                let unreadCount = 0;

                // Check if the snapshot is empty
                if (snapshot.exists()) {
                    snapshot.forEach((childSnapshot) => {
                        const notification = childSnapshot.val();

                        // Ensure the 'is_read' field exists and is boolean
                        if (notification.is_read === false) {
                            unreadCount++;
                        }
                    });
                } else {
                    //console.log("No notifications found for this user.");
                }

                // Log and update the notification count
                //console.log('Unread count:', unreadCount); // This will log the correct unread count
                notificationCountBadge.textContent = unreadCount;
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }
    document.getElementById('shareNotification').addEventListener('click', function() {
        database.ref('notifications')
            .orderByChild('receiver_id')
            .equalTo(userIdNumber)
            .once('value', (snapshot) => {
                // Check if the snapshot is empty
                if (snapshot.exists()) {
                    snapshot.forEach((childSnapshot) => {
                        const notification = childSnapshot.val();

                        // Ensure the 'is_read' field exists and is boolean
                        if (notification.is_read === false) {
                            markNotificationAsRead(childSnapshot.key);
                        }
                    });
                } else {
                    console.log("No notifications found for this user.");
                }
                notificationCountBadge.textContent = '0';
                window.location.href = "{{ url('buyer/share-factsheet-notification') }}";
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });

    });
    // Function to mark a notification as read in Firebase
    function markNotificationAsRead(notificationId) {
        // Reference to the specific notification in the Firebase database
        const notificationRef = database.ref('notifications/' + notificationId);

        // Update the 'is_read' field to true
        notificationRef.update({
            is_read: true
        }).then(() => {
            console.log("Notification marked as read:", notificationId);
        }).catch((error) => {
            console.error("Error marking notification as read:", error);
        });
    }

    // Listen for new unread notifications in Firebase
    database.ref('notifications').orderByChild('receiver_id').equalTo(userIdNumber).on('child_added', (snapshot) => {
        const newNotification = snapshot.val();
        if (newNotification.is_read === false) {
            // Dynamically update the UI with the new notification
            updateNotificationInUI();
        }
    });

    // Function to update the notification UI in real-time
    function updateNotificationInUI() {
        const notificationCount = parseInt(notificationCountBadge.textContent) || 0;
        // Increment the unread notification count by 1
        notificationCountBadge.textContent = notificationCount + 1;
    }

    // Fetch initial unread notifications count when the page loads
    fetchInitialUnreadCount(userIdNumber);
</script>