<?php

namespace App\Http\Controllers;

use Illuminate\{
    Http\Request,
    Notifications\DatabaseNotification
};

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('notifications.index', compact('user'));
    }

    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        if ($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('home');
        }

        return back();
    }
}
