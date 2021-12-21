<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages($user_id)
    {
        $receiver_id = auth()->user()->id;

        $messages = Message::where(function($q) use($user_id, $receiver_id){

            $q->where('sender_id', $user_id)->where('receiver_id', $receiver_id);
            $q->orWhere('receiver_id', $user_id)->where('sender_id', $receiver_id);

        })->get();

        return response()->json(MessageResource::collection($messages));
    }

    public function publicMessages()
    {
        $receiver_id = auth()->user()->id;

        $messages = Message::with('sender')->whereReceiverId(NULL)->get();

        return response()->json(MessageResource::collection($messages));
    }

    public function addMessage(Request $request)
    {
        $sender_id = auth()->user()->id;
        $message = Message::create([

            'body' => $request->body,
            'receiver_id' => $request->receiver_id,
            'sender_id' => $sender_id,
        ]);
        broadcast(new MessageSent($message->load('sender')))->toOthers();
        // event(new MessageSent($message));

        return ['status' => 200];
    }

}
