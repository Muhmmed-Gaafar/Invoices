<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function allNotifications()
    {
        $notifications = Auth::user()->notifications()->get();
        return view('all-notifications-view', compact('notifications'));
    }
}
