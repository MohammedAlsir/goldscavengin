<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule as ValidationRule;

class UserController extends Controller
{

    //Regester Function
    public function register(Request $request)
    {

        $data = $request->validate(
            [
                'name' => 'required|min:4',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'shop' => 'required',
                // 'role' =>
            ]);

        $data['password'] = Hash::make($request->password);
        $data['role'] = 'User';
        $data['status'] = 'active';
        $user = User::create($data);

        //
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['newUser' =>$user], 200);
        //
        // return $this->login(request());
    }
    // End regester function

    // Login Function
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);


        if (Auth::attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token , 'user'=> Auth::user()], 200);
        } else {
            return response()->json(['error' => 'Unauthorised , '], 401);
        }
    }
    // end Login Function

    // get all users => Begin
    public function users(){
        // Auth::user()->token();
        $users = User::where('role', 'User')->get();
        return response()->json(['users' => $users], 200);
    }
    // get all users => End

    // status Function  => Begin
    public function status(Request $request,$id){

        $data = $request->validate([
            'status' => 'in:active,nonactive|required',
        ]);

        $user = User::find($id);
        $user->status =  $data['status'];
        $user->save();
        return response()->json(['user' => $user], 200);
    }
    // status function  => End

    // destroy function  => Begin
    public function destroy($id){

        if(!$user = User::find($id)){
            return response()->json(['message' => 'this user not found'], 200);
        }

        $user->delete();
        return response()->json(['message' => 'succses delete user'], 200);

    }
    // destroy function  => End

    // edit user data  => Begin
    public function user(Request $request ){
        $user = User::find(1);

        $data = $request->validate([
            'name' => 'min:4',
            'email' => [ Rule::unique('users')->ignore(User::find(1)->id)],
            'password' => 'min:8',
            // 'status' => 'in:active,nonactive',
            // 'shop' =>'min:1'

        ]);
        $user->update($data);
        return response()->json(['user' =>$user , 'message' =>'succses edit user data'], 200);






    }
    // edit user data  => End
}
