<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function addUser(Request $request){
       /*$result = $request->validate([
          "firstName"=>'required',
          "lastName"=>'required',
          "school"=>'required',
          "major"=>'required',
          "year"=>'required',
          "email"=>'required|email|unique:Users', 
          "phone"=>"required",
          "password"=>"min:8|required_with:password_confirmation|same:password_confirmation",
          "password_confirmation"=>"required|min:8"
       ]);*/

       $rule = array(
            "firstName"=>'required',
            "lastName"=>'required',
            "school"=>'required',
            "major"=>'required',
            "year"=>'required',
            "email"=>'required|email|unique:Users', 
            "phone"=>"required",
            "password"=>"min:8|required_with:password_confirmation|same:password_confirmation",
            "password_confirmation"=>"required|min:8"
       );

       $validator = Validator::make($request->all(),$rule);

       if($validator->fails()){
           return $validator->errors();
       }
       else{
            $users = new User;
            $users->firstName = $request->firstName;
            $users->lastName = $request->lastName;
            $users->school = $request->school;
            $users->major = $request->major;
            $users->year = $request->year;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->password = $request->password;
            $result = $users->save();
            if($result){
                return ["success"];
            }
            else{
                return ["failed"];
            }
       }

      
    }
    public function showUser(){
        $data = User::all();
        return $data;
    }
}
