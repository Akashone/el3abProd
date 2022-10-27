<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifiedMobileNumber;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function verifyMobileNumber(Request $request)
    {
        try {
            $mobileNumber = VerifiedMobileNumber::where('mobile_number', $request->mobile_number)->first();
            if (!empty($mobileNumber)) {
                $mobileNumber->verified = $request->verify;
                $mobileNumber->save();

                if ($mobileNumber->user_id != null) {
                    $mobileWithUser = VerifiedMobileNumber::where('id', $mobileNumber->id)->first();
                    $mobileWithUser['user'] = $mobileWithUser->user;
                    return response()->json(['msg' => 'Mobile verified successfully!', 'data' => $mobileWithUser], 200);
                }
                else
                {
                    return response()->json(['msg' => 'Mobile verified successfully!', 'data' => $mobileNumber], 200);
                }

            } else {
                $newMobile = new VerifiedMobileNumber();
                $newMobile->mobile_number = $request->mobile_number;
                $newMobile->verified = $request->verify;
                $newMobile->save();

                return response()->json(['msg' => 'Mobile number stored successfully!', 'data' => $newMobile], 201);
            }
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], $ex->getCode());
        }
    }
}
