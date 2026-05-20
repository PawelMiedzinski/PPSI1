<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $conversations = Auth::user()->conversations()->with(['users', 'latestMessage', 'item'])->latest()->get();
        return view('messages', compact('conversations'));
    }

    public function start(User $user)
    {
        $current = Auth::user();
        $conversation = $current->conversations()->whereHas('users', fn($q) => $q->where('users.id', $user->id))->first();

        if (!$conversation) {
            $conversation = Conversation::create();
            $conversation->users()->attach([$current->id, $user->id]);
        }

        return redirect("/messages/{$conversation->id}");
    }

    public function show(Conversation $conversation)
    {
        abort_if(!$conversation->users->contains(Auth::id()), 403);

        $conversation->load(['messages.sender', 'users', 'item']);
        $conversations = Auth::user()->conversations()->with(['users', 'latestMessage'])->latest()->get();

        return view('messages', compact('conversation', 'conversations'));
    }

    public function store(Request $request, Conversation $conversation)
    {
        $request->validate(['message' => 'required|max:1000']);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $request->message
        ]);

        return back();
    }
}