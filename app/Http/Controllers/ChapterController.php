<?php

namespace App\Http\Controllers;

use App\Models\chapter;

use Illuminate\Http\Request;

class ChapterController extends Controller
{
   public function get_quizzes($name){

    $quizzes = chapter::where('name',$name)->with('quizzes')->first();

    return response() -> json([
        'quizzes' => $quizzes
    ]);
    }

    public function get_chapters(){

        $chapters = chapter::all();

        return response()->json([
            
            'chapters' => $chapters

        ]);

    }
}
