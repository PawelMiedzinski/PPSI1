<x-app-layout>
    <div class="container-fluid py-4">
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden" style="height:82vh;">
            <div class="row g-0 h-100">
                
                {{-- LEFT SIDEBAR --}}
                <div class="col-lg-4 border-end bg-white">
                    <div class="p-4 border-bottom">
                        <h3 class="fw-bold mb-1">Messages</h3>
                        <div class="text-secondary">{{ $conversations->count() }} conversation{{ $conversations->count() != 1 ? 's' : '' }}</div>
                    </div>
                    <div style="overflow-y:auto; height:calc(82vh - 95px);">
                        @forelse($conversations as $conv)
                            @php $other = $conv->users->where('id', '!=', Auth::id())->first(); @endphp
                            <a href="/messages/{{ $conv->id }}" class="text-decoration-none text-dark">
                                <div class="conversation-row p-3 border-bottom {{ isset($conversation) && $conversation->id == $conv->id ? 'active-chat' : '' }}">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div>
                                            @if($other && $other->avatar)
                                                <img src="{{ asset('storage/'.$other->avatar) }}" style="width:60px; height:60px; border-radius:18px; object-fit:cover;">
                                            @else
                                                <div style="width:60px; height:60px; border-radius:18px; background: linear-gradient(135deg, #2563eb, #60a5fa); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:22px; color:white;">
                                                    {{ $other ? strtoupper(substr($other->name, 0, 1)) : '?' }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">{{ $other ? $other->name : 'Unknown' }}</div>
                                            <div class="small text-secondary text-truncate">{{ optional($conv->latestMessage)->message ?? 'No messages yet' }}</div>
                                        </div>
                                        <div class="small text-secondary">{{ optional($conv->latestMessage)->created_at ? optional($conv->latestMessage)->created_at->diffForHumans() : '' }}</div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-5 text-secondary">
                                <div style="font-size:50px;">💬</div>
                                No conversations yet
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- CHAT SECTION --}}
                <div class="col-lg-8 d-flex flex-column">
                    @if(isset($conversation))
                        @php $other = $conversation->users->where('id', '!=', Auth::id())->first(); @endphp
                        <div class="p-4 border-bottom bg-white">
                            <div class="d-flex align-items-center gap-3">
                                @if($other && $other->avatar)
                                    <img src="{{ asset('storage/'.$other->avatar) }}" style="width:55px; height:55px; border-radius:18px; object-fit:cover;">
                                @endif
                                <div>
                                    <div class="fw-bold fs-5">{{ $other ? $other->name : 'Unknown' }}</div>
                                    <div class="text-secondary">Marketplace User</div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-grow-1 p-4" style="overflow-y:auto; background: #f8fafc;">
                            @foreach($conversation->messages as $message)
                                <div class="d-flex mb-3 {{ $message->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                    <div class="message-bubble {{ $message->sender_id == Auth::id() ? 'my-message' : 'their-message' }}">
                                        {{ $message->message }}
                                        <div class="small mt-2 opacity-75">{{ $message->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-top p-3 bg-white">
                            <form method="POST" action="/messages/{{ $conversation->id }}">
                                @csrf
                                <div class="d-flex gap-3">
                                    <input name="message" class="form-control rounded-4 px-4 py-3" placeholder="Write message..." required>
                                    <button class="btn btn-primary rounded-4 px-4">Send</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="h-100 d-flex flex-column justify-content-center align-items-center text-secondary">
                            <div style="font-size:70px;">💬</div>
                            <h3>Select conversation</h3>
                            <div>Choose someone from sidebar</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .conversation-row {
            cursor: pointer;
            transition: .15s;
        }
        .conversation-row:hover {
            background: #f8fafc;
        }
        .active-chat {
            background: #edf4ff;
        }
        .message-bubble {
            max-width: 70%;
            padding: 14px 18px;
            border-radius: 24px;
            word-break: break-word;
        }
        .my-message {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border-bottom-right-radius: 8px;
        }
        .their-message {
            background: white;
            border-bottom-left-radius: 8px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
        }
    </style>
</x-app-layout>