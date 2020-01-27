<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\User;
use Validator;
class RegisterController extends BaseController
{
    //
    public function register(Request $request){
        
        $input = $request->all();
         //Tester les donnees recu
         $validator = Validator::make($input, [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
           'password' => 'required',
           'c_password' => 'required|same:password',
           ]);
   


            if($validator -> fails()){
                return $this->sendError('error validation',$validator->errors());
            }
        
       $input['password'] = bcrypt($input['password']);
       $user = User::create($input);

       //Create a token
       $success['token'] = $user->createToken('MyApp')->accessToken;
       

        return $this->sendResponse($success,'User create succesufly');

    }
}
