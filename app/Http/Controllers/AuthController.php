<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $main_content = 'Auth'; 

    public function index()
    {
        $web_information = $this->WebInformation();
        $main_content = $this->main_content;
        $title = "$main_content Signin -  $web_information->title";

        return view('auth.signin', compact(
            'web_information', 'title'
        ));
    }

    public function signin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validation->errors()->first()
            ], 400);
        }

        $user = User::where('username', $request->username)->first();

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'status'  => false,
                'message' => 'Username or password invalid.'
            ], 400);
        }

        session()->put('user', [
            'id' => Crypt::encryptString($user->id),
            'username' => $user->username,
            'email' => $user->email,
            'name' => $user->name
        ]);

        return response()->json([
            'status'   => true,
            'message'  => 'Signin successful, you will be redirected in <span id="RedirectCountdown">5<span> seconds.',
            'redirect' => route('dashboard.index')
        ], 200);
    }

    public function signout()
    {
        session()->forget('user');

        return redirect()->to(route('signin'));
    }
}
