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

    public function search_chapter(Request $request)
    {

        $search = $request->get('s');


            $chapter = chapter::where('name', 'LIKE', "%$search%")->get();
        
        return response()->json([
            'chapter' => $chapter
        ], 200);
    }



    public function create_chapter(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required',
                'file' => 'required',
                'url' => 'required'
            ]
        );


        $pdf = '';
        if ($request->hasFile('file')) {
            $p = $request->file('file');
            $file = time() . '.' . $p->getClientOriginalName();
            $p->move(public_path('pdf'), $file);
            $pdf = 'pdf' . $file;
        }


        $chapter = new chapter();
        $chapter->name = $request->name;
        $chapter->file = $pdf;
        $chapter->description = $request->description;
        $chapter->url = $request->url;
        $chapter->learning_id = $request->learning_id;
        $chapter->save();
    }

    public function update_chapter(Request $request, $id)
    {

        $chapter = chapter::find($id);

        $this->validate(
            $request,
            [
                'name' => 'required',
                'file' => 'required',
                'url' => 'required'
            ]
        );


        $pdf = '';
        if ($request->hasFile('file')) {
            $p = $request->file('file');
            $file = time() . '.' . $p->getClientOriginalName();
            $p->move(public_path('pdf'), $file);
            $pdf = 'pdf' . $file;
        }



        $chapter->name = $request->name;
        $chapter->file = $pdf;
        $chapter->description = $request->description;
        $chapter->url = $request->url;
        $chapter->learning_id = $request->learning_id;
        $chapter->save();
    }

    public function delete_chapter($id)
    {
        $chapter = chapter::findOrFail($id);
        $chapter->delete();
    }




}
