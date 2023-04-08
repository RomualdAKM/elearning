<?php

namespace App\Http\Controllers;


use App\Models\subject;

class SubjectController extends Controller
{
    public function get_subjects()
    {

        $subjects = subject::orderBy('id', 'DESC')->with('learnings')->get();

        return response()->json([
            'subjects' => $subjects
        ], 200);
    }
}