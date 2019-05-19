<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificatonController extends Controller
{
    //

    public function index()
    {
        $notifications = Notification::query()->where('user_id','=',\Auth::user()->id)->paginate(10);
        foreach ($notifications as $notification)
        {
            if($notification->state == 1)
            {
                $notification->state = 1;
                $notification->save();
            }
        }
        return view('pages.notifications.index',
            [
                'notifications' => $notifications
            ]);
    }

    public function show(Notification $notification)
    {
        $notification->state = 1;
        $notification->save();
        return view('pages.notifications.show',
            [
                'notification' => $notification
            ]);
    }
}
