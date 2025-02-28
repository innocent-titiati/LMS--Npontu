<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use App\Models\UserMessages;
use Illuminate\Http\Request;

class UserMessagesController extends Controller
{
    /**
     * Display a listing of the messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = UserMessages::with(['sender', 'receiver'])->get();
        return response()->json($messages);
    }

    /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $message = UserMessages::create($request->all());
        return response()->json($message, 201);
    }

    /**
     * Display the specified message.
     *
     * @param  \App\Models\UserMessages  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function show(UserMessages $userMessage)
    {
        return response()->json($userMessage->load(['sender', 'receiver']));
    }

    /**
     * Update the specified message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMessages  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMessages $userMessage)
    {
        $request->validate([
            'subject' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $userMessage->update($request->all());
        return response()->json($userMessage);
    }

    /**
     * Remove the specified message from storage.
     *
     * @param  \App\Models\UserMessages  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMessages $userMessage)
    {
        $userMessage->delete();
        return response()->json(null, 204);
    }
}