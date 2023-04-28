<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function get_users(){

        $users = User::all();

        return response()->json([
            'users' => $users
        ],200);
    }

    public function search_user(Request $request){

        $search = $request->get('s');

        $user = User::where('name', 'LIKE', "%$search%")->get();

        return response()->json([
            'user' => $user
        ], 200);

    }

    public function delete_user($id)
    {
        $level = User::findOrFail($id);
        $level->delete();
    }
}
