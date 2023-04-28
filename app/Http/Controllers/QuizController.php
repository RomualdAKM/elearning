<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function get_quizzes()
    {

        $quizzes = quiz::all();

        return response()->json([
            'quizzes' => $quizzes
        ]);
    }

    public function search_quiz(Request $request){
        $search = $request->get('s');


        $quiz = quiz::where('question', 'LIKE', "%$search%")->get();

        return response()->json([
            'quiz' => $quiz
        ], 200);
    }


    public function create_quiz(Request $request)
    {

        $this->validate(
            $request,
            [
                    'question' => 'required',
                    'option1' => 'required',
                    'option2' => 'required',
                    'option3' => 'required',
                    'response' => 'required',
                    'chapter_id' => 'required',
            ]);

                $quiz = new quiz();
                $quiz->question = $request->question;
                $quiz->option1 = $request->option1;
                $quiz->option2 = $request->option2;
                $quiz->option3 = $request->option3;
                $quiz->response = $request->response;
                $quiz->chapter_id = $request->chapter_id;
                $quiz->save();
    }

    public function update_quiz(Request $request, $id)
    {

        $quiz = quiz::find($id);

        $this->validate(
            $request,
            [
                'question' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'option3' => 'required',
                'response' => 'required',
                'chapter_id' => 'required',
            ]
        );

        $quiz->question = $request->question;
        $quiz->option1 = $request->option1;
        $quiz->option2 = $request->option2;
        $quiz->option3 = $request->option3;
        $quiz->response = $request->response;
        $quiz->chapter_id = $request->chapter_id;
        $quiz->save();
    }

    public function delete_quiz($id)
    {
        $quiz = quiz::findOrFail($id);
        $quiz->delete();
    }


}
