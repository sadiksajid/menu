<?php

namespace App\Http\Controllers;

use App\Models\Apk;
use App\Models\ContactUs;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class VueAPI extends Controller
{

    public function GetColor(Request $request)
    {

        $this->validate($request, [
            'id' => 'required|integer',
        ]);
        $id = $request->id;
        $Apk = Apk::find($id);
        $colors = array(
            'background_color'=> $Apk->background_color,
            'nav_color'     => $Apk->nav_color,
            'title_color'   => $Apk->title_color,
            'text_color'    => $Apk->text_color,
            'link'          => $Apk->apk_link
        );

        return Response::json(array('Apk' => $colors));
    }

    public function AllApps(Request $request)
    {
        $Apk = Apk::all()->toArray();
        
        return Response::json(array('apps' => $Apk));
    }

    public function ContactForm(Request $request)
    {

        $request->validate([
            'name'    => 'required|string|max:20',
            'email'   => 'required|string|max:50',
            'subject' => 'required|string|max:250',
            'message' => 'required|string|max:5000',
        ]);

        $contact = new ContactUs();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        $contact->save();
        return Response::json(true);
    }


}
