@extends('agent-dashboard.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .chat-container {
        max-width: 900px;
        margin: auto;
        display: flex;
        border: 1px solid #ddd;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .agent-list {
        width: 30%;
        background: #f7f9fc;
        padding: 15px;
        border-right: 1px solid #ddd;
    }

    .agent {
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .agent:hover,
    .agent.active {
        background: #e3f2fd;
    }

    .agent img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #007bff;
    }

    .chat-section {
        width: 70%;
        display: flex;
        flex-direction: column;
        padding: 15px;
        background: #f9f9f9;
    }

    .chat-box {
        height: 450px;
        overflow-y: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
    }

    .message {
        padding: 10px 14px;
        margin: 5px 0;
        border-radius: 18px;
        font-size: 14px;
        max-width: 75%;
        word-break: break-word;
        position: relative;
    }

    .sent {
        background-color: #5a102a;
        color: #ffffff;
        align-self: flex-end;
    }

    .received {
        background-color: #806132;
        color: #ffffff;
        align-self: flex-start;
    }

    .timestamp {
        font-size: 10px;
        color: #ffffff;
    }

    .chat-input {
        display: flex;
        align-items: center;
        background: white;
        padding: 8px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .chat-input input {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
    }

    .chat-input button {
        background: #5a102a;
        color: #ffffff;
        border: none;
        padding: 10px 15px;
        margin-left: 10px;
        border-radius: 8px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background: #806132;
    }

    .message-actions {
        display: none;
        /* position: absolute; */
        top: 50%;
        right: -40px;
        transform: translateY(-50%);
    }

    .message:hover .message-actions {
        display: inline;
    }

    .message-actions button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 12px;
        color: #666;
        padding: 5px;
    }

    .send_message {
        display: none;
    }
</style>

<div class="row card p-4">
    <div class="chat-container">
        <!-- Agent List Sidebar -->
        <div class="agent-list">
            <h3>Buyers</h3>
            @foreach($buyers as $key=>$buyer)
            <div class="agent" id="buyer-{{$buyer->user_id}}" onclick="selectBuyer('{{ $buyer->user_id }}', '{{ $buyer->FName }}')">
                <img src="{{ url('assets/images/user.png') }}" alt="User Profile">
                <span>{{ ucfirst($buyer->FName) }} {{ ucfirst($buyer->LName) }}
                    <span id="badge-{{$buyer->user_id}}" class="badge bg-danger" style="display: none;">0</span>
                </span>
            </div>
            @endforeach
        </div>

        <!-- Chat Section -->
        <div class="chat-section hidden" id="chat-section">
            <h3 id="chat-header">Chat</h3>
            <div id="chat-box" class="chat-box">Welcome to your Agent Dashboard. If you have any questions or need assistance, our support team is always ready to help. Whether you need guidance with managing listings, responding to buyer inquiries, or any other aspect of your work, don't hesitate to start a conversation. We’re here to ensure you have all the resources and support you need to succeed. Feel free to reach out at any time.</div>

            <div class="chat-input">
                <input type="hidden" id="agent_id" name="agent_id" value="{{ auth()->id() }}" />
                <input type="text" id="message" placeholder="Type a message..." autocomplete="off" class="send_message">
                <button onclick="sendMessage()" class="send_message">Send</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<!-- 
<script>
    $(document).ready(function() {
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
        const app = firebase.initializeApp(firebaseConfig);
        const db = firebase.database(app);

        let selectedBuyerId = null;
        let selectedBuyerName = null;
        let agentId = $('#agent_id').val();

        // ✅ Make `selectBuyer` global
        window.selectBuyer = function(buyerId, buyerName) {
            selectedBuyerId = buyerId;
            selectedBuyerName = buyerName;
            $("#chat-header").text(`Chat with ${buyerName}`);
            $("#chat-section").removeClass("hidden");
            $("#chat-box").html(""); // Clear previous messages

            let chatPath = `messages/${agentId}_${selectedBuyerId}/`;

            // Load chat messages from Firebase
            db.ref(chatPath).off(); // Remove old listeners
            db.ref(chatPath).on("child_added", function(snapshot) {
                let msg = snapshot.val();
                console.log("Received message:", msg);
                let className = msg.sender === "Agent" ? "sent" : "received";
                $("#chat-box").append(`<div class="message ${className}">${msg.message}</div>`);
                $(".chat-box").scrollTop($(".chat-box")[0].scrollHeight);
            });
        };

        // ✅ Function to send message
        window.sendMessage = function() {
            if (!selectedBuyerId) {
                alert("Please select a buyer to chat with!");
                return;
            }

            let message = $("#message").val().trim();
            if (message === "") {
                alert("Message cannot be empty!");
                return;
            }
            let chatPath = `messages/${agentId}_${selectedBuyerId}/`;
            $.ajax({
                url: "{{ route('agent.send.message') }}",
                type: "POST",
                data: {
                    sender: agentId,
                    receiver: selectedBuyerId,
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#message").val("");
                },
                error: function(xhr, status, error) {
                    console.error("Error sending message:", xhr.responseText);
                }
            });

            // Save message in Firebase
            db.ref(chatPath).push({
                sender: "Agent",
                message: message,
                timestamp: Date.now()
            });
        };
    });
</script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script>
    $(document).ready(function() {
        // ✅ Firebase Configuration
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
        const app = firebase.initializeApp(firebaseConfig);
        const db = firebase.database(app);
        const messagesRef = db.ref('messages');
        var currentUserId = "{{ auth()->user()->id }}";
        var unreadMessages = {}; // Store unread messages by conversation
        var buyerUnreadCount = {}; // Store unread count per buyer

        // Use 'on' to listen for real-time updates
        messagesRef.on('value', (snapshot) => {
            if (snapshot.exists()) {
                const messages = snapshot.val();
                let foundMessages = false;

                // Reset unread messages and counts on every update
                unreadMessages = {};
                buyerUnreadCount = {};

                // Iterate through all conversations
                Object.keys(messages).forEach(conversationKey => {
                    const conversation = messages[conversationKey];

                    // Iterate through all messages in this conversation
                    Object.keys(conversation).forEach(key => {
                        const message = conversation[key];

                        // Check if the receiver is the current user and message is unread
                        if (message.receiver === currentUserId && !message.read) {
                            foundMessages = true;

                            // Add to unreadMessages
                            if (!unreadMessages[conversationKey]) {
                                unreadMessages[conversationKey] = [];
                            }
                            unreadMessages[conversationKey].push(message);

                            // Update unread count for the sender (buyer)
                            const senderId = message.sender;
                            if (!buyerUnreadCount[senderId]) {
                                buyerUnreadCount[senderId] = 0;
                            }
                            buyerUnreadCount[senderId]++;
                        }
                    });
                });

                if (!foundMessages) {
                    console.log("No unread messages found for receiver.");
                }
            } else {
                console.log("No messages in the database.");
            }

            console.log("Unread Messages:", unreadMessages); // Log unread messages
            console.log("Unread message count per buyer:", buyerUnreadCount); // Log unread message counts

            updateUnreadCountUI(); // Update the UI with unread message counts
        });

        // Function to update the unread message count badges on the UI
        function updateUnreadCountUI() {
            // Loop through buyerUnreadCount and update the corresponding badge
            for (let buyerId in buyerUnreadCount) {
                const unreadCount = buyerUnreadCount[buyerId];
                const badgeElement = document.querySelector(`#badge-${buyerId}`);

                if (unreadCount > 0 && badgeElement) {
                    badgeElement.textContent = unreadCount;
                    badgeElement.style.display = 'inline-block'; // Show badge if there are unread messages
                } else if (badgeElement) {
                    badgeElement.style.display = 'none'; // Hide badge if there are no unread messages
                }
            }
        }



        let selectedBuyerId = null;
        let agentId = $('#agent_id').val();
        let chatPath = "";
        let editMessageId = null;

        // ✅ Select Buyer for Chat
        window.selectBuyer = function(buyerId, buyerName) {
            // Mark messages as read for the selected buyer
            $('.send_message').show();
            markMessagesAsRead(buyerId);

            // Update the badge UI (hide and reset count to 0)
            const badgeElement = document.querySelector(`#badge-${buyerId}`);
            if (badgeElement) {
                badgeElement.style.display = 'none'; // Hide the badge
                buyerUnreadCount[buyerId] = 0; // Reset unread count to 0
            }

            // (Optional) You can display a message or load the chat for that buyer
            console.log(`Selected Buyer: ${buyerName} (ID: ${buyerId})`);
            selectedBuyerId = buyerId;
            let capitalizedBuyerName = buyerName.charAt(0).toUpperCase() + buyerName.slice(1);
            $("#chat-header").text(`Chat with ${capitalizedBuyerName}`);
            $("#chat-section").removeClass("hidden");
            $("#chat-box").html(""); // Clear previous messages
            chatPath = `messages/${agentId}_${selectedBuyerId}/`;

            // ✅ Remove old Firebase listeners
            db.ref(chatPath).off();

            // ✅ Listen for New, Updated & Deleted Messages in Real-Time
            db.ref(chatPath).on("value", function(snapshot) {
                $("#chat-box").html(""); // Clear old messages
                snapshot.forEach(function(childSnapshot) {
                    let msg = childSnapshot.val();
                    let msgId = childSnapshot.key;
                    let className = msg.sendby === "Agent" ? "sent" : "received";
                    let timestamp = new Date(msg.timestamp).toLocaleString();

                    // ✅ Show edit & delete buttons only for agent's own messages
                    let actions = msg.sendby === "Agent" ? `
                        <span class="message-actions">
                            <button onclick="editMessage('${msgId}', '${msg.message}')">
                                <i class="fa fa-edit" style="color: #ffffff;"></i>
                            </button>
                            <button onclick="deleteMessage('${msgId}')">
                                <i class="fa fa-trash-alt" style="color: #ffffff;"></i>
                            </button>
                        </span>
                    ` : '';

                    let messageElement = `
                        <div class="message ${className}" data-id="${msgId}">
                            <span class="message-text">${msg.message}</span>
                            <div class="timestamp">${timestamp}</div>
                            ${actions}
                        </div>
                    `;

                    $("#chat-box").append(messageElement);
                });

                $(".chat-box").scrollTop($(".chat-box")[0].scrollHeight);
            });
        };

        // ✅ Send or Update Message
        window.sendMessage = function() {
            if (!selectedBuyerId) {
                alert("Please select a buyer to chat with!");
                return;
            }

            let message = $("#message").val().trim();
            if (message === "") {
                alert("Message cannot be empty!");
                return;
            }

            if (editMessageId) {
                // ✅ Update existing message in Firebase
                db.ref(`${chatPath}${editMessageId}`).update({
                    message: message
                }).then(() => {
                    $("#message").val("");
                    editMessageId = null;
                }).catch(error => console.error("Error updating message:", error));
                return;
            }

            // ✅ Send a new message
            db.ref(chatPath).push({
                sender: agentId,
                receiver: selectedBuyerId,
                sendby: "Agent",
                message: message,
                read: false,
                timestamp: Date.now()
            });

            $("#message").val("");
        };

        // ✅ Edit Message (Set for Editing)
        window.editMessage = function(msgId, msgText) {
            $("#message").val(msgText).focus();
            editMessageId = msgId;
        };

        // ✅ Delete Message (Remove from Firebase)
        /*   window.deleteMessage = function(msgId) {
              if (confirm("Are you sure you want to delete this message?")) {
                  db.ref(`${chatPath}${msgId}`).remove();
              }
          }; */
        window.deleteMessage = function(msgId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this message!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5e0f2f',
                cancelButtonColor: '#93744b',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    db.ref(`${chatPath}${msgId}`).remove();
                    Swal.fire(
                        'Deleted!',
                        'Your message has been deleted.',
                        'success'
                    );
                }
            });
        };
        // Function to mark all messages from a buyer as read
        function markMessagesAsRead(buyerId) {
            // Iterate through the messages and set 'read' to true for the selected buyer
            messagesRef.once('value', (snapshot) => {
                if (snapshot.exists()) {
                    const messages = snapshot.val();

                    Object.keys(messages).forEach(conversationKey => {
                        const conversation = messages[conversationKey];

                        // Iterate through all messages in this conversation
                        Object.keys(conversation).forEach(key => {
                            const message = conversation[key];

                            // Check if the sender is the buyer and if the message is unread
                            if (message.sender === buyerId && message.receiver === currentUserId && !message.read) {
                                // Update the 'read' status of the message in Firebase
                                const messageRef = messagesRef.child(conversationKey).child(key);
                                messageRef.update({
                                    read: true
                                });

                                console.log(`Message from Buyer ${buyerId} marked as read.`);
                            }
                        });
                    });
                }
            });
        }
    });
</script>

<div id="chatContainer"></div>
@endsection