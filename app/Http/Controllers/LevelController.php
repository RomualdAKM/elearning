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



    public function get_books_in_level($levelId)

    {
        $booksLevel = level::where('id', $levelId)->with('books')->get();

        return response()->json([
            'booksLevel' => $booksLevel
        ],200);
    }

    public function search_book(Request $request)
    {

        $search = $request->get('s');

        if ($search != null) {

           // $book = level::where('name', 'LIKE', "%$search%")->with('books')->get();

           $book = level::with('books')
            ->whereHas('books', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })

            ->get();

            return response()->json([
                'book' => $book
            ], 200);
        }
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
