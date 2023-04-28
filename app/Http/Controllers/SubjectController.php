<?php

namespace App\Http\Controllers;


use App\Models\subject;
use Illuminate\Http\Request;

class SubjectController extends Controller


{

    public function get_subject(){
        $subject = subject::all();

        return response()->json([
            'subject' => $subject
        ], 200);

    }

    public function search_subject(Request $request){
        $search = $request->get('s');


        $subjt = subject::where('name', 'LIKE', "%$search%")->get();

        return response()->json([
            'subjt' => $subjt
        ], 200);


    }

    public function get_subjects($id)
    {

        $subjects = subject::orderBy('id', 'DESC')->with('learnings')
            ->whereHas('level', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();

        return response()->json([
            'subjects' => $subjects
        ], 200);
    }

    public function create_subject(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required',
                'level_id' => 'required'
            ]
        );

        $subject = new subject();
        $subject->name = $request->name;
        $subject->level_id = $request->level_id;
        $subject->save();
    }


    public function update_subject(Request $request, $id)
    {

        $subject = subject::find($id);

        $this->validate(
            $request,
            [
                'name' => 'required',
                'level_id' => 'required'
            ]
        );

        $subject->name = $request->name;
        $subject->level_id = $request->level_id;
        $subject->save();
    }

    public function delete_subject($id)
    {
        $subject = subject::findOrFail($id);
        $subject->delete();
    }
}
