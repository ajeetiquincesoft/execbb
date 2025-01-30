<nav class="navbar navbar-expand-lg navbar-light navstickey ">
  <div class="container-fluid">
    <div class="d-flex justify-content-between w-100">
      <div class="d-flex align-items-center">
        @php
        $route = Route::currentRouteName();
        $id = request()->route('id');
        @endphp
        <button id="sidebarToggle" class="btn">☰</button>
        <ol class="my_menu breadcrumb breadcrumb-list m-0 ms-2">
          <li class="breadcrumb-item"><a class="nav-link" href="{{route('agent.dashboard')}}">Home</a></li>
          @php
          // Define route names and their corresponding breadcrumb labels
          $breadcrumbs = [
          'agent.dashboard' => 'Dashboard',
          'agent.all.listing' => 'Listing',
          'agent.listing.form' => 'Listing',
          'agent.list.buyer' => 'Buyer',
          'agent.show.buyer' => 'View Buyer',
          'agent.show.listing' => 'View Listing',
          'agent.edit.listing.form' => 'Edit Listing',
          'agent.reset.password' => 'Change Password',
          'agent.login.activities' => 'Login Activities',
          'agent.email.buyer' => 'Email Buyer',
          'agent.reports' => 'Reports',
          ];
          @endphp

          @foreach ($breadcrumbs as $key => $label)
          @if ($route == $key)
          @if ($route == 'agent.email.buyer' || $route == 'agent.reports')
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
          </li>
          @elseif (in_array($route, ['agent.reset.password', 'agent.login.activities']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route) }}">{{ $breadcrumbs[$route] }}</a>
          </li>
          @elseif (in_array($route, ['agent.show.buyer']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('agent.list.buyer') }}">Buyer</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @elseif (in_array($route, ['agent.show.listing', 'agent.edit.listing.form']))
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route('agent.all.listing') }}">Listing</a>
          </li>
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($route,$id)}}">{{ $label }}</a>
          </li>
          @else
          <li class="breadcrumb-item">
            <a class="nav-link" href="{{ route($key) }}">{{ $label }}</a>
          </li>
          @endif
          @endif
          @endforeach
        </ol>
      </div>
      <div class="header-right profile-dropdown d-flex align-items-center">
        <div class="dropdown me-3">
          <button class="btn dropdown-toggle notification-icon" type="button" id="notificationMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i> <!-- Notification bell icon -->
            <span class="badge bg-danger" id="notification-count">0</span> <!-- Badge for unread notifications -->
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationMenuButton" id="notification-container">
           
          </ul>
        </div>
        <div class="dropdown">
          <button class="btn dropdown-toggle contact-available profile" type="button" id="dropdownMenuButton"
            data-bs-toggle="dropdown" aria-expanded="false">
            @if(auth()->user()->agent_info->image)
            <img src="{{ asset('assets/uploads/images/' . auth()->user()->agent_info->image) }}" alt="User Profile" class="rounded-circle" width="35" height="35">
            @else
            <img src="{{ url('assets/images/user.png') }}" alt="User Profile" class="rounded-circle" width="35" height="35">
            @endif

          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('agent.show.profile')}}">
                <i class="fas fa-user me-2 icon-font"></i>
                Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('agent.reset.password')}}">
                <i class="fas fa-user me-2 icon-font"></i>
                Reset Password
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="fas fa-question-circle me-2 icon-font"></i>
                Help
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('signout') }}">
                <i class="fas fa-sign-out-alt me-2 icon-font"></i>
                Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
@php
$userId = auth()->user()->id;
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script>
  $(document).ready(function() {
    // Trigger when the dropdown is shown
    $('#notificationMenuButton').on('click', function() {
      $.ajax({
        url: '{{ route("agent.notifications.markAllRead") }}',
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          $('#notification-count').text('0');
        }
      });
    });
  });
</script>
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
  const userId = '{{ $userId }}';  // This makes the userId available in JS

  // The notification count badge
  const notificationCountBadge = document.getElementById('notification-count');

  // Listen for changes in the user's notifications in Firebase
  database.ref('notifications').orderByChild('user_id').equalTo(userId).on('child_added', (snapshot) => {
    const newNotification = snapshot.val();

    if (newNotification.is_read === false) {
      // Dynamically update the UI with the new notification
      updateNotificationInUI(newNotification);
    }
  });

  // Function to update the notification UI in real-time
  function updateNotificationInUI(notification) {
    const notificationContainer = document.getElementById('notification-container');
    const notificationCount = parseInt(notificationCountBadge.textContent);

    // Create a new list item for the new notification
    const notificationElement = document.createElement('li');
    notificationElement.innerHTML = `
      <a class="dropdown-item d-flex align-items-center" href="#">
        <i class="fas fa-comment-alt me-2 icon-font"></i>
        ${notification.body}
      </a>
    `;
    
    // Append to the dropdown menu
    notificationContainer.prepend(notificationElement);  // Prepend so new notifications appear at the top

    // Update the notification count
    notificationCountBadge.textContent = notificationCount + 1;  // Increase the unread count by 1

    // Optionally, mark the notification as read (e.g., update 'is_read' in Firebase)
    //markNotificationAsRead(notification);
  }

  // Mark the notification as read in Firebase (optional)
  function markNotificationAsRead(notification) {
    const notificationRef = database.ref('notifications/' + notification.id);
    notificationRef.update({
      is_read: true
    });
  }
</script>