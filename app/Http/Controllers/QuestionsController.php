<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    public function addOrUpdateQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:questions|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->getMessageBag()]);
        }

        try {
            $mode = $request->mode;
            $id = $request->id;
            $name = $request->name;

            if ($mode == 'add') {
                $question = new Question();
                $question->name = $request->name;
                $question->save();

                return response()->json(['success' => 'Question added successfully!']);
            }

            if ($mode == 'edit') {
                $question = Question::find($id);
                $question->name = $name;
                $question->save();
             
                return response()->json(['success' => 'Question updated successfully!']);
            }

            return response()->json(['failed' => 'Something went wrong. Please try again.']);
        } catch (Exception $ex) {
            return response()->json(['failed' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function getQuestionDetails(Request $request)
    {
        try {
            $id = $request->id;

            $question = Question::find($id);

            return response()->json(['success' => $question]);
        } catch (Exception $ex) {
            return response()->json(['failed' => $ex->getMessage()], $ex->getCode());
        }
    }
}
