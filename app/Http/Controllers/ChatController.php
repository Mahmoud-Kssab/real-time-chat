<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function users()
    {
        $user_id = auth()->guard('web')->user()->id;
        $users = User::where('id','!=', $user_id)->get();
        return response()->json($users);
    }

}
