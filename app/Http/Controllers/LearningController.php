<?php

namespace App\Http\Controllers;

use App\Models\learning;

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
}