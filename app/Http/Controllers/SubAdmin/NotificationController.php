<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //view driver notifications
    public function driverNotification()
    {
        $notifications = Notification::where('sender_id', 12)->get();
         return view('admin.driver.orderGet.driverNotifications', compact('notifications'));
    }
    //notification readed
    public function notificationRead($id)
    {
        $notification = Notification::find($id);
        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }
        $notification->status = 'read';
        $notification->save();
        return redirect()->back()->with('success', 'Notification marked as read.');
    }
    //customer Notifications
    public function customerNotification()
    {
        $notifications = Notification::where('sender_id', 13)->get();
        return view('admin.customer.customerNotifications', compact('notifications'));
    }
    //Admin to Driver Notifications
    public function adminNotification()
    {
        $notifications = Notification::where('receiver_id', 12)->get();
        return view('admin.driver.adminNotifications', compact('notifications'));
    }
}
