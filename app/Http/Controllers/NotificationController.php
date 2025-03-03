<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GeneralNotification;

class NotificationController extends Controller
{
    // Send notification to a specific user
    public function sendNotification(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $user = User::findOrFail($request->user_id);

        // Send notification via database and email
        Notification::send($user, new GeneralNotification($request->title, $request->message));

        return response()->json(['message' => 'Notification sent successfully']);
    }

    // Get all notifications for the logged-in user
    public function getNotifications() {
        return response()->json(auth()->user()->notifications);
    }

    // Mark notification as read
    public function markAsRead($id) {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['message' => 'Notification marked as read']);
        }

        return response()->json(['error' => 'Notification not found'], 404);
    }
}
