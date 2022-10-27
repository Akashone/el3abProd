<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function addOrUpdateGame(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:games|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->getMessageBag()]);
        }

        try {
            $mode = $request->mode;
            $id = $request->id;
            $name = $request->name;

            if ($mode == 'add') {
                $game = new Game();
                $game->name = $request->name;
                $game->save();

                return response()->json(['success' => 'Game added successfully!']);
            }

            if ($mode == 'edit') {
                $game = Game::find($id);
                $game->name = $name;
                $game->save();
             
                return response()->json(['success' => 'Game updated successfully!']);
            }

            return response()->json(['failed' => 'Something went wrong. Please try again.']);
        } catch (Exception $ex) {
            return response()->json(['failed' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function getGameDetails(Request $request)
    {
        try {
            $id = $request->id;

            $game = Game::find($id);

            return response()->json(['success' => $game]);
        } catch (Exception $ex) {
            return response()->json(['failed' => $ex->getMessage()], $ex->getCode());
        }
    }
}
