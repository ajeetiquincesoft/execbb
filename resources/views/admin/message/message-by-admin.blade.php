@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Firebase and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- <style>
    .chat-container {
        max-width: 1000px;
        margin: 30px auto;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f9f9f9;
    }

    .tabs {
        display: flex;
        border-bottom: 1px solid #ddd;
    }

    .tab-link {
        flex: 1;
        padding: 15px;
        cursor: pointer;
        background: #f1f1f1;
        border: none;
        outline: none;
        transition: 0.3s;
        font-weight: bold;
    }

    .tab-link.active {
        background: #ffffff;
        border-bottom: 3px solid #007bff;
        color: #007bff;
    }

    .tab-content {
        display: none;
        padding: 20px;
    }

    .tab-content.active {
        display: block;
    }

    .tab-layout {
        display: flex;
        gap: 20px;
    }

    .user-list {
        width: 30%;
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
        border-right: 1px solid #ddd;
        background: #f7f9fc;
    }

    .user-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background 0.2s;
    }

    .user-item:hover,
    .user-item.active {
        background: #e3f2fd;
    }

    .user-item img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .chat-area {
        width: 70%;
        display: flex;
        flex-direction: column;
    }

    .chat-box {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
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

    .message-input {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .message-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .message-input button {
        background: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .message-input button:hover {
        background: #0056b3;
    }

    .message-actions {
        margin-top: 5px;
        font-size: 12px;
    }

    .message-actions a {
        color: #ffc107;
        margin-right: 10px;
        cursor: pointer;
    }

    .message-actions a.delete {
        color: #dc3545;
    }

    .badge {
        background-color: #dc3545;
        color: #fff;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 12px;
        margin-left: 6px;
        display: inline-block;
    }
</style> -->
<style>
    .chat-container {
        max-width: 1000px;
        margin: 30px auto;
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }

    .tabs {
        display: flex;
        background-color: #f5f7fa;
        border-bottom: 1px solid #ddd;
    }

    .tab-link {
        flex: 1;
        padding: 16px;
        background: transparent;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        transition: background 0.3s;
    }

    .tab-link.active {
        background: #ffffff;
        border-bottom: 2px solid #5a102a;
        color: #5a102a;
    }

    .tab-content {
        display: none;
        padding: 0;
    }

    .tab-content.active {
        display: block;
    }

    .tab-layout {
        display: flex;
        gap: 0;
        border-top: 1px solid #eee;
    }

    .user-list {
        width: 35%;
        max-height: 500px;
        overflow-y: auto;
        background-color: #f7f9fc;
        border-right: 1px solid #e0e0e0;
    }

    /*  .user-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        cursor: pointer;
        border-bottom: 1px solid #eaeaea;
        transition: background 0.2s ease;
    }

    .user-item:hover,
    .user-item.active {
        background-color: #eaf2ff;
    } */
    .user-item {
        padding: 10px;
        display: flex;
        gap: 10px;
        align-items: center;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s ease, box-shadow 0.2s ease;
    }

    .user-item:hover {
        background-color: #f5f5f5;
    }

    .user-item.active {
        background-color: #e9f3ff;
        box-shadow: inset 3px 0 0 #5a102a;
        font-weight: 600;
    }

    .user-item img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
    }

    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 20px;
        background-color: #fdfdfd;
    }

    #chat-header-admin,
    #chat-header-buyer {
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    /* .chat-box {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        background-color: #ffffff;
        border: 1px solid #e3e3e3;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    } */
    .chat-box {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        gap: 10px;
    }

    .message {
        max-width: 75%;
        padding: 12px 16px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        word-break: break-word;
        position: relative;
        display: inline-block;
    }

    .sent {
        align-self: flex-end;
        background-color: #5a102a;
        color: #ffffff;
    }

    .received {
        align-self: flex-start;
        background-color: #806132;
        color: #ffffff;
    }

    .timestamp {
        font-size: 11px;
        color: #f1f1f1;
        margin-top: 6px;
        text-align: right;
        opacity: 0.8;
    }

    .message-input {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .message-input input {
        flex: 1;
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .message-input button {
        background-color: #5a102a;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .message-input button:hover {
        background-color: #806132;
    }

    .message-actions {
        margin-top: 5px;
        font-size: 12px;
        text-align: right;
    }

    .message-actions a {
        color: #ffc107;
        margin-left: 10px;
        text-decoration: none;
        cursor: pointer;
    }

    .message-actions a.delete {
        color: #dc3545;
    }

    /* Scrollbar styling */
    .chat-box::-webkit-scrollbar,
    .user-list::-webkit-scrollbar {
        width: 6px;
    }

    .chat-box::-webkit-scrollbar-thumb,
    .user-list::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    .chat-box::-webkit-scrollbar-thumb:hover,
    .user-list::-webkit-scrollbar-thumb:hover {
        background: #999;
    }

    .badge {
        background-color: #dc3545;
        color: #fff;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 12px;
        margin-left: 6px;
        display: inline-block;
    }

    /* css date 04/06/2025*/
    .user-list .user-search {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 12px;
        border: 1.5px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        outline: none;
    }

    .user-list .user-search::placeholder {
        color: #999;
        font-style: italic;
    }

    .user-list .user-search:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.5);
    }


    /*css end*/
</style>

<div class="chat-container">
    <div class="tabs">
        <button class="tab-link active" data-tab="agent">Agent Chat</button>
        <button class="tab-link" data-tab="buyer">Buyer Chat</button>
    </div>

    @foreach(['agent', 'buyer'] as $role)
    <div id="{{ $role }}Tab" class="tab-content {{ $loop->first ? 'active' : '' }}">
        <div class="tab-layout">
            <div class="user-list" id="user-list-{{ $role }}" data-role="{{ $role }}">
                <input type="text" class="user-search" placeholder="Search {{ ucfirst($role) }}..." />
                <div class="user-entries"></div>
                <div class="loading" style="text-align: center; padding: 10px; display: none;">Loading...</div>
            </div>

            <div class="chat-area">
                <h5 id="chat-header-{{ $role }}">Select a user to chat</h5>
                <div id="chat-box-{{ $role }}" class="chat-box"></div>
                <div class="message-input">
                    <input type="text" id="message-{{ $role }}" placeholder="Type a message..." disabled />
                    <button data-role="{{ $role }}" class="send-btn" disabled>Send</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div id="firebase-user-data"
    data-agents='@json($agents)'
    data-buyers='@json($buyers)'>
</div>



<!-- <script>
    $(document).ready(function() {
        const currentUserId = "{{ auth()->id() }}";

        const firebaseConfig = {
            apiKey: "AIzaSyBOFU1nHTH3K92l8WCwUiI8Pz3Ul709OhE",
            authDomain: "exeb-443511.firebaseapp.com",
            databaseURL: "https://exeb-443511-default-rtdb.firebaseio.com",
            projectId: "exeb-443511",
            storageBucket: "exeb-443511.appspot.com",
            messagingSenderId: "953545808773",
            appId: "1:953545808773:web:d2ca948fe32004f822c2ec"
        };

        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

        let activeChats = {
            agent: new Map(),
            buyer: new Map()
        };

        let selectedUser = {
            agent: null,
            buyer: null
        };
        let searchState = {
            agent: {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            },
            buyer: {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            }
        };


        function renderUserList(role) {
            const container = $(`#user-list-${role} .user-entries`);
            if (!container.length) return; // prevent error if container not present
            container.empty();

            activeChats[role].forEach(user => {
                const html = `
                    <div class="user-item" data-user-id="${user.id}" data-name="${user.name}" data-role="${role}">
                        <img src="/assets/images/user.png" alt="Profile" />
                        <div>
                            <strong>${user.name}</strong><br>
                            <small>${user.email}</small>
                            <span class="user-unread-count badge" style="display: none;">0</span>
                        </div>
                    </div>
                `;
                container.append(html);
            });
        }

        function listenForMessages(role, users) {
            users.forEach(user => {
                const uid = user.id;
                const path1 = `messages/${uid}_${currentUserId}`;
                const path2 = `messages/${currentUserId}_${uid}`;

                const checkAndAdd = (msg) => {
                    if ((msg.sender === uid || msg.receiver === uid) && !activeChats[role].has(uid)) {
                        activeChats[role].set(uid, user);
                        renderUserList(role);
                    }
                };

                db.ref(path1).on('child_added', snapshot => {
                    checkAndAdd(snapshot.val());
                });

                db.ref(path2).on('child_added', snapshot => {
                    checkAndAdd(snapshot.val());
                });
            });
        }

        function fetchUserBySearch(role, query, reset = false) {
            if (!query) return;

            const state = searchState[role];
            if (reset) {
                state.offset = 0;
                state.finished = false;
                activeChats[role].clear();
                $(`#user-list-${role} .user-entries`).empty();
            }

            if (state.loading || state.finished) return;

            state.loading = true;
            $(`#user-list-${role} .loading`).show();

            $.ajax({
                url: "{{ route('admin.chat.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                data: {
                    search: query,
                    offset: state.offset,
                    perPage: 10
                },
                success: function(res) {
                    const users = res.data || [];

                    if (users.length === 0) {
                        state.finished = true;
                    } else {
                        users.forEach(user => {
                            if (!activeChats[role].has(user.id)) {
                                activeChats[role].set(user.id, user);
                            }
                        });
                        renderUserList(role);
                        state.offset += users.length;
                    }
                },
                complete: function() {
                    state.loading = false;
                    $(`#user-list-${role} .loading`).hide();
                }
            });
        }


        function setupSearchInput(role) {
            $(`#user-list-${role} .user-search`).on('input', debounce(function() {
                const searchVal = $(this).val().trim();
                searchState[role].query = searchVal;
                fetchUserBySearch(role, searchVal, true);
            }, 400));
        }


        function debounce(fn, delay) {
            let timer;
            return function() {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, arguments), delay);
            };
        }

        function selectUser(userId, role, name) {
            selectedUser[role] = userId;
            $(`#chat-header-${role}`).text(`Chat with ${name}`);
            $(`#message-${role}`).prop('disabled', false);
            $(`.send-btn[data-role="${role}"]`).prop('disabled', false);
            loadChatMessages(userId, role);
        }

        function loadChatMessages(userId, role) {
            const path1 = `messages/${currentUserId}_${userId}`;
            const path2 = `messages/${userId}_${currentUserId}`;
            const chatBox = $(`#chat-box-${role}`);
            chatBox.empty();
            const messages = [];

            function renderMessages() {
                chatBox.empty();
                messages.sort((a, b) => a.timestamp - b.timestamp);
                messages.forEach(msg => {
                    const align = msg.sender === currentUserId ? 'sent' : 'received';
                    const time = new Date(msg.timestamp).toLocaleTimeString();
                    chatBox.append(`
                        <div class="message ${align}">
                            <div>${msg.message}</div>
                            <small>${time}</small>
                        </div>
                    `);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }

            db.ref(path1).off();
            db.ref(path2).off();

            db.ref(path1).on('child_added', snap => {
                messages.push(snap.val());
                renderMessages();
            });

            db.ref(path2).on('child_added', snap => {
                messages.push(snap.val());
                renderMessages();
            });

            db.ref(path2).once('value', snap => {
                snap.forEach(child => {
                    if (child.val().receiver === currentUserId && !child.val().read) {
                        db.ref(path2).child(child.key).update({
                            read: true
                        });
                    }
                });
            });
        }

        $('.send-btn').click(function() {
            const role = $(this).data('role');
            const input = $(`#message-${role}`);
            const message = input.val().trim();
            const userId = selectedUser[role];

            if (!userId || !message) return;

            const path = `messages/${currentUserId}_${userId}`;
            db.ref(path).push({
                sender: currentUserId,
                receiver: userId,
                message,
                timestamp: Date.now(),
                read: false
            });

            input.val('');
        });

        $(document).on('click', '.user-item', function() {
            const role = $(this).data('role');
            const name = $(this).data('name');
            const userId = $(this).data('user-id');
            selectUser(userId, role, name);
        });

        $('.tab-link').on('click', function() {
            const tab = $(this).data('tab');
            $('.tab-link').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $(`#${tab}Tab`).addClass('active');
            renderUserList(tab);
        });

        function setupInfiniteScroll(role) {
            const container = $(`#user-list-${role}`);
            container.on('scroll', function() {
                const scrollTop = $(this).scrollTop();
                const scrollHeight = $(this)[0].scrollHeight;
                const containerHeight = $(this).height();

                if (scrollTop + containerHeight >= scrollHeight - 50) {
                    const state = searchState[role];
                    fetchUserBySearch(role, state.query);
                }
            });
        }


        const dataEl = document.getElementById('firebase-user-data');
        const agents = JSON.parse(dataEl.getAttribute('data-agents'));
        const buyers = JSON.parse(dataEl.getAttribute('data-buyers'));

        listenForMessages('agent', agents);
        listenForMessages('buyer', buyers);

        setupSearchInput('agent');
        setupSearchInput('buyer');

        setupInfiniteScroll('agent');
        setupInfiniteScroll('buyer');

        // Manually activate default tab
        $('.tab-link[data-tab="agent"]').click();
    });
</script> -->
<!-- <script>
    $(document).ready(function() {
        const currentUserId = "{{ auth()->id() }}";

        const firebaseConfig = {
            apiKey: "AIzaSyBOFU1nHTH3K92l8WCwUiI8Pz3Ul709OhE",
            authDomain: "exeb-443511.firebaseapp.com",
            databaseURL: "https://exeb-443511-default-rtdb.firebaseio.com",
            projectId: "exeb-443511",
            storageBucket: "exeb-443511.appspot.com",
            messagingSenderId: "953545808773",
            appId: "1:953545808773:web:d2ca948fe32004f822c2ec"
        };

        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

        let activeChats = {
            agent: new Map(),
            buyer: new Map()
        };
        let selectedUser = {
            agent: null,
            buyer: null
        };
        let searchState = {
            agent: {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            },
            buyer: {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            }
        };

        function renderUserList(role) {
            const container = $(`#user-list-${role} .user-entries`);
            container.empty();
            activeChats[role].forEach(user => {
                const html = `
                    <div class="user-item" data-user-id="${user.id}" data-name="${user.name}" data-role="${role}">
                        <img src="/assets/images/user.png" alt="Profile" />
                        <div>
                            <strong>${user.name}</strong><br>
                            <small>${user.email}</small>
                            <span class="user-unread-count badge" style="display: none;">0</span>
                        </div>
                    </div>
                `;
                container.append(html);
            });
        }

        function fetchActiveChats(role, users) {
            users.forEach(user => {
                const uid = user.id;
                const paths = [`messages/${uid}_${currentUserId}`, `messages/${currentUserId}_${uid}`];
                paths.forEach(path => {
                    db.ref(path).limitToFirst(1).once('value', snap => {
                        if (snap.exists()) {
                            activeChats[role].set(uid, user);
                            renderUserList(role);
                        }
                    });
                });
            });
        }

        function fetchUserBySearch(role, query, reset = false) {
            if (!query) return;
            const state = searchState[role];
            if (reset) {
                state.offset = 0;
                state.finished = false;
                activeChats[role].clear();
                $(`#user-list-${role} .user-entries`).empty();
            }
            if (state.loading || state.finished) return;
            state.loading = true;
            $(`#user-list-${role} .loading`).show();

            $.ajax({
                url: "{{ route('admin.chat.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                data: {
                    search: query,
                    offset: state.offset,
                    perPage: 10
                },
                success: function(res) {
                    const users = res.data || [];
                    if (users.length === 0) {
                        state.finished = true;
                    } else {
                        users.forEach(user => {
                            if (!activeChats[role].has(user.id)) {
                                activeChats[role].set(user.id, user);
                            }
                        });
                        renderUserList(role);
                        state.offset += users.length;
                    }
                },
                complete: function() {
                    state.loading = false;
                    $(`#user-list-${role} .loading`).hide();
                }
            });
        }

        function setupSearchInput(role) {
            $(`#user-list-${role} .user-search`).on('input', debounce(function() {
                const searchVal = $(this).val().trim();
                searchState[role].query = searchVal;
                fetchUserBySearch(role, searchVal, true);
            }, 400));
        }

        function debounce(fn, delay) {
            let timer;
            return function() {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, arguments), delay);
            };
        }

        function selectUser(userId, role, name) {
            selectedUser[role] = userId;
            $(`#chat-header-${role}`).text(`Chat with ${name}`);
            $(`#message-${role}`).prop('disabled', false);
            $(`.send-btn[data-role="${role}"]`).prop('disabled', false);
            loadChatMessages(userId, role);
        }

        function loadChatMessages(userId, role) {
            const path1 = `messages/${currentUserId}_${userId}`;
            const path2 = `messages/${userId}_${currentUserId}`;
            const chatBox = $(`#chat-box-${role}`);
            chatBox.empty();
            const messages = [];

            function renderMessages() {
                chatBox.empty();
                messages.sort((a, b) => a.timestamp - b.timestamp);
                messages.forEach(msg => {
                    const align = msg.sender === currentUserId ? 'sent' : 'received';
                    const time = new Date(msg.timestamp).toLocaleTimeString();
                    chatBox.append(`
                        <div class="message ${align}">
                            <div>${msg.message}</div>
                            <small>${time}</small>
                        </div>
                    `);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }

            db.ref(path1).off();
            db.ref(path2).off();

            db.ref(path1).on('child_added', snap => {
                messages.push(snap.val());
                renderMessages();
            });

            db.ref(path2).on('child_added', snap => {
                messages.push(snap.val());
                renderMessages();
            });

            db.ref(path2).once('value', snap => {
                snap.forEach(child => {
                    if (child.val().receiver === currentUserId && !child.val().read) {
                        db.ref(path2).child(child.key).update({
                            read: true
                        });
                    }
                });
            });
        }

        $('.send-btn').click(function() {
            const role = $(this).data('role');
            const input = $(`#message-${role}`);
            const message = input.val().trim();
            const userId = selectedUser[role];
            if (!userId || !message) return;

            const path = `messages/${currentUserId}_${userId}`;
            db.ref(path).push({
                sender: currentUserId,
                receiver: userId,
                message,
                timestamp: Date.now(),
                read: false
            });

            input.val('');

            // --- RESET SEARCH AND SHOW ACTIVE CHATS ---
            // Clear search input
            $(`#user-list-${role} .user-search`).val('');
            // Reset search state
            searchState[role].query = '';
            searchState[role].offset = 0;
            searchState[role].finished = false;
            // Clear activeChats map to reload properly
            activeChats[role].clear();
            // Fetch active chats again from original user list (agents or buyers)
            const users = role === 'agent' ? agents : buyers;
            fetchActiveChats(role, users);
        });


        $(document).on('click', '.user-item', function() {
            const role = $(this).data('role');
            const name = $(this).data('name');
            const userId = $(this).data('user-id');
            selectUser(userId, role, name);
        });

        $('.tab-link').on('click', function() {
            const tab = $(this).data('tab');
            $('.tab-link').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $(`#${tab}Tab`).addClass('active');
            renderUserList(tab);
        });

        function setupInfiniteScroll(role) {
            const container = $(`#user-list-${role}`);
            container.on('scroll', function() {
                const scrollTop = $(this).scrollTop();
                const scrollHeight = $(this)[0].scrollHeight;
                const containerHeight = $(this).height();

                if (scrollTop + containerHeight >= scrollHeight - 50) {
                    const state = searchState[role];
                    fetchUserBySearch(role, state.query);
                }
            });
        }

        const dataEl = document.getElementById('firebase-user-data');
        const agents = JSON.parse(dataEl.getAttribute('data-agents'));
        const buyers = JSON.parse(dataEl.getAttribute('data-buyers'));

        fetchActiveChats('agent', agents);
        fetchActiveChats('buyer', buyers);

        setupSearchInput('agent');
        setupSearchInput('buyer');
        setupInfiniteScroll('agent');
        setupInfiniteScroll('buyer');

        $('.tab-link[data-tab="agent"]').click();
    });
</script> -->

<script>
    $(document).ready(function() {
        const currentUserId = "{{ auth()->id() }}";

        const firebaseConfig = {
            apiKey: "AIzaSyBOFU1nHTH3K92l8WCwUiI8Pz3Ul709OhE",
            authDomain: "exeb-443511.firebaseapp.com",
            databaseURL: "https://exeb-443511-default-rtdb.firebaseio.com",
            projectId: "exeb-443511",
            storageBucket: "exeb-443511.appspot.com",
            messagingSenderId: "953545808773",
            appId: "1:953545808773:web:d2ca948fe32004f822c2ec"
        };

        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

        let activeChats = {
            agent: new Map(),
            buyer: new Map()
        };
        let selectedUser = {
            agent: null,
            buyer: null
        };
        let searchState = {
            agent: {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            },
            buyer: {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            }
        };
        const unreadCounts = {
            agent: new Map(),
            buyer: new Map()
        };
        const dataEl = document.getElementById('firebase-user-data');
        const agents = JSON.parse(dataEl.getAttribute('data-agents'));
        const buyers = JSON.parse(dataEl.getAttribute('data-buyers'));

        function setupUnreadCountListener(role, user) {
            const userId = user.id;
            const path = `messages/${userId}_${currentUserId}`;

            if (unreadCounts[role].has(userId) && unreadCounts[role].get(userId).off) {
                unreadCounts[role].get(userId).off();
            }

            const ref = db.ref(path);

            function updateUnreadCount(snapshot) {
                let count = 0;
                snapshot.forEach(child => {
                    const msg = child.val();
                    if (msg.receiver == currentUserId && msg.read === false) {
                        count++;
                    }
                });

                const userItem = $(`.user-item[data-user-id="${userId}"][data-role="${role}"]`);
                const badge = userItem.find('.user-unread-count');
                if (count > 0) {
                    badge.text(count).show();
                } else {
                    badge.hide();
                }
            }

            // Listen on entire path, no query filter
            ref.on('value', updateUnreadCount);

            unreadCounts[role].set(userId, {
                off: () => ref.off('value', updateUnreadCount)
            });
        }


        function renderUserList(role) {
            const container = $(`#user-list-${role} .user-entries`);
            container.empty();

            if (activeChats[role].size === 0) {
                container.append('<div style="padding: 10px; color: #666;">No active chats</div>');
            }

            activeChats[role].forEach(user => {
                const html = `
            <div class="user-item" data-user-id="${user.id}" data-name="${user.name}" data-role="${role}">
                <img src="/assets/images/user.png" alt="Profile" />
                <div>
                    <strong>${user.name}</strong><br>
                    <small>${user.email}</small>
                    <span class="user-unread-count badge" style="display: none;">0</span>
                </div>
            </div>
        `;
                container.append(html);
                setupUnreadCountListener(role, user);
            });
            console.log(`Rendered user list for role: ${role}, count: ${activeChats[role].size}`);
        }


        function fetchActiveChats(role, users) {
            activeChats[role].clear();

            const checks = users.map(user => {
                const uid = user.id;
                console.log(uid);
                const paths = [`messages/${uid}_${currentUserId}`, `messages/${currentUserId}_${uid}`];

                // Check both paths for any messages
                return Promise.all(paths.map(path =>
                    db.ref(path).once('value').then(snap => snap.exists())
                )).then(results => {
                    if (results.some(exists => exists)) {
                        activeChats[role].set(uid, user);
                        console.log(`User ${user.name} has messages, added to activeChats[${role}]`);
                    } else {
                        console.log(`User ${user.name} has no messages`);
                    }
                }).catch(err => {
                    console.error('Firebase error checking messages:', err);
                });
            });

            Promise.all(checks).then(() => {
                console.log(`All users checked for role: ${role}, activeChats size:`, activeChats[role].size);
                renderUserList(role);
            });
        }


        /* function fetchUserBySearch(role, query, reset = false) {
            if (!query) return;
            const state = searchState[role];
            if (reset) {
                state.offset = 0;
                state.finished = false;
                activeChats[role].clear();
                $(`#user-list-${role} .user-entries`).empty();
            }
            if (state.loading || state.finished) return;
            state.loading = true;
            $(`#user-list-${role} .loading`).show();

            $.ajax({
                url: "{{ route('admin.chat.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                data: {
                    search: query,
                    offset: state.offset,
                    perPage: 10
                },
                success: function(res) {
                    const users = res.data || [];
                    if (users.length === 0) {
                        state.finished = true;
                    } else {
                        users.forEach(user => {
                            if (!activeChats[role].has(user.id)) {
                                activeChats[role].set(user.id, user);
                            }
                        });
                        renderUserList(role);
                        state.offset += users.length;
                    }
                },
                complete: function() {
                    state.loading = false;
                    $(`#user-list-${role} .loading`).hide();
                }
            });
        } */
        function fetchUserBySearch(role, query, reset = false) {
            const state = searchState[role];
            if (reset) {
                state.offset = 0;
                state.finished = false;
                activeChats[role].clear();
                $(`#user-list-${role} .user-entries`).empty();
            }

            // Update query state even if not reset
            state.query = query;

            if (!query) return; // Don't fetch if query is empty
            if (state.loading || state.finished) return;
            state.loading = true;
            $(`#user-list-${role} .loading`).show();

            $.ajax({
                url: "{{ route('admin.chat.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                data: {
                    search: query,
                    offset: state.offset,
                    perPage: 10
                },
                success: function(res) {
                    const users = res.data || [];
                    if (users.length === 0) {
                        state.finished = true;
                    } else {
                        users.forEach(user => {
                            if (!activeChats[role].has(user.id)) {
                                activeChats[role].set(user.id, user);
                            }
                        });
                        renderUserList(role);
                        state.offset += users.length;
                    }
                },
                complete: function() {
                    state.loading = false;
                    $(`#user-list-${role} .loading`).hide();
                }
            });
        }

        function setupSearchInput(role) {
            $(`#user-list-${role} .user-search`).on('input', debounce(function() {
                const val = $(this).val().trim();
                if (val === '') {
                    // Fetch active users to show default list
                    $.ajax({
                        url: "{{ route('admin.active.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                        method: 'GET',
                        success: function(res) {
                            const users = res.data || [];
                            activeChats[role].clear();
                            users.forEach(user => activeChats[role].set(user.id, user));
                            renderUserList(role);
                        }
                    });
                } else {
                    // Perform search - your existing AJAX search logic here
                    fetchUserBySearch(role, val, true);
                }
            }, 400));
        }


        function debounce(fn, delay) {
            let timer;
            return function() {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, arguments), delay);
            };
        }

        function selectUser(userId, role, name) {
            selectedUser[role] = userId;
            $(`#chat-header-${role}`).text(`Chat with ${name}`);
            $(`#message-${role}`).prop('disabled', false);
            $(`.send-btn[data-role="${role}"]`).prop('disabled', false);
            loadChatMessages(userId, role);
        }

        function loadChatMessages(userId, role) {
            const path1 = `messages/${currentUserId}_${userId}`;
            const path2 = `messages/${userId}_${currentUserId}`;
            const chatBox = $(`#chat-box-${role}`);
            chatBox.empty();
            const messages = [];

            function renderMessages() {
                chatBox.empty();
                messages.sort((a, b) => a.timestamp - b.timestamp);
                messages.forEach(msg => {
                    const align = msg.sender === currentUserId ? 'sent' : 'received';
                    const time = new Date(msg.timestamp).toLocaleTimeString();
                    let buttons = '';
                    if (msg.sender === currentUserId) {
                        buttons = `
                    <a class="edit-btn" data-key="${msg.key}" data-role="${role}" data-userid="${userId}">Edit</a>
                    <a class="delete-btn" data-key="${msg.key}" data-role="${role}" data-userid="${userId}">Delete</a>
                `;
                    }
                    chatBox.append(`
                <div class="message ${align}" data-key="${msg.key}">
                    <div class="message-content">${escapeHtml(msg.message)}</div>
                    <small>${time}</small>
                    <div class="message-actions">${buttons}</div>
                </div>
            `);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }

            function addOrUpdateMessage(val, key) {
                // Remove any existing message with this key to avoid duplicates
                const index = messages.findIndex(m => m.key === key);
                if (index > -1) messages.splice(index, 1);
                val.key = key;
                messages.push(val);
                renderMessages();
            }

            function removeMessage(key) {
                const index = messages.findIndex(m => m.key === key);
                if (index > -1) {
                    messages.splice(index, 1);
                    renderMessages();
                }
            }

            db.ref(path1).off();
            db.ref(path2).off();

            // Clear existing messages array
            messages.length = 0;

            // Listen for child_added in both paths
            db.ref(path1).on('child_added', snap => {
                addOrUpdateMessage(snap.val(), snap.key);
            });
            db.ref(path2).on('child_added', snap => {
                addOrUpdateMessage(snap.val(), snap.key);
            });

            // Listen for child_changed (if you want live update on edits)
            db.ref(path1).on('child_changed', snap => {
                addOrUpdateMessage(snap.val(), snap.key);
            });
            db.ref(path2).on('child_changed', snap => {
                addOrUpdateMessage(snap.val(), snap.key);
            });

            // Listen for child_removed and update messages array + UI
            db.ref(path1).on('child_removed', snap => {
                removeMessage(snap.key);
            });
            db.ref(path2).on('child_removed', snap => {
                removeMessage(snap.key);
            });

            // Mark received messages as read (optional)
            db.ref(path2).once('value', snap => {
                snap.forEach(child => {
                    if (child.val().receiver === currentUserId && !child.val().read) {
                        db.ref(path2).child(child.key).update({
                            read: true
                        });
                    }
                });
            });
        }



        /*   $('.send-btn').click(function() {
              const role = $(this).data('role');
              const input = $(`#message-${role}`);
              const message = input.val().trim();
              const userId = selectedUser[role];
              if (!userId || !message) return;
              const path = `messages/${currentUserId}_${userId}`;
              db.ref(path).push({
                  sender: currentUserId,
                  receiver: userId,
                  message,
                  timestamp: Date.now(),
                  read: false
              });

              input.val('');

              // Clear search input and hide any search results
              const searchInput = $(`#user-list-${role} .user-search`);
              searchInput.val('');

              // Fetch active users after message sent
              $.ajax({
                  url: "{{ route('admin.active.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                  method: 'GET',
                  success: function(res) {
                      const users = res.data || [];
                      activeChats[role].clear();
                      users.forEach(user => activeChats[role].set(user.id, user));

                      // Re-render the active user list
                      renderUserList(role);

                      // Optionally reset selected user (or keep as is)
                      // selectedUser[role] = null;
                      // Clear chat box if needed
                  },
                  error: function() {
                      console.error('Failed to fetch active users');
                  }
              });
          }); */
        $('.send-btn').click(function() {
            const role = $(this).data('role');
            const input = $(`#message-${role}`);
            const message = input.val().trim();
            const userId = selectedUser[role];
            if (!userId || !message) return;
            const path = `messages/${currentUserId}_${userId}`;
            db.ref(path).push({
                sender: currentUserId,
                receiver: userId,
                message,
                timestamp: Date.now(),
                read: false
            });

            input.val('');

            // Clear search input and reset search state for the role
            const searchInput = $(`#user-list-${role} .user-search`);
            searchInput.val('');

            // Reset search state for this role
            searchState[role] = {
                query: '',
                offset: 0,
                loading: false,
                finished: false
            };

            // Fetch active users to show updated list after sending message
            $.ajax({
                url: "{{ route('admin.active.users', ['role' => '__ROLE__']) }}".replace('__ROLE__', role),
                method: 'GET',
                success: function(res) {
                    const users = res.data || [];
                    activeChats[role].clear();
                    users.forEach(user => activeChats[role].set(user.id, user));
                    renderUserList(role);

                    // Optionally clear selected user/chat if you want (commented out here)
                    // selectedUser[role] = null;
                    // $(`#chat-box-${role}`).empty();
                },
                error: function() {
                    console.error('Failed to fetch active users');
                }
            });
        });


        $(document).on('click', '.user-item', function() {
            const userId = $(this).data('user-id');
            const role = $(this).data('role');
            const name = $(this).data('name');
            $(`.user-item[data-role="${role}"]`).removeClass('active');
            $(this).addClass('active');
            selectUser(userId, role, name);
            const path = `messages/${userId}_${currentUserId}`;

            const ref = db.ref(path);
            ref.orderByChild('read').equalTo(false).once('value')
                .then(snapshot => {
                    const updates = {};
                    snapshot.forEach(child => {
                        const msg = child.val();
                        if (msg.receiver == currentUserId && msg.read === false) {
                            updates[child.key + '/read'] = true; // set read true
                        }
                    });
                    if (Object.keys(updates).length > 0) {
                        return ref.update(updates);
                    }
                    return Promise.resolve();
                })
                .then(() => {
                    console.log(`Marked messages as read for user ${userId}`);
                    const badge = $(this).find('.user-unread-count');
                    badge.hide();
                })
                .catch(err => {
                    console.error('Error marking messages as read:', err);
                });
        });

        $('.tab-link').on('click', function() {
            const tab = $(this).data('tab');
            $('.tab-link').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $(`#${tab}Tab`).addClass('active');
            renderUserList(tab);
        });

        /*     function setupInfiniteScroll(role) {
                const container = $(`#user-list-${role}`);
                container.on('scroll', function() {
                    const scrollTop = $(this).scrollTop();
                    const scrollHeight = $(this)[0].scrollHeight;
                    const containerHeight = $(this).height();

                    if (scrollTop + containerHeight >= scrollHeight - 50) {
                        const state = searchState[role];
                        fetchUserBySearch(role, state.query);
                    }
                });
            } */
        function setupInfiniteScroll(role) {
            const container = $(`#user-list-${role}`);
            container.on('scroll', function() {
                const scrollTop = $(this).scrollTop();
                const scrollHeight = $(this)[0].scrollHeight;
                const containerHeight = $(this).height();

                if (scrollTop + containerHeight >= scrollHeight - 50) {
                    const state = searchState[role];
                    // Only fetch more if a search query exists (user is searching)
                    if (state.query && !state.finished && !state.loading) {
                        fetchUserBySearch(role, state.query);
                    }
                }
            });
        }

        fetchActiveChats('agent', agents);
        fetchActiveChats('buyer', buyers);

        setupSearchInput('agent');
        setupSearchInput('buyer');
        setupInfiniteScroll('agent');
        setupInfiniteScroll('buyer');

        $('.tab-link[data-tab="agent"]').click();

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            return $('<div>').text(text).html();
        }

        // Edit message handler
        $(document).on('click', '.edit-btn', function() {
            const key = $(this).data('key');
            const role = $(this).data('role');
            const userId = $(this).data('userid');
            const messageDiv = $(this).closest('.message');
            const contentDiv = messageDiv.find('.message-content');

            // Replace text with input field for editing
            const currentText = contentDiv.text();
            contentDiv.html(`<input type="text" class="edit-input" value="${escapeHtml(currentText)}" />`);

            // Change buttons to Save/Cancel
            const actionsDiv = messageDiv.find('.message-actions');
            actionsDiv.html(`
        <a class="save-btn" data-key="${key}" data-role="${role}" data-userid="${userId}">Save</a>
        <a class="cancel-btn" data-key="${key}" data-role="${role}" data-userid="${userId}">Cancel</a>
    `);
        });

        // Cancel edit handler
        $(document).on('click', '.cancel-btn', function() {
            const key = $(this).data('key');
            const role = $(this).data('role');
            const userId = $(this).data('userid');
            const messageDiv = $(this).closest('.message');
            const contentDiv = messageDiv.find('.message-content');

            // Restore original message text from Firebase
            const path1 = `messages/${currentUserId}_${userId}`;
            const path2 = `messages/${userId}_${currentUserId}`;
            // Try both paths to find the message
            db.ref(path1).child(key).once('value', snap => {
                if (snap.exists()) {
                    contentDiv.text(snap.val().message);
                    resetMessageActions(messageDiv, key, role, userId);
                } else {
                    db.ref(path2).child(key).once('value', snap2 => {
                        if (snap2.exists()) {
                            contentDiv.text(snap2.val().message);
                            resetMessageActions(messageDiv, key, role, userId);
                        }
                    });
                }
            });
        });

        function resetMessageActions(messageDiv, key, role, userId) {
            messageDiv.find('.message-actions').html(`
        <a class="edit-btn" data-key="${key}" data-role="${role}" data-userid="${userId}">Edit</a>
        <a class="delete-btn" data-key="${key}" data-role="${role}" data-userid="${userId}">Delete</a>
    `);
        }

        // Save edited message handler
        $(document).on('click', '.save-btn', function() {
            const key = $(this).data('key');
            const role = $(this).data('role');
            const userId = $(this).data('userid');
            const messageDiv = $(this).closest('.message');
            const input = messageDiv.find('.edit-input');
            const newText = input.val().trim();

            if (newText === '') {
                alert('Message cannot be empty!');
                return;
            }

            const path1 = `messages/${currentUserId}_${userId}`;
            const path2 = `messages/${userId}_${currentUserId}`;

            // Try updating in path1 first
            db.ref(path1).child(key).once('value', snap => {
                if (snap.exists()) {
                    db.ref(path1).child(key).update({
                        message: newText
                    }).then(() => {
                        messageDiv.find('.message-content').text(newText);
                        resetMessageActions(messageDiv, key, role, userId);
                    });
                } else {
                    // Else try path2
                    db.ref(path2).child(key).once('value', snap2 => {
                        if (snap2.exists()) {
                            db.ref(path2).child(key).update({
                                message: newText
                            }).then(() => {
                                messageDiv.find('.message-content').text(newText);
                                resetMessageActions(messageDiv, key, role, userId);
                            });
                        } else {
                            alert('Message not found!');
                        }
                    });
                }
            });
        });

        // Delete message handler
        $(document).on('click', '.delete-btn', function() {
            if (!confirm('Are you sure you want to delete this message?')) return;

            const key = $(this).data('key');
            const role = $(this).data('role');
            const userId = $(this).data('userid');
            const messageDiv = $(this).closest('.message');

            const path1 = `messages/${currentUserId}_${userId}`;
            const path2 = `messages/${userId}_${currentUserId}`;

            db.ref(path1).child(key).once('value', snap => {
                if (snap.exists()) {
                    db.ref(path1).child(key).remove().then(() => {
                        messageDiv.remove();
                    });
                } else {
                    db.ref(path2).child(key).once('value', snap2 => {
                        if (snap2.exists()) {
                            db.ref(path2).child(key).remove().then(() => {
                                messageDiv.remove();
                            });
                        } else {
                            alert('Message not found!');
                        }
                    });
                }
            });
        });


    });
</script>




@endsection