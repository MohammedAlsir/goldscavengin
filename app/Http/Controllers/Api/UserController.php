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
                        return response()->json([
                            // 'message' =>'Sorry, if you are trying to login from a different phone, please check with the administration',
                            'error'     => true ,
                            'message_en'   => 'Sorry, if you are trying to login from a different phone, please check with the administration' ,
                            'message_ar'   => 'عفوا ، إذا كنت تحاول تسجيل الدخول من هاتف مختلف ، يرجى مراجعة الإدارة' ,
                        ], 401);
                    }

                }else{
                    return response()->json([
                        // 'message' =>'Sorry, this account is nonactive. Please check with the administration',
                        'error'     => true ,
                        'message_en'   => 'Sorry, this account is nonactive. Please check with the administration' ,
                        'message_ar'   => 'عفوا ، هذا الحساب غير نشط. يرجى مراجعة الإدارة' ,
                    ], 401);
                }

            }else{
                return response()->json([
                    // 'error' => 'Sorry, Your account is for administration, you can not log in here',
                    'error'     => true ,
                    'message_en'   => 'Unauthorised ,Sorry, you do not have access to this page ' ,
                    'message_ar'   => 'عفوا ، ليس لديك صلاحيات الوصول إلى هذه الصفحة' ,
                ], 401);
            }

        } else {
            return response()->json([
                'error'     => true ,
                'message_en'   => 'Sorry, there is an error in your email or password' ,
                'message_ar'   => 'عفوا ، هناك خطأ في البريد الإلكتروني أو كلمة المرور الخاصة بك' ,
            ], 401);
        }
    }
    // end Login Function
}
