<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use App\Models\Notification;
use App\Models\NotificationToUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public static function getall()
    {
        $apk_id = session('apk');
        $notifications = Notification::leftJoin('notification_to_users as usnot', 'notifications.id', '=', 'usnot.notification_id')->where('notifications.apk_id',$apk_id)->select("notifications.*", "usnot.id as iduser")->orderBy('created_at', 'DESC')->limit(10)->get();
        return $notifications;
    }

    public static function ContactUsall()
    {
        $messages = ContactUs::where('seen',0)->limit(10)->get();
        return $messages;
    }



    public function deleteNot($id)
    {
        $not = new NotificationToUser;
        $not->notification_id = $id ;
        $not->user_id         = Auth::id() ;
        $not->save();
        return 1;
    }


    public function openNote($type, $idNote, $id)
    {
        if (!NotificationToUser::where('notification_id', $idNote)->where('user_id', Auth::id())->exists()) {
            $not = new NotificationToUser;
            $not->notification_id = $idNote ;
            $not->user_id         = Auth::id() ;
            $not->save();
        }

        $array= array(
            'requist'  => '/admin/WallpappersRequest' ,
            'apk_user'   => '/admin/ApkUsersList',
                
        );

        // session()->put('NoteId', $id);


        return redirect($array[$type]);
    }
}
