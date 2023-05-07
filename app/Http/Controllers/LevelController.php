<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    public function get_levels(){

        $levels = level::all();

        return response()->json([
            'levels' => $levels
        ]);

    }

 



   

        public function create_level(Request $request){

           $this->validate($request,
            ['name' => 'required']);

            $level = new level();
            $level->name = $request->name;
            $level->save();

        }

        public function update_level(Request $request, $id){

         $level = level::find($id);

            $this->validate($request,
                ['name' =>'required']);

                $level->name = $request->name;
                $level->save();

        }

        public function delete_level($id){
            $level = level::findOrFail($id);
            $level->delete();

        }
}
