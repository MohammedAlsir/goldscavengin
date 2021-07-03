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
            'password' => 'required|min:8',
        ]);


        if (Auth::attempt($data)) {

            if(auth()->user()->role == 'User'){

                if(auth()->user()->status == 'active'){

                    if(auth()->user()->mac_address == 'null'){
                        $user = User::find(auth()->user()->id);
                        $user->mac_address = $mac;
                        $user->save();
                        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                        return response()->json(['token' => $token , 'user'=> $user], 200);

                    }elseif(auth()->user()->mac_address == $mac ){
                        $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
                        return response()->json(['token' => $token , 'user'=> Auth::user()], 200);
                    }else{
                        return response()->json(['message' =>'Sorry, if you are trying to login from a different phone, please check with the administration'], 401);
                    }

                }else{
                    return response()->json(['message' =>'Sorry, this account is nonactive. Please check with the administration'], 401);
                }

            }else{
                return response()->json(['error' => 'Sorry, Your account is for administration, you can not log in here'], 401);
            }

        } else {
            return response()->json(['error' => 'Unauthorised , Incorrect email or password'], 401);
        }
    }
    // end Login Function
}
