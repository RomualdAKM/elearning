<?php

namespace App\Http\Controllers;

use App\Models\learning;
use Illuminate\Http\Request;

class LearningController extends Controller
{


    public function get_learning($name)
    {


        $learnings = learning::where('name', $name)
            ->with('chapters')->first();


        return response()->json([
            'learnings' => $learnings
        ], 200);
    }

    public function get_learnings()
    {

        $learnings = learning::all();

        return response()->json([
            'learnings' => $learnings
        ]);
    }


    public function create_learning(Request $request)
    {

        $this->validate(
            $request,
            ['name' => 'required',
                 'subject_id' => 'required']
        );

        $learning = new learning();
        $learning->name = $request->name;
        $learning->subject_id = $request->subject_id;
        $learning->save();
    }


    public function update_learning(Request $request, $id)
    {

        $learning = learning::find($id);

        $this->validate(
            $request,
            ['name' => 'required',
                'subject_id' => 'required']);

        $learning->name = $request->name;
        $learning->subject_id = $request->subject_id;
        $learning->save();
    }

    public function delete_learning($id)
    {
        $learning = learning::findOrFail($id);
        $learning->delete();
    }
}
