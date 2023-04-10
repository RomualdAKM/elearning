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

   
}
