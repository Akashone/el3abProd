<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifiedMobileNumber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                      => 'required|max:50',
            'nick_name'                 => 'required|max:25',
            'dob'                       => 'required|date',
            'email'                     => 'required|email|unique:users|max:100',
            'mobile_number'             => 'required',
            'gender'                    => 'required',
            'field_position'            => 'required',
            'skill_level'               => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->getMessageBag()], 400);
        }

        try {

            $mobile = VerifiedMobileNumber::where('mobile_number', $request->mobile_number)->first();

            if(empty($mobile))
            {
                return response()->json(['msg' => 'Given mobile number ('.$request->mobile_number.') is not match to our records!'], 404);
            }
            elseif(!empty($mobile))
            {
                if ($mobile->verified == false) {
                    return response()->json(['msg' => 'Given mobile number ('.$request->mobile_number.') is not verified!'], 401);
                }
            }

            $newUser = new User();
            $newUser->name                         = $request->get('name');
            $newUser->nick_name                    = $request->get('nick_name');
            $newUser->dob                          = $request->get('dob');
            $newUser->email                        = $request->get('email');
            $newUser->verified_mobile_number_id    = $mobile->id;
            $newUser->gender                       = $request->get('gender');
            $newUser->field_position               = $request->get('field_position');
            $newUser->skill_level                  = $request->get('skill_level');
            $newUser->save();

            $mobile->user_id = $newUser->id;
            $mobile->save();

            $user = User::find($newUser->id);
            $user['mobile'] = $user->mobile;
            return response()->json(['msg' => $user], 201);
        } catch (Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], $ex->getCode());
        }
    }
}
