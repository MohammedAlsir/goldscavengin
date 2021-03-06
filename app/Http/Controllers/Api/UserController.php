<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Login Function
    public function userlogin(Request $request , $mac)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);


        if (Auth::attempt($data)) {

            if(auth()->user()->role == 'User'){

                if(auth()->user()->status == 'active'){

                    if(auth()->user()->mac_address == 'null'){
                        $user = User::find(auth()->user()->id);
                        $user->mac_address = $mac;
                        $user->save();
                        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                        return response()->json([
                            'token' => $token ,
                            'user'=> $user,
                            'error' => false  ,
                            'message_en' => '',
                            'message_ar' => ''
                            ], 200);

                    }elseif(auth()->user()->mac_address == $mac ){
                        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                        return response()->json([
                            'token' => $token ,
                            'user'=> Auth::user(),
                            'error' => false  ,
                            'message_en' => '',
                            'message_ar' => ''
                        ], 200);
                    }else{
                        return response()->json([
                            // 'message' =>'Sorry, if you are trying to login from a different phone, please check with the administration',
                            'error'     => true ,
                            'message_en'   => 'Sorry, if you are trying to login from a different phone, please check with the administration' ,
                            'message_ar'   => '???????? ?? ?????? ?????? ?????????? ?????????? ???????????? ???? ???????? ?????????? ?? ???????? ???????????? ??????????????' ,
                        ], 200);
                    }

                }else{
                    return response()->json([
                        // 'message' =>'Sorry, this account is nonactive. Please check with the administration',
                        'error'     => true ,
                        'message_en'   => 'Sorry, this account is nonactive. Please check with the administration' ,
                        'message_ar'   => '???????? ?? ?????? ???????????? ?????? ??????. ???????? ???????????? ??????????????' ,
                    ], 200);
                }

            }else{
                return response()->json([
                    // 'error' => 'Sorry, Your account is for administration, you can not log in here',
                    'error'     => true ,
                    'message_en'   => 'Unauthorised ,Sorry, you do not have access to this page ' ,
                    'message_ar'   => '???????? ?? ?????? ???????? ?????????????? ???????????? ?????? ?????? ????????????' ,
                ], 200);
            }

        } else {
            return response()->json([
                'error'     => true ,
                'message_en'   => 'Sorry, there is an error in your email or password' ,
                'message_ar'   => '???????? ?? ???????? ?????? ???? ???????????? ???????????????????? ???? ???????? ???????????? ???????????? ????' ,
            ], 200);
        }
    }
    // end Login Function
}
