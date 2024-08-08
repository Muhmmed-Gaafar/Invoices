<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationDropdown extends Component
{
    public $notifications;
    public $unreadCount;

    public function __construct()
    {
        $this->notifications = Auth::user()->notifications()->limit(10)->get();
        $this->unreadCount = Auth::user()->unreadNotifications->count();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function allNotifications()
    {
        return Auth::user()->notifications()->get();
    }

    public function render()
    {
        return view('components.notification-dropdown');
    }
}
