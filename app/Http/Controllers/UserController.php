<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //
    function register(Request $req)
    {
        $user = new User;
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->password=Hash::make($req->input('password'));
        $user->save();
        return $user;
    }
    function login(Request $req)
    {
        // $email = $req->input('email');
        // $user = DB::select("SELECT `id`, `name`, `email` , `password` FROM `users` WHERE `email`='$email'");
        // $data = new User;
        // $data->name = $user[0]->name;
        // $data->id = $user[0]->id;
        // $data->email = $user[0]->email;
        // // $data->password = $user[0]->password;
        // return $data;
        $user = User::where('email',$req->email)->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            return response([
                'error'=>["Email or password is not matched"]
            ]);
        }
        return $user;
    }
}
