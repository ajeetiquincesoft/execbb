@extends('frontend.layout.buyer-master')
@section('content')
<div class="container">
    <div class="notifications-container">
    @if($notifications)
    @foreach($notifications as $notification)
        <div class="notification-item">
            <div class="notification-details">
                <div class="notification-header">
                    <span class="notification-title">{{ $notification['title'] }}</span>
                    <span class="notification-timestamp">{{ \Carbon\Carbon::parse($notification['timestamp'])->diffForHumans() }}</span>
                </div>
                <div class="notification-body">
                {!! $notification['body'] !!}
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No notifications found.</p>
    @endif
    </div>
</div>
<style>
/* Container for all notifications */
.notifications-container {
  width: 100%;
  max-width: 500px;
  margin-top: 30px;
  padding: 0 15px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
}

/* Individual notification item */
.notification-item {
  background-color: #fff;
  border-radius: 12px;
  padding: 15px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
}

.notification-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}
/* Notification details */
.notification-details {
  flex-grow: 1;
}

/* Header (Title + Timestamp) */
.notification-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 5px;
}

.notification-title {
  font-size: 16px;
  font-weight: bold;
  color: #333;
}

.notification-timestamp {
  font-size: 12px;
  color: #aaa;
}

/* Notification body */
.notification-body {
  font-size: 14px;
  color: #555;
  line-height: 1.5;
  margin-top: 5px;
}
    </style>
@endsection