<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function get_detail_book($bookName){

        $book = book::where('name',$bookName)->with('category')->first();

        return response()->json([
            'book' => $book
        ],200);

    }

    public function search_book(Request $request)
    {

        $search = $request->get('s');

        if ($search != null) {

            $book = book::where('name', 'LIKE', "%$search%")->with('category')->get();

            return response()->json([
                'book' => $book
            ], 200);
        }
    }
}
