<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function Login()
    {
        return view('login');
    }

    function LoginUser(Request $req)
    {
        $data = DB::table('users')->where('user_email', '=', $req->input('email'))->first();
        if ($data) {
            if (Hash::check($req->input('password'), $data->user_password)) {
                Session::put('user_id', $data->user_id);
                Session::put('user_name', $data->user_name);
                Session::put('user_email', $data->user_email);
                Session::save();
                return response()->json(["success" => true, "message" => "Login successfully Completed!"]);
            } else {
                return response()->json(["success" => false, "message" => "Invalid Credentials"]);
            }
        } else {
            return response()->json(["success" => false, "message" => "Invalid Credentials"]);
        }
    }

    function Dashboard()
    {
        return view('Admin.Dashboard');
    }

    function LogOut()
    {
        Session::forget('user_id');
        Session::forget('user_name');
        Session::forget('user_email');
        Session::save();

        return redirect('/login');
    }
}
