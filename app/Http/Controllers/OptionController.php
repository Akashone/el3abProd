<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    public function addOrUpdateOption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:options|max:255',
            'point' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->getMessageBag()]);
        }

        try {
            $mode = $request->mode;
            $id = $request->id;
            $name = $request->name;
            $point = $request->point;

            if ($mode == 'add') {
                $option = new Option();
                $option->name = $name;
                $option->points = $point;
                $option->save();

                return response()->json(['success' => 'Option added successfully!']);
            }

            if ($mode == 'edit') {
                $option = Option::find($id);
                $option->name = $name;
                $option->points = $point;
                $option->save();

                return response()->json(['success' => 'Option updated successfully!']);
            }

            return response()->json(['failed' => 'Something went wrong. Please try again.']);
        } catch (Exception $ex) {
            return response()->json(['failed' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function getOptionDetails(Request $request)
    {
        try {
            $id = $request->id;

            $option = Option::find($id);

            return response()->json(['success' => $option]);
        } catch (Exception $ex) {
            return response()->json(['failed' => $ex->getMessage()], $ex->getCode());
        }
    }
}
