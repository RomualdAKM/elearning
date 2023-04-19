<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function get_messages(){

         $messages = message::with('user')->get();

         return response() -> json([

                'messages'=> $messages

        ],200);

    }

    public function create_message(Request $request){


        $this->validate(
            $request,
            [
                'message' => 'required',
                'userId' => 'required',

            ]
        );

        $message = new message();
        $message->message = $request->message;
        $message->user_id = $request->userId;
        $message->save();

    }
}
